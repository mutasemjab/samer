<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'appointment_datetime' => 'datetime',
    ];
    
    public function patient()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }

    public function patientProfile()
    {
        return $this->hasOne(PatientProfile::class);
    }
}
