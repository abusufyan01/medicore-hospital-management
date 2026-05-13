<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Doctor;

class AppointmentController extends Controller
{
    public function index()
    {
        
        $appointments = Appointment::with('patient', 'doctor')->latest()->get();
        return view('appointments.index', compact('appointments'));
    }

   
    public function create()
    {
        
        $patients = Patient::all();
        $doctors = Doctor::all();
        return view('appointments.create', compact('patients', 'doctors'));
    }

    public function store(Request $request)
{
    $request->validate([
        'patient_id'       => 'required|exists:patients,id',
        'doctor_id'        => 'required|exists:doctors,id',
        'appointment_date' => 'required|date|after_or_equal:today',
        'appointment_time' => 'required',
        'status'           => 'required|in:pending,confirmed,cancelled',
    ]);

    $doctor = Doctor::findOrFail($request->doctor_id);
    $requestedTime = $request->appointment_time;

    // if ($requestedTime < $doctor->start_time || $requestedTime > $doctor->end_time) {
    $start = strtotime($doctor->start_time);
$end   = strtotime($doctor->end_time);
$requested = strtotime($requestedTime);

// Handle overnight schedules (e.g. 6PM to 12AM)
if ($end < $start) {
    $available = ($requested >= $start || $requested <= $end);
} else {
    $available = ($requested >= $start && $requested <= $end);
}

if (!$available) {
        
        $startTime = date("g:i A", strtotime($doctor->start_time));
        $endTime = date("g:i A", strtotime($doctor->end_time));

        return back()
            ->withInput()
            ->withErrors([
                'appointment_time' => "Dr. {$doctor->name} is only available between {$startTime} and {$endTime}."
            ]);
    }

    Appointment::create($request->all());

    return redirect()->route('appointments.index')
                     ->with('success', 'Appointment created successfully.');
}

    public function show(string $id)
    {
        $appointment = Appointment::with('patient', 'doctor')->findOrFail($id);
        return view('appointments.show', compact('appointment'));
    }

    public function edit(string $id)
    {
        $appointment = Appointment::findOrFail($id);
        $patients = Patient::all();
        $doctors = Doctor::all();
        return view('appointments.edit', compact('appointment', 'patients', 'doctors'));
    }

    public function update(Request $request, string $id)
    {
        $appointment = Appointment::findOrFail($id);

        $request->validate([
            'patient_id'       => 'required|exists:patients,id',
            'doctor_id'        => 'required|exists:doctors,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required',
            'status'           => 'required|in:pending,confirmed,cancelled',
            'notes'            => 'nullable|string|max:255',
        ]);

        $appointment->update($request->all());

        return redirect()->route('appointments.index')
                         ->with('success', 'Appointment updated successfully.');
    }

   
    public function destroy(string $id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();

        return redirect()->route('appointments.index')
                         ->with('success', 'Appointment deleted successfully.');
    }
}