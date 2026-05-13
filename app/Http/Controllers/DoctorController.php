<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;

class DoctorController extends Controller
{
   
    public function index()
    {
        $doctors = Doctor::latest()->get();
        return view('doctors.index', compact('doctors'));
    }

    
    public function create()
    {
        return view('doctors.create');
    }

   
    public function store(Request $request)
    {
       $validated = $request->validate([
            'name'           => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'email'          => 'required|string|email|unique:doctors,email',
            'phone'          => 'required|regex:/^\+?[0-9]{10,15}$/',
            'specialization' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'qualification'  => 'nullable|string|max:255',
            'start_time'     => 'required', 
            'end_time'       => 'required',
        ], [
            'name.regex' => 'Name can only contains letters.',
            'phone.regex' => 'Phone number must be 11-15 digits only.',
            'specialization.regex' => 'Specialization can only contains letters.',
        ]);

        Doctor::create($request->all());

        return redirect()->route('doctors.index')
                         ->with('success', 'Doctor added successfully.');
    }

    public function show(string $id)
    {
        $doctor = Doctor::findOrFail($id);
        return view('doctors.show', compact('doctor'));
    }

    public function edit(string $id)
    {
        $doctor = Doctor::findOrFail($id);
        return view('doctors.edit', compact('doctor'));
    }

    
    public function update(Request $request, string $id)
    {
        $doctor = Doctor::findOrFail($id);

      $validated = $request->validate([
            'name'           => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'email'          => 'required|string|email|unique:doctors,email,' . $doctor->id,
            'phone'          => 'required|regex:/^\+?[0-9]{10,15}$/',
            'specialization' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'qualification'  => 'nullable|string|max:255',
            'start_time'     => 'required', 
            'end_time'       => 'required',
        ], [
            'name.regex' => 'Name can only contains characters.',
            'phone.regex' => 'Phone no. must be 10-15 digits only.',
            'specialization.regex' => 'Specialization can only contains letters.',
        ]);

        $doctor->update($request->all());

        return redirect()->route('doctors.index')
                         ->with('success', 'Doctor updated successfully.');
    }

    
    public function destroy(string $id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->delete();

        return redirect()->route('doctors.index')
                         ->with('success', 'Doctor deleted successfully.');
    }
}