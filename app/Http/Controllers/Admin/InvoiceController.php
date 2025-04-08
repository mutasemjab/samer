<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Invoice;
use App\Models\InvoiceService;
use App\Models\Service;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with(['patient', 'appointment'])->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.invoices.index', compact('invoices'));
    }

    public function create()
    {
        $patients = User::get();
        $appointments = Appointment::where('status', 'completed')
            ->whereDoesntHave('invoice')
            ->orderBy('appointment_datetime', 'desc')
            ->get();
        $services = Service::get();
        
        return view('admin.invoices.create', compact('patients', 'appointments', 'services'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'appointment_id' => 'nullable|exists:appointments,id',
            'invoice_date' => 'required|date',
            'payment_method' => 'required',
            'discount' => 'nullable',
            'services' => 'required|array',
            'services.*.service_id' => 'required|exists:services,id',
            'services.*.quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();
            
            // Create invoice
            $invoice = new Invoice();
            $invoice->user_id = $validated['user_id'];
            $invoice->appointment_id = $validated['appointment_id'];
            $invoice->invoice_date = $validated['invoice_date'];
            $invoice->total_amount = 0; // Will calculate below
            $invoice->discount = 0; // Will calculate below
            $invoice->status = 'unpaid';
            $invoice->payment_method = $validated['payment_method'];;
            $invoice->notes = $validated['notes'] ?? null;
            $invoice->save();
            
            // Add invoice items
            $totalAmount = 0;
            foreach ($validated['services'] as $item) {
                $service = Service::find($item['service_id']);
                $quantity = $item['quantity'];
                $price = $service->price;
                $subtotal = $price * $quantity;
                
                InvoiceService::create([
                    'invoice_id' => $invoice->id,
                    'service_id' => $service->id,
                    'quantity' => $quantity,
                    'price' => $price,
                    'subtotal' => $subtotal,
                ]);
                
                $totalAmount += $subtotal;
            }
            
             // Calculate final amount after discount
             $discountAmount = $validated['discount'];
             $finalAmount = $totalAmount - $discountAmount;
            // Update invoice total
            $invoice->total_amount = $finalAmount;
            $invoice->save();
            
            DB::commit();
            
            return redirect()->route('invoices.show', $invoice)
                ->with('success', 'Invoice created successfully.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Error creating invoice: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show(Invoice $invoice)
    {
        $invoice->load(['patient', 'appointment', 'items.service']);
        return view('admin.invoices.show', compact('invoice'));
    }


    public function edit(Invoice $invoice)
    {
        $patients = User::get();
        $appointments = Appointment::where('status', 'completed')
            ->where(function($query) use ($invoice) {
                $query->whereDoesntHave('invoice')
                    ->orWhere('id', $invoice->appointment_id);
            })
            ->orderBy('appointment_datetime', 'desc')
            ->get();
        $services = Service::get();
        
        // Load invoice relationships
        $invoice->load(['patient', 'appointment', 'items.service']);
        
        return view('admin.invoices.edit', compact('invoice', 'patients', 'appointments', 'services'));
    }
    
    /**
     * Update the specified invoice in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'appointment_id' => 'nullable|exists:appointments,id',
            'invoice_date' => 'required|date',
            'payment_method' => 'required',
            'discount' => 'nullable',
            'services' => 'required|array',
            'services.*.service_id' => 'required|exists:services,id',
            'services.*.quantity' => 'required|integer|min:1',
            'discount' => 'required|numeric|min:0',
            'payment_method' => 'required|in:cash,credit_card,debit_card,insurance,bank_transfer,check,other',
            'status' => 'required|in:unpaid,partially_paid,paid',
            'notes' => 'nullable|string',
        ]);
    
        try {
            DB::beginTransaction();
            
            // Update invoice
            $invoice->user_id = $validated['user_id'];
            $invoice->appointment_id = $validated['appointment_id'];
            $invoice->invoice_date = $validated['invoice_date'];
            $invoice->discount = $validated['discount'];
            $invoice->payment_method = $validated['payment_method'];
            $invoice->status = $validated['status'];
            $invoice->notes = $validated['notes'] ?? null;
            
            // Remove existing invoice items
            $invoice->items()->delete();
            
            // Add new invoice items
            $totalAmount = 0;
            foreach ($validated['services'] as $item) {
                $service = Service::find($item['service_id']);
                $quantity = $item['quantity'];
                $price = $service->price;
                $subtotal = $price * $quantity;
                
                InvoiceService::create([
                    'invoice_id' => $invoice->id,
                    'service_id' => $service->id,
                    'quantity' => $quantity,
                    'price' => $price,
                    'subtotal' => $subtotal,
                ]);
                
                $totalAmount += $subtotal;
            }
            
            // Calculate final amount after discount
            $discountAmount = $validated['discount'];
            $finalAmount = $totalAmount - $discountAmount;
            
            // Update invoice total
            $invoice->total_amount = $finalAmount;
            $invoice->save();
            
            DB::commit();
            
            return redirect()->route('admin.invoices.show', $invoice)
                ->with('success', 'Invoice updated successfully.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Error updating invoice: ' . $e->getMessage())
                ->withInput();
        }
    }

}

