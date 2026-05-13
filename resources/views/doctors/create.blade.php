@extends('layouts.app')

@section('title', 'Add Doctor')
@section('header_title', 'Register New Doctor')

@section('content')
<div class="max-w-4xl mx-auto">
    <a href="{{ route('doctors.index') }}" class="inline-flex items-center text-sm text-slate-500 hover:text-blue-600 mb-6 transition-colors font-medium">
        <i data-feather="arrow-left" class="w-4 h-4 mr-2"></i> Back to Doctor List
    </a>

    <div class="card-container">
         <div class="p-10">

            {{-- 🔴 Show All Validation Errors --}}
            @if ($errors->any())
            <div class="mb-6 p-4 bg-red-100 border border-red-300 text-red-700 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

        <form action="{{ route('doctors.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="md:col-span-2">
                    <label class="label-text">Doctor's Full Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="input-field @error('name') border-red-500 @enderror" placeholder="e.g. Dr. Sarah Connor" required>

                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                </div>
                
                <div>
                    <label class="label-text">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="input-field  @error('email') border-red-500 @enderror" placeholder="dramjad@gmail.com" required>

                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                </div>

                <div>
                    <label class="label-text">Contact Number</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" class="input-field @error('phone') border-red-500 @enderror" placeholder="+1 234 567 890">

                    @error('phone')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                </div>

                <div>
                    <label class="label-text">Specialization</label>
                    <input type="text" name="specialization" value="{{ old('specialization') }}" class="input-field @error('specialization') border-red-500 @enderror" placeholder="e.g. Cardiology">

                     @error('specialization')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                </div>

                <div>
                    <label class="label-text">Qualification</label>
                    <input type="text" name="qualification" value="{{ old('qualification') }}" class="input-field" placeholder="e.g. MBBS, MD">
                </div>

                <div class="md:col-span-2 mt-4">
                    <h3 class="text-sm font-black text-slate-400 uppercase tracking-widest mb-4 flex items-center gap-2">
                        <i data-feather="clock" class="w-4 h-4"></i> Working Hours
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-slate-50 p-6 rounded-2xl border border-slate-100">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Shift Starts</label>
                            <input type="time" name="start_time" value="{{ old('start_time', '09:00') }}" class="input-field border-white shadow-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Shift Ends</label>
                            <input type="time" name="end_time" value="{{ old('end_time', '17:00') }}" class="input-field border-white shadow-sm">
                        </div>
                    </div>
                    <p class="mt-3 text-xs text-slate-400 italic">Appointments cannot be booked outside these hours.</p>
                </div>
            </div>

            <div class="mt-12 pt-8 border-t border-slate-100 flex gap-4">
                <button type="submit" class="btn-primary">
                    Save Doctor Profile
                </button>
                <a href="{{ route('doctors.index') }}" class="btn-secondary">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection