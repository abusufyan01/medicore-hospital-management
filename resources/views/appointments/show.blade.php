@extends('layouts.app')

@section('title', 'Appointment Details')
@section('header_title', 'Appointment Details')

@section('content')
<div class="mb-6">
    {{-- <a href="{{ route('appointments.index') }}"
        class="flex items-center gap-2 text-slate-500 hover:text-slate-700 text-sm font-medium w-fit">
        <i data-feather="arrow-left" class="w-4 h-4"></i>
        Back to Appointments
    </a> --}}
    <a href="{{ url()->previous() }}"
    class="flex items-center gap-2 text-slate-500 hover:text-slate-700 text-sm font-medium w-fit">
    <i data-feather="arrow-left" class="w-4 h-4"></i>
    Back
</a>
</div>

<div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8">
    <div class="flex items-center gap-6 mb-8 pb-8 border-b border-slate-100">
        <div class="w-20 h-20 rounded-2xl bg-violet-50 flex items-center justify-center">
            <i data-feather="calendar" class="w-10 h-10 text-violet-600"></i>
        </div>
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Appointment Details</h2>
            <span class="text-sm font-bold px-3 py-1 rounded-full
                {{ $appointment->status === 'confirmed' ? 'bg-emerald-50 text-emerald-600' : '' }}
                {{ $appointment->status === 'pending' ? 'bg-amber-50 text-amber-600' : '' }}
                {{ $appointment->status === 'cancelled' ? 'bg-rose-50 text-rose-600' : '' }}">
                {{ ucfirst($appointment->status) }}
            </span>
        </div>
        <div class="ml-auto">
            <a href="{{ route('appointments.edit', $appointment->id) }}"
                class="flex items-center gap-2 bg-amber-50 text-amber-600 px-4 py-2 rounded-xl text-sm font-bold hover:bg-amber-100 transition-all">
                <i data-feather="edit" class="w-4 h-4"></i>
                Edit
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Patient</p>
            <p class="text-slate-700 font-medium">{{ $appointment->patient->name ?? 'N/A' }}</p>
        </div>
        <div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Doctor</p>
            <p class="text-slate-700 font-medium">Dr. {{ $appointment->doctor->name ?? 'N/A' }}</p>
        </div>
        <div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Date</p>
            <p class="text-slate-700 font-medium">{{ $appointment->appointment_date }}</p>
        </div>
        <div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Time</p>
            <p class="text-slate-700 font-medium">{{ $appointment->appointment_time }}</p>
        </div>
        <div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Status</p>
            <p class="text-slate-700 font-medium capitalize">{{ $appointment->status }}</p>
        </div>
        <div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Notes</p>
            <p class="text-slate-700 font-medium">{{ $appointment->notes ?? 'N/A' }}</p>
        </div>
    </div>
</div>
@endsection