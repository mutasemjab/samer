<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $patientsCount = User::count();
        $appointmentsCount = Appointment::count();
        $appointmentsToday = Appointment::whereDate('appointment_datetime', Carbon::today())->count();
        $appointmentsThisMonth = Appointment::whereMonth('appointment_datetime', Carbon::now()->month)
                                            ->whereYear('appointment_datetime', Carbon::now()->year)
                                            ->count();
    
        return view('admin.dashboard', compact(
            'patientsCount', 
            'appointmentsCount', 
            'appointmentsToday', 
            'appointmentsThisMonth'
        ));    }
}
