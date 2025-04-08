<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    protected $casts = [
        'invoice_date' => 'date',
    ];
    

    public function patient()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function items()
    {
        return $this->hasMany(InvoiceService::class);
    }

  

    public function calculateTotalPaid()
    {
        return $this->payments->sum('amount');
    }

    public function calculateBalance()
    {
        return $this->total_amount - $this->calculateTotalPaid();
    }

    public function updatePaymentStatus()
    {
        $totalPaid = $this->calculateTotalPaid();
        
        if ($totalPaid >= $this->total_amount) {
            $this->status = 'paid';
        } elseif ($totalPaid > 0) {
            $this->status = 'partially_paid';
        } else {
            $this->status = 'unpaid';
        }
        
        $this->save();
    }
}
