@extends('layouts.app')

@section('title', 'Dashboard')
@section('header_title', 'Overview')

@section('content')

{{-- Stats Cards --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

    {{-- Total Patients --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
        <div class="flex items-center justify-between mb-4">
            <div class="p-3 bg-blue-50 rounded-xl">
                <i data-feather="users" class="w-6 h-6 text-blue-600"></i>
            </div>
            <span class="text-xs font-bold text-emerald-500 bg-emerald-50 px-2 py-1 rounded-full">Total</span>
        </div>
        <h3 class="text-3xl font-bold text-slate-800">{{ $totalPatients }}</h3>
        <p class="text-slate-500 text-sm mt-1">Patients</p>
        <a href="{{ route('patients.index') }}" class="text-blue-600 text-xs font-bold mt-3 inline-block hover:underline">
            View all →
        </a>
    </div>

    {{-- Total Doctors --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
        <div class="flex items-center justify-between mb-4">
            <div class="p-3 bg-emerald-50 rounded-xl">
                <i data-feather="shield" class="w-6 h-6 text-emerald-600"></i>
            </div>
            <span class="text-xs font-bold text-emerald-500 bg-emerald-50 px-2 py-1 rounded-full">Total</span>
        </div>
        <h3 class="text-3xl font-bold text-slate-800">{{ $totalDoctors }}</h3>
        <p class="text-slate-500 text-sm mt-1">Doctors</p>
        <a href="{{ route('doctors.index') }}" class="text-emerald-600 text-xs font-bold mt-3 inline-block hover:underline">
            View all →
        </a>
    </div>

    {{-- Total Appointments --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
        <div class="flex items-center justify-between mb-4">
            <div class="p-3 bg-violet-50 rounded-xl">
                <i data-feather="calendar" class="w-6 h-6 text-violet-600"></i>
            </div>
            <span class="text-xs font-bold text-violet-500 bg-violet-50 px-2 py-1 rounded-full">Total</span>
        </div>
        <h3 class="text-3xl font-bold text-slate-800">{{ $totalAppointments }}</h3>
        <p class="text-slate-500 text-sm mt-1">Appointments</p>
        <a href="{{ route('appointments.index') }}" class="text-violet-600 text-xs font-bold mt-3 inline-block hover:underline">
            View all →
        </a>
    </div>

    {{-- Total Medical Records --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
        <div class="flex items-center justify-between mb-4">
            <div class="p-3 bg-rose-50 rounded-xl">
                <i data-feather="file-text" class="w-6 h-6 text-rose-600"></i>
            </div>
            <span class="text-xs font-bold text-rose-500 bg-rose-50 px-2 py-1 rounded-full">Total</span>
        </div>
        <h3 class="text-3xl font-bold text-slate-800">{{ $totalRecords }}</h3>
        <p class="text-slate-500 text-sm mt-1">Medical Records</p>
        <a href="{{ route('medical_records.index') }}" class="text-rose-600 text-xs font-bold mt-3 inline-block hover:underline">
            View all →
        </a>
    </div>

</div>

{{-- Appointment Status Row --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

    {{-- Today's Appointments --}}
    <div class="bg-blue-600 rounded-2xl p-6 text-white">
        <div class="flex items-center gap-3 mb-3">
            <i data-feather="clock" class="w-5 h-5"></i>
            <span class="font-bold">Today's Appointments</span>
        </div>
        <h3 class="text-4xl font-bold">{{ $todayAppointments }}</h3>
        <p class="text-blue-200 text-sm mt-1">Scheduled for today</p>
    </div>

    {{-- Pending Appointments --}}
    <div class="bg-amber-500 rounded-2xl p-6 text-white">
        <div class="flex items-center gap-3 mb-3">
            <i data-feather="alert-circle" class="w-5 h-5"></i>
            <span class="font-bold">Pending</span>
        </div>
        <h3 class="text-4xl font-bold">{{ $pendingAppointments }}</h3>
        <p class="text-amber-100 text-sm mt-1">Awaiting confirmation</p>
    </div>

    {{-- Confirmed Appointments --}}
    <div class="bg-emerald-500 rounded-2xl p-6 text-white">
        <div class="flex items-center gap-3 mb-3">
            <i data-feather="check-circle" class="w-5 h-5"></i>
            <span class="font-bold">Confirmed</span>
        </div>
        <h3 class="text-4xl font-bold">{{ $confirmedAppointments }}</h3>
        <p class="text-emerald-100 text-sm mt-1">Ready to go</p>
    </div>

</div>

{{-- Quick Actions --}}
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
    <h3 class="text-lg font-bold text-slate-800 mb-4">Quick Actions</h3>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <a href="{{ route('patients.create') }}"
            class="flex items-center gap-3 p-4 rounded-xl border border-slate-200 hover:border-blue-300 hover:bg-blue-50 transition-all group">
            <div class="p-2 bg-blue-50 rounded-lg group-hover:bg-blue-100">
                <i data-feather="user-plus" class="w-5 h-5 text-blue-600"></i>
            </div>
            <span class="text-sm font-bold text-slate-700">Add Patient</span>
        </a>
        <a href="{{ route('doctors.create') }}"
            class="flex items-center gap-3 p-4 rounded-xl border border-slate-200 hover:border-emerald-300 hover:bg-emerald-50 transition-all group">
            <div class="p-2 bg-emerald-50 rounded-lg group-hover:bg-emerald-100">
                <i data-feather="user-plus" class="w-5 h-5 text-emerald-600"></i>
            </div>
            <span class="text-sm font-bold text-slate-700">Add Doctor</span>
        </a>
        <a href="{{ route('appointments.create') }}"
            class="flex items-center gap-3 p-4 rounded-xl border border-slate-200 hover:border-violet-300 hover:bg-violet-50 transition-all group">
            <div class="p-2 bg-violet-50 rounded-lg group-hover:bg-violet-100">
                <i data-feather="calendar-plus" class="w-5 h-5 text-violet-600"></i>
            </div>
            <span class="text-sm font-bold text-slate-700">New Appointment</span>
        </a>
        <a href="{{ route('medical_records.create') }}"
            class="flex items-center gap-3 p-4 rounded-xl border border-slate-200 hover:border-rose-300 hover:bg-rose-50 transition-all group">
            <div class="p-2 bg-rose-50 rounded-lg group-hover:bg-rose-100">
                <i data-feather="file-plus" class="w-5 h-5 text-rose-600"></i>
            </div>
            <span class="text-sm font-bold text-slate-700">Add Record</span>
        </a>
    </div>
</div>

@endsection











{{-- @extends('layouts.app')

@section('title', 'Dashboard')
@section('header_title', 'System Overview')

@section('content')
<div class="mb-10">
    <h2 class="text-3xl font-black text-slate-900 tracking-tight">Welcome back, MediCore Admin</h2>
    <p class="text-slate-500 font-medium mt-1">Here is what's happening in your hospital today.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    
    <a href="{{ route('patients.index') }}" class="group card-container hover:border-blue-400 hover:shadow-2xl hover:shadow-blue-100 transition-all duration-300 transform hover:-translate-y-1">
        <div class="w-16 h-16 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
            <i data-feather="users" class="w-8 h-8"></i>
        </div>
        <h3 class="text-2xl font-bold text-slate-800">Patients</h3>
        <p class="text-slate-500 text-sm mt-2 leading-relaxed">Access patient registries, medical histories, and contact information.</p>
        <div class="mt-6 flex items-center text-blue-600 font-bold text-sm">
            Manage Patients <i data-feather="arrow-right" class="w-4 h-4 ml-2"></i>
        </div>
    </a>

    <a href="{{ route('doctors.index') }}" class="group card-container hover:border-emerald-400 hover:shadow-2xl hover:shadow-emerald-100 transition-all duration-300 transform hover:-translate-y-1">
        <div class="w-16 h-16 bg-emerald-100 text-emerald-600 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-emerald-600 group-hover:text-white transition-colors duration-300">
            <i data-feather="shield" class="w-8 h-8"></i>
        </div>
        <h3 class="text-2xl font-bold text-slate-800">Doctors</h3>
        <p class="text-slate-500 text-sm mt-2 leading-relaxed">Directory of hospital specialists, qualifications, and department info.</p>
        <div class="mt-6 flex items-center text-emerald-600 font-bold text-sm">
            View Specialists <i data-feather="arrow-right" class="w-4 h-4 ml-2"></i>
        </div>
    </a>

    <a href="{{ route('appointments.index') }}" class="group card-container hover:border-amber-400 hover:shadow-2xl hover:shadow-amber-100 transition-all duration-300 transform hover:-translate-y-1">
        <div class="w-16 h-16 bg-amber-100 text-amber-600 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-amber-600 group-hover:text-white transition-colors duration-300">
            <i data-feather="calendar" class="w-8 h-8"></i>
        </div>
        <h3 class="text-2xl font-bold text-slate-800">Appointments</h3>
        <p class="text-slate-500 text-sm mt-2 leading-relaxed">Schedule new visits, confirm bookings, and manage the daily queue.</p>
        <div class="mt-6 flex items-center text-amber-600 font-bold text-sm">
            Check Schedule <i data-feather="arrow-right" class="w-4 h-4 ml-2"></i>
        </div>
    </a>

    <a href="{{ route('medical_records.index') }}" class="group card-container hover:border-indigo-400 hover:shadow-2xl hover:shadow-indigo-100 transition-all duration-300 transform hover:-translate-y-1">
        <div class="w-16 h-16 bg-indigo-100 text-indigo-600 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-indigo-600 group-hover:text-white transition-colors">
            <i data-feather="file-text" class="w-8 h-8"></i>
        </div>
        <h3 class="text-2xl font-bold text-slate-800">Records</h3>
        <p class="text-slate-500 text-sm mt-2 leading-relaxed">Archive of all clinical notes, prescriptions, and diagnoses.</p>
        <div class="mt-6 flex items-center text-indigo-600 font-bold text-sm">
            View Archive <i data-feather="arrow-right" class="w-4 h-4 ml-2"></i>
        </div>
    </a>
</div>

<div class="mt-12 p-8 bg-slate-900 rounded-[2.5rem] text-white flex justify-between items-center shadow-xl shadow-slate-200">
    <div>
        <h4 class="text-lg font-bold">Need Help?</h4>
        <p class="text-slate-400 text-sm">Contact system administrator for technical support.</p>
    </div>
    <button class="bg-white text-slate-900 px-6 py-3 rounded-xl font-bold hover:bg-slate-100 transition-colors shadow-lg">
        System Logs
    </button>
</div>
@endsection --}}