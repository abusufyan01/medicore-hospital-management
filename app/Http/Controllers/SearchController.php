<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\MedicalRecord;
use App\Models\Appointment;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->get('query');

        if (strlen($query) < 2) {
            return response()->json([]);
        }

        // Search patients
        $patients = Patient::where('name', 'like', "%{$query}%")
            ->orWhere('email', 'like', "%{$query}%")
            ->orWhere('blood_group', 'like', "%{$query}%")
            ->orWhere('phone', 'like', "%{$query}%")
            ->limit(5)
            ->get()
            ->map(function ($patient) {
                return [
                    'type'     => 'patient',
                    'id'       => $patient->id,
                    'title'    => $patient->name,
                    'subtitle' => $patient->blood_group . ' • ' . $patient->phone,
                    'url'      => route('patients.show', $patient->id),
                ];
            });

        // Search doctors
        $doctors = Doctor::where('name', 'like', "%{$query}%")
            ->orWhere('specialization', 'like', "%{$query}%")
            ->orWhere('qualification', 'like', "%{$query}%")
            ->orWhere('email', 'like', "%{$query}%")
            ->limit(5)
            ->get()
            ->map(function ($doctor) {
                return [
                    'type'     => 'doctor',
                    'id'       => $doctor->id,
                    'title'    => $doctor->name,
                    'subtitle' => $doctor->specialization . ' • ' . $doctor->qualification,
                    'url'      => route('doctors.show', $doctor->id),
                ];
            });

        // Search medical records by diagnosis
        $records = MedicalRecord::where('diagnosis', 'like', "%{$query}%")
            ->orWhere('prescription', 'like', "%{$query}%")
            ->with('patient')
            ->limit(5)
            ->get()
            ->map(function ($record) {
                return [
                    'type'     => 'record',
                    'id'       => $record->id,
                    'title'    => $record->diagnosis,
                    'subtitle' => 'Patient: ' . ($record->patient->name ?? 'N/A'),
                    'url'      => route('medical_records.show', $record->id),
                ];
            });

        // Search appointments
        $appointments = Appointment::where('status', 'like', "%{$query}%")
            ->orWhere('notes', 'like', "%{$query}%")
            ->with('patient', 'doctor')
            ->limit(5)
            ->get()
            ->map(function ($appointment) {
                return [
                    'type'     => 'appointment',
                    'id'       => $appointment->id,
                    'title'    => ($appointment->patient->name ?? 'N/A') . ' → Dr. ' . ($appointment->doctor->name ?? 'N/A'),
                    'subtitle' => $appointment->appointment_date . ' • ' . $appointment->status,
                    'url'      => route('appointments.show', $appointment->id),
                ];
            });

        $results = [
            'patients'     => $patients,
            'doctors'      => $doctors,
            'records'      => $records,
            'appointments' => $appointments,
        ];

        return response()->json($results);
    }
}