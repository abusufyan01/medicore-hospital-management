<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;

class PatientApiController extends Controller
{
    // GET /api/patients
    public function index()
    {
        $patients = Patient::latest()->get();
        return response()->json([
            'success' => true,
            'data'    => $patients
        ]);
    }

    // GET /api/patients/{id}
    public function show(string $id)
    {
        $patient = Patient::find($id);

        if (!$patient) {
            return response()->json([
                'success' => false,
                'message' => 'Patient not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $patient
        ]);
    }

    // POST /api/patients
    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:patients,email',
            'phone'         => 'required|string|max:20',
            'gender'        => 'required|in:male,female',
            'blood_group'   => 'required|in:A+,A-,B+,B-,O+,O-,AB+,AB-',
            'date_of_birth' => 'nullable|date',
            'address'       => 'nullable|string|max:255',
        ]);

        $patient = Patient::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Patient created successfully',
            'data'    => $patient
        ], 201);
    }

    // PUT /api/patients/{id}
    public function update(Request $request, string $id)
    {
        $patient = Patient::find($id);

        if (!$patient) {
            return response()->json([
                'success' => false,
                'message' => 'Patient not found'
            ], 404);
        }

        $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:patients,email,' . $patient->id,
            'phone'         => 'required|string|max:20',
            'gender'        => 'required|in:male,female',
            'blood_group'   => 'required|in:A+,A-,B+,B-,O+,O-,AB+,AB-',
            'date_of_birth' => 'nullable|date',
            'address'       => 'nullable|string|max:255',
        ]);

        $patient->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Patient updated successfully',
            'data'    => $patient
        ]);
    }

    // DELETE /api/patients/{id}
    public function destroy(string $id)
    {
        $patient = Patient::find($id);

        if (!$patient) {
            return response()->json([
                'success' => false,
                'message' => 'Patient not found'
            ], 404);
        }

        $patient->delete();

        return response()->json([
            'success' => true,
            'message' => 'Patient deleted successfully'
        ]);
    }
}