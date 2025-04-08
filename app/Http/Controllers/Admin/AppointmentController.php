<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Service;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AppointmentController extends Controller
{

    public function getByPatient(Request $request)
    {
        $userId = $request->input('user_id');
        
        if (!$userId) {
            return response()->json(['success' => false, 'message' => 'User ID is required']);
        }
        
        // Get appointments for the user, sorted by date descending (newest first)
        $appointments = Appointment::where('user_id', $userId)
            ->orderBy('appointment_datetime', 'desc')
            ->get();
        
        return response()->json([
            'success' => true,
            'appointments' => $appointments
        ]);
    }

    public function index()
    {
        $appointments = Appointment::with('patient')->orderBy('appointment_datetime')->paginate(PAGINATION_COUNT);
        return view('admin.appointments.index', compact('appointments'));
    }

    public function create()
    {
        $patients = User::get();
        return view('admin.appointments.create', compact('patients'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'appointment_datetime' => 'required',
            'notes' => 'nullable|string',
        ]);
        
        Appointment::create([
            'user_id' => $validated['user_id'],
            'appointment_datetime' => $validated['appointment_datetime'],
            'notes' => $validated['notes'] ?? null,
            'notes' => $validated['notes'] ?? null,
        ]);

        return redirect()->route('appointments.index')
            ->with('success', 'Appointment created successfully.');
    }

    public function show(Appointment $appointment)
    {
        return view('admin.appointments.show', compact('appointment'));
    }

    public function edit(Appointment $appointment)
    {
        $patients = User::get();
        return view('admin.appointments.edit', compact('appointment', 'patients'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'appointment_datetime' => 'required',
            'status' => 'required|in:scheduled,completed,cancelled,no-show',
            'notes' => 'nullable|string',
        ]);

        
        $appointment->update([
            'user_id' => $validated['user_id'],
            'appointment_datetime' => $validated['appointment_datetime'],
            'status' => $validated['status'],
            'notes' => $validated['notes'] ?? null,
        ]);

        return redirect()->route('appointments.index')
            ->with('success', 'Appointment updated successfully.');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->route('appointments.index')
            ->with('success', 'Appointment deleted successfully.');
    }
}
