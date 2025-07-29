<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Notifications\AppointmentReminder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ChangeStatusController extends Controller
{
    public function ChangeStatus(Request $request, $id)
    {
        if (!Gate::allows('ViewAll')) {
            abort(403);
        }

        $appointment = Appointment::findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        $appointment->update(['status' => $request->status]);
        $appointment->notify(new AppointmentReminder());
        return redirect()->route('appointments.index')
            ->with('success', 'Appointment status updated successfully!');
    }
}
