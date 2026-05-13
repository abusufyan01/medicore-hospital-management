@extends('layouts.app')

@section('title', 'Add Record')
@section('header_title', 'New Medical Entry')

@section('content')
<div class="max-w-4xl mx-auto">
    <a href="{{ url()->previous() }}" class="inline-flex items-center text-sm text-slate-500 hover:text-blue-600 mb-6 transition-colors font-medium">
        <i data-feather="arrow-left" class="w-4 h-4 mr-2"></i> Back
    </a>
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-[2rem] border border-slate-200 shadow-sm overflow-hidden p-10">
        <form action="{{ route('medical_records.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Patient</label>
                    <select name="patient_id" class="w-full border border-slate-200 rounded-xl px-4 py-3 outline-none focus:ring-4 focus:ring-blue-50 bg-white" required>
                        @foreach($patients as $patient)
                            <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Doctor</label>
                    <select name="doctor_id" class="w-full border border-slate-200 rounded-xl px-4 py-3 outline-none focus:ring-4 focus:ring-blue-50 bg-white" required>
                        @foreach($doctors as $doctor)
                            <option value="{{ $doctor->id }}">Dr. {{ $doctor->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Diagnosis</label>
                    <textarea name="diagnosis" rows="3" class="w-full border border-slate-200 rounded-xl px-4 py-3 outline-none focus:ring-4 focus:ring-blue-50" required placeholder="Describe the medical condition..."></textarea>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Prescription</label>
                    <textarea name="prescription" rows="3" class="w-full border border-slate-200 rounded-xl px-4 py-3 outline-none focus:ring-4 focus:ring-blue-50" required placeholder="Medication and dosage..."></textarea>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Additional Notes</label>
                    <textarea name="notes" rows="2" class="w-full border border-slate-200 rounded-xl px-4 py-3 outline-none focus:ring-4 focus:ring-blue-50" placeholder="Optional comments..."></textarea>
                </div>
            </div>
            <div class="mt-12 flex gap-4">
                <button type="submit" class="bg-blue-600 text-white px-10 py-4 rounded-2xl font-bold shadow-lg shadow-blue-100 hover:bg-blue-700 transition-all">
                    Save Medical Record
                </button>
                <a href="{{ route('medical_records.index') }}" class="bg-slate-100 text-slate-600 px-10 py-4 rounded-2xl font-bold hover:bg-slate-200 transition-all">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection