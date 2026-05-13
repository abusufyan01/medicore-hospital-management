@extends('layouts.app')

@section('title', 'Patient History')
@section('header_title', 'Patient Medical History')

@section('content')

{{-- Back button --}}
<div class="mb-6">
    <a href="{{ route('patients.index') }}"
        class="flex items-center gap-2 text-slate-500 hover:text-slate-700 text-sm font-medium w-fit">
        <i data-feather="arrow-left" class="w-4 h-4"></i>
        Back to Patients
    </a>
</div>

{{-- Patient Profile Card --}}
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8 mb-6">
    <div class="flex items-center gap-6 pb-8 border-b border-slate-100">

        {{-- Avatar --}}
        <div class="w-20 h-20 rounded-2xl bg-blue-50 flex items-center justify-center">
            <i data-feather="user" class="w-10 h-10 text-blue-600"></i>
        </div>

        {{-- Basic Info --}}
        <div>
            <h2 class="text-2xl font-bold text-slate-800">{{ $patient->name }}</h2>
            <p class="text-slate-500 mt-1">{{ $patient->email }}</p>
            <div class="flex items-center gap-3 mt-2">
                <span class="text-xs font-bold px-3 py-1 rounded-full bg-blue-50 text-blue-600">
                    {{ $patient->blood_group }}
                </span>
                <span class="text-xs font-bold px-3 py-1 rounded-full bg-slate-100 text-slate-600 capitalize">
                    {{ $patient->gender }}
                </span>
            </div>
        </div>

        {{-- Edit button --}}
        <div class="ml-auto">
            <a href="{{ route('patients.edit', $patient->id) }}"
                class="flex items-center gap-2 bg-amber-50 text-amber-600 px-4 py-2 rounded-xl text-sm font-bold hover:bg-amber-100 transition-all">
                <i data-feather="edit" class="w-4 h-4"></i>
                Edit Patient
            </a>
        </div>
    </div>

    {{-- Patient Details Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
        <div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Phone</p>
            <p class="text-slate-700 font-medium">{{ $patient->phone ?? 'N/A' }}</p>
        </div>
        <div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Date of Birth</p>
            <p class="text-slate-700 font-medium">{{ $patient->date_of_birth ?? 'N/A' }}</p>
        </div>
        <div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Address</p>
            <p class="text-slate-700 font-medium">{{ $patient->address ?? 'N/A' }}</p>
        </div>
    </div>
</div>

{{-- Stats Row --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
    <div class="bg-blue-600 rounded-2xl p-6 text-white">
        <div class="flex items-center gap-3 mb-2">
            <i data-feather="file-text" class="w-5 h-5"></i>
            <span class="font-bold">Medical Records</span>
        </div>
        <h3 class="text-4xl font-bold">{{ $patient->medicalRecords->count() }}</h3>
        <p class="text-blue-200 text-sm mt-1">Total records</p>
    </div>
    <div class="bg-violet-600 rounded-2xl p-6 text-white">
        <div class="flex items-center gap-3 mb-2">
            <i data-feather="calendar" class="w-5 h-5"></i>
            <span class="font-bold">Total Appointments</span>
        </div>
        <h3 class="text-4xl font-bold">{{ $patient->appointments->count() }}</h3>
        <p class="text-violet-200 text-sm mt-1">All time</p>
    </div>
    <div class="bg-emerald-600 rounded-2xl p-6 text-white">
        <div class="flex items-center gap-3 mb-2">
            <i data-feather="check-circle" class="w-5 h-5"></i>
            <span class="font-bold">Confirmed</span>
        </div>
        <h3 class="text-4xl font-bold">
            {{ $patient->appointments->where('status', 'confirmed')->count() }}
        </h3>
        <p class="text-emerald-200 text-sm mt-1">Confirmed appointments</p>
    </div>
</div>

{{-- Medical Records --}}
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8 mb-6">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-lg font-bold text-slate-800">Medical Records</h3>
        <a href="{{ route('medical_records.create') }}"
            class="flex items-center gap-2 bg-blue-50 text-blue-600 px-4 py-2 rounded-xl text-sm font-bold hover:bg-blue-100 transition-all">
            <i data-feather="plus" class="w-4 h-4"></i>
            Add Record
        </a>
    </div>

    @forelse($patient->medicalRecords as $record)
        <div class="p-5 rounded-xl border border-slate-100 mb-3 hover:border-blue-200 transition-all">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="p-2 bg-rose-50 rounded-lg">
                            <i data-feather="file-text" class="w-4 h-4 text-rose-600"></i>
                        </div>
                        <p class="font-bold text-slate-700">{{ $record->diagnosis }}</p>
                    </div>
                    <div class="ml-11">
                        <p class="text-sm text-slate-500 mb-1">
                            <span class="font-medium">Prescription:</span>
                            {{ $record->prescription }}
                        </p>
                        @if($record->notes)
                        <p class="text-sm text-slate-500">
                            <span class="font-medium">Notes:</span>
                            {{ $record->notes }}
                        </p>
                        @endif
                        <p class="text-xs text-slate-400 mt-2">
                            Doctor: Dr. {{ $record->doctor->name ?? 'N/A' }}
                            • {{ $record->created_at->format('M d, Y') }}
                        </p>
                    </div>
                </div>
                <a href="{{ route('medical_records.show', $record->id) }}"
                    class="text-xs text-blue-600 font-bold hover:underline ml-4">
                    View →
                </a>
            </div>
        </div>
    @empty
        <div class="text-center py-8 text-slate-400">
            <i data-feather="file-text" class="w-10 h-10 mx-auto mb-3"></i>
            <p class="text-sm">No medical records found for this patient</p>
        </div>
    @endforelse
</div>

{{-- Appointments History --}}
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-lg font-bold text-slate-800">Appointment History</h3>
        <a href="{{ route('appointments.create') }}"
            class="flex items-center gap-2 bg-violet-50 text-violet-600 px-4 py-2 rounded-xl text-sm font-bold hover:bg-violet-100 transition-all">
            <i data-feather="plus" class="w-4 h-4"></i>
            New Appointment
        </a>
    </div>

    @forelse($patient->appointments as $appointment)
        <div class="p-5 rounded-xl border border-slate-100 mb-3 hover:border-violet-200 transition-all">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-violet-50 rounded-lg">
                        <i data-feather="calendar" class="w-4 h-4 text-violet-600"></i>
                    </div>
                    <div>
                        <p class="font-bold text-slate-700">
                            {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y') }}
                            at {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('g:i A') }}
                        </p>
                        <p class="text-sm text-slate-500">
                            Dr. {{ $appointment->doctor->name ?? 'N/A' }}
                            @if($appointment->notes)
                                • {{ $appointment->notes }}
                            @endif
                        </p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <span class="text-xs font-bold px-3 py-1 rounded-full
                        {{ $appointment->status === 'confirmed' ? 'bg-emerald-50 text-emerald-600' : '' }}
                        {{ $appointment->status === 'pending' ? 'bg-amber-50 text-amber-600' : '' }}
                        {{ $appointment->status === 'cancelled' ? 'bg-rose-50 text-rose-600' : '' }}">
                        {{ ucfirst($appointment->status) }}
                    </span>
                    <a href="{{ route('appointments.show', $appointment->id) }}"
                        class="text-xs text-blue-600 font-bold hover:underline">
                        View →
                    </a>
                </div>
            </div>
        </div>
    @empty
        <div class="text-center py-8 text-slate-400">
            <i data-feather="calendar" class="w-10 h-10 mx-auto mb-3"></i>
            <p class="text-sm">No appointments found for this patient</p>
        </div>
    @endforelse
</div>

@endsection