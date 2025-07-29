<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAppoitmentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $appointments = (Gate::allows('ViewAll'))
            ? Appointment::with('user')->get()
            : Appointment::with('user')->where('user_id', Auth::id())->get();
        return view('appointments.index', ['appointments' => $appointments, 'user_role' => Auth::user()->role]);
    }

    public function GetTodayAppointments()
    {   

        $appointments = Appointment::with('user')->where('date', now()->format('Y-m-d'))->get();
        return view('appointments.day', compact('appointments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('appointments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAppoitmentRequest $request)
    {
        $validated = $request->validated();

        $validated['user_id'] = Auth::id();

        Appointment::create($validated);

        return redirect()->route('appointments.index')
            ->with('success', 'Appointment scheduled successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        if ($appointment->user_id !== Auth::id() && !Gate::allows('ViewAll')) {
            abort(403);
        }

        return view('appointments.show', compact('appointment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        if ($appointment->user_id !== Auth::id() && !Gate::allows('ViewAll')) {
            abort(403);
        }

        return view('appointments.edit', compact('appointment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreAppoitmentRequest $request, Appointment $appointment)
    {
        if ($appointment->user_id !== Auth::id() && !Gate::allows('ViewAll')) {
            abort(403);
        }

        $appointment->update($request->validated());

        return redirect()->route('appointments.show', $appointment->id)
            ->with('success', 'Appointment updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        if ($appointment->user_id !== Auth::id() && !Gate::allows('ViewAll')) {
            abort(403);
        }

        $appointment->delete();

        return redirect()->route('appointments.index')
            ->with('success', 'Appointment cancelled successfully!');
    }
}
