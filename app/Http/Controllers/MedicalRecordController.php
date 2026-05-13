<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedicalRecord;
use App\Models\Patient;
use App\Models\Doctor;

class MedicalRecordController extends Controller
{
    
    public function index()
    {
      
        $medicalRecords = MedicalRecord::with('patient', 'doctor')->latest()->get();
        return view('medical_records.index', compact('medicalRecords'));
    }

    
    public function create()
    {
        $patients = Patient::all();
        $doctors = Doctor::all();
        return view('medical_records.create', compact('patients', 'doctors'));
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'patient_id'   => 'required|exists:patients,id',
            'doctor_id'    => 'required|exists:doctors,id',
            'diagnosis'    => 'required|string',
            'prescription' => 'required|string',
            'notes'        => 'nullable|string',
        ]);

        MedicalRecord::create($request->all());

        return redirect()->route('medical_records.index')
                         ->with('success', 'Medical record added successfully.');
    }

    public function show(string $id)
    {
        $medicalRecord = MedicalRecord::with('patient', 'doctor')->findOrFail($id);
        return view('medical_records.show', compact('medicalRecord'));
    }

    
    public function edit(string $id)
    {
        $medicalRecord = MedicalRecord::findOrFail($id);
        $patients = Patient::all();
        $doctors = Doctor::all();
        return view('medical_records.edit', compact('medicalRecord', 'patients', 'doctors'));
    }

    
    public function update(Request $request, string $id)
    {
        $medicalRecord = MedicalRecord::findOrFail($id);

        $request->validate([
            'patient_id'   => 'required|exists:patients,id',
            'doctor_id'    => 'required|exists:doctors,id',
            'diagnosis'    => 'required|string',
            'prescription' => 'required|string',
            'notes'        => 'nullable|string',
        ]);

        $medicalRecord->update($request->all());

        return redirect()->route('medical_records.index')
                         ->with('success', 'Medical record updated successfully.');
    }

  
    public function destroy(string $id)
    {
        $medicalRecord = MedicalRecord::findOrFail($id);
        $medicalRecord->delete();

        return redirect()->route('medical_records.index')
                         ->with('success', 'Medical record deleted successfully.');
    }
}