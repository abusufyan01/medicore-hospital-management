@extends('layouts.app')

@section('title', 'Doctor Details')
@section('header_title', 'Doctor Details')

@section('content')
<div class="mb-6">
    <a href="{{ route('doctors.index') }}"
        class="flex items-center gap-2 text-slate-500 hover:text-slate-700 text-sm font-medium w-fit">
        <i data-feather="arrow-left" class="w-4 h-4"></i>
        Back to Doctors
    </a>
</div>

<div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8">
    <div class="flex items-center gap-6 mb-8 pb-8 border-b border-slate-100">
        <div class="w-20 h-20 rounded-2xl bg-emerald-50 flex items-center justify-center">
            <i data-feather="shield" class="w-10 h-10 text-emerald-600"></i>
        </div>
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Dr. {{ $doctor->name }}</h2>
            <p class="text-slate-500">{{ $doctor->specialization ?? 'No specialization' }}</p>
        </div>
        <div class="ml-auto flex gap-3">
            <a href="{{ route('doctors.edit', $doctor->id) }}"
                class="flex items-center gap-2 bg-amber-50 text-amber-600 px-4 py-2 rounded-xl text-sm font-bold hover:bg-amber-100 transition-all">
                <i data-feather="edit" class="w-4 h-4"></i>
                Edit
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Email</p>
            <p class="text-slate-700 font-medium">{{ $doctor->email }}</p>
        </div>
        <div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Phone</p>
            <p class="text-slate-700 font-medium">{{ $doctor->phone ?? 'N/A' }}</p>
        </div>
        <div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Specialization</p>
            <p class="text-slate-700 font-medium">{{ $doctor->specialization ?? 'N/A' }}</p>
        </div>
        <div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Qualification</p>
            <p class="text-slate-700 font-medium">{{ $doctor->qualification ?? 'N/A' }}</p>
        </div>
        <div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Available From</p>
            <p class="text-slate-700 font-medium">{{ $doctor->start_time ?? 'N/A' }}</p>
        </div>
        <div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Available Until</p>
            <p class="text-slate-700 font-medium">{{ $doctor->end_time ?? 'N/A' }}</p>
        </div>
    </div>
</div>
@endsection