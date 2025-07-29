<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function GetPatientNumbers()
    {
        $patientNumber = User::where('role', 'patient')->count();
        $appointmentNumber = Appointment::where('date', now()->format('Y-m-d'))->count();

        return view(
            'dashboard',
            [
                'patientNumber' => $patientNumber,
                'appointmentNumber' => $appointmentNumber
            ]
        );
    }
}
