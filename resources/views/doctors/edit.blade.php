@extends('layouts.app')

@section('title', 'Edit Doctor')
@section('header_title', 'Update Doctor Profile')

@section('content')
<div class="max-w-4xl mx-auto">
    <a href="{{ route('doctors.index') }}" class="inline-flex items-center text-sm text-slate-500 hover:text-blue-600 mb-6 transition-colors font-medium">
        <i data-feather="arrow-left" class="w-4 h-4 mr-2"></i> Back to Doctor List
    </a>

    <div class="card-container">
        <form action="{{ route('doctors.update', $doctor->id) }}" method="POST">
            @csrf 
            @method('PUT')

            {{-- 🔴 Show All Errors --}}
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-100 border border-red-300 text-red-700 rounded">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                {{-- Name --}}
                <div class="md:col-span-2">
                    <label class="label-text">Full Name</label>
                    <input type="text" name="name"
                        value="{{ old('name', $doctor->name) }}"
                        class="input-field @error('name') border-red-500 @enderror">

                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                {{-- Email --}}
                <div>
                    <label class="label-text">Email</label>
                    <input type="email" name="email"
                        value="{{ old('email', $doctor->email) }}"
                        class="input-field @error('email') border-red-500 @enderror">

                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Phone --}}
                <div>
                    <label class="label-text">Phone</label>
                    <input type="text" name="phone"
                        value="{{ old('phone', $doctor->phone) }}"
                        class="input-field @error('phone') border-red-500 @enderror">

                    @error('phone')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Specialization --}}
                <div>
                    <label class="label-text">Specialization</label>
                    <input type="text" name="specialization"
                        value="{{ old('specialization', $doctor->specialization) }}"
                        class="input-field @error('specialization') border-red-500 @enderror">

                    @error('specialization')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Qualification --}}
                <div>
                    <label class="label-text">Qualification</label>
                    <input type="text" name="qualification"
                        value="{{ old('qualification', $doctor->qualification) }}"
                        class="input-field">

                    <!-- @error('qualification')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror -->
                </div>

                <div class="md:col-span-2 mt-4 bg-blue-50/50 p-6 rounded-2xl border border-blue-100"> <h3 class="text-xs font-black text-blue-600 uppercase tracking-widest mb-4">Modify Availability</h3> <div class="grid grid-cols-1 md:grid-cols-2 gap-6"> <div> <label class="block text-xs font-bold text-slate-500 mb-2 uppercase tracking-wide">Shift Starts</label> <input type="time" name="start_time" value="{{ old('start_time', \Carbon\Carbon::parse($doctor->start_time)->format('H:i')) }}" class="input-field border-white shadow-sm"> </div> <div> <label class="block text-xs font-bold text-slate-500 mb-2 uppercase tracking-wide">Shift Ends</label> <input type="time" name="end_time" value="{{ old('end_time', \Carbon\Carbon::parse($doctor->end_time)->format('H:i')) }}" class="input-field border-white shadow-sm">

                            <!-- @error('end_time')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror -->
                        </div>

                    </div>
                </div>

            </div>

            {{-- Buttons --}}
            <div class="mt-12 flex gap-4">
                <button type="submit" class="btn-primary">
                    Update Doctor Info
                </button>

                <a href="{{ route('doctors.index') }}" class="btn-secondary">
                    Cancel
                </a>
            </div>

        </form>
    </div>
</div>
@endsection