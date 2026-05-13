<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::latest()->get();
        return view('patients.index', compact('patients'));
    }

    public function create()
    {
        return view('patients.create'); 
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
        
            'name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'email' => 'required|email|max:255|unique:patients,email',
            'phone' => 'required|regex:/^[0-9]{10,15}$/',
            'gender' => 'required|in:male,female',
            'blood_group' => 'required|in:A+,A-,B+,B-,O+,O-,AB+,AB-',
            'date_of_birth' => 'nullable|date|before:today',
            'address' => 'nullable|string|max:255',
        ], [
            'name.regex' => 'Name can only contain letters and spaces.',
            'phone.regex' => 'Phone number must be 10 to 15 digits only.',
            'date_of_birth.before' => 'Date of birth must be in the past.',
        ]);

        Patient::create($validated);

        return redirect()->route('patients.index')
                         ->with('success', 'Patient added successfully.');
    }

    public function show(string $id)
    {
        $patient = Patient::with([
        'medicalRecords.doctor',
        'appointments.doctor'
    ])->findOrFail($id);

    return view('patients.show', compact('patient'));
    }

    public function edit(string $id)
    {
        $patient = Patient::findOrFail($id);
        return view('patients.edit', compact('patient'));
    }

    public function update(Request $request, string $id)
    {
        $patient = Patient::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',

            // Ignore current record for unique email
            'email' => 'required|email|max:255|unique:patients,email,' . $patient->id,

            'phone' => 'required|regex:/^[0-9]{10,15}$/',

            'gender' => 'required|in:male,female',

            'blood_group' => 'required|in:A+,A-,B+,B-,O+,O-,AB+,AB-',

            'date_of_birth' => 'nullable|date|before:today',

            'address' => 'nullable|string|max:255',
        ], [
            'name.regex' => 'Name can only contain letters and spaces.',
            'phone.regex' => 'Phone number must be 10 to 15 digits only.',
            'date_of_birth.before' => 'Date of birth must be in the past.',
        ]);

        $patient->update($validated);

        return redirect()->route('patients.index')
                         ->with('success', 'Patient updated successfully.');
    }

    public function destroy(string $id)
    {
        $patient = Patient::findOrFail($id);
        $patient->delete();

        return redirect()->route('patients.index')
                         ->with('success', 'Patient deleted successfully.');
    }
}