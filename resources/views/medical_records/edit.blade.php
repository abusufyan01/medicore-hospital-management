@extends('layouts.app')

@section('title', 'Edit Medical Record')
@section('header_title', 'Update Clinical Entry')

@section('content')
<div class="max-w-4xl mx-auto">
    <a href="{{ route('medical_records.index') }}" class="inline-flex items-center text-sm text-slate-500 hover:text-blue-600 mb-6 transition-colors font-medium">
        <i data-feather="arrow-left" class="w-4 h-4 mr-2"></i> Back to Records
    </a>

    <div class="bg-white rounded-[2rem] border border-slate-200 shadow-sm overflow-hidden p-10">
        <form action="{{ route('medical_records.update', $medicalRecord->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Patient</label>
                    <select name="patient_id" class="w-full border border-slate-200 rounded-xl px-4 py-3 outline-none focus:ring-4 focus:ring-blue-50 bg-white" required>
                        @foreach($patients as $patient)
                            <option value="{{ $patient->id }}" {{ $medicalRecord->patient_id == $patient->id ? 'selected' : '' }}>
                                {{ $patient->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Attending Doctor</label>
                    <select name="doctor_id" class="w-full border border-slate-200 rounded-xl px-4 py-3 outline-none focus:ring-4 focus:ring-blue-50 bg-white" required>
                        @foreach($doctors as $doctor)
                            <option value="{{ $doctor->id }}" {{ $medicalRecord->doctor_id == $doctor->id ? 'selected' : '' }}>
                                Dr. {{ $doctor->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Diagnosis</label>
                    <textarea name="diagnosis" rows="4" class="w-full border border-slate-200 rounded-xl px-4 py-3 outline-none focus:ring-4 focus:ring-blue-50 font-medium text-slate-700" required>{{ old('diagnosis', $medicalRecord->diagnosis) }}</textarea>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Prescription & Dosage</label>
                    <textarea name="prescription" rows="4" class="w-full border border-slate-200 rounded-xl px-4 py-3 outline-none focus:ring-4 focus:ring-blue-50 font-mono text-sm text-blue-700 bg-blue-50/30" required>{{ old('prescription', $medicalRecord->prescription) }}</textarea>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Internal Notes (Optional)</label>
                    <textarea name="notes" rows="2" class="w-full border border-slate-200 rounded-xl px-4 py-3 outline-none focus:ring-4 focus:ring-blue-50" placeholder="Any additional observations...">{{ old('notes', $medicalRecord->notes) }}</textarea>
                </div>
            </div>

            <div class="mt-12 flex gap-4">
                <button type="submit" class="bg-blue-600 text-white px-10 py-4 rounded-2xl font-bold shadow-lg shadow-blue-100 hover:bg-blue-700 transition-all flex items-center gap-2">
                    <i data-feather="save" class="w-5 h-5"></i> Update Medical Record
                </button>
                <a href="{{ route('medical_records.index') }}" class="bg-slate-100 text-slate-600 px-10 py-4 rounded-2xl font-bold hover:bg-slate-200 transition-all">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection