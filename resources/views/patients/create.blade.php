@extends('layouts.app')

@section('title', 'Add Patient')
@section('header_title', 'Register New Patient')

@section('content')
<div class="max-w-4xl mx-auto">
    <a href="{{ route('patients.index') }}" class="inline-flex items-center text-sm text-slate-500 hover:text-blue-600 mb-6 transition-colors">
        <i data-feather="arrow-left" class="w-4 h-4 mr-2"></i> Back to Patient List
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

            <form action="{{ route('patients.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                    {{-- Name --}}
                    <div class="md:col-span-2">
                        <label class="label-text">Full Name</label>
                        <input type="text" name="name"
                            value="{{ old('name') }}"
                            class="input-field @error('name') border-red-500 @enderror"
                            placeholder="John Doe" required>

                        @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <label class="label-text">Email Address</label>
                        <input type="email" name="email"
                            value="{{ old('email') }}"
                            class="input-field @error('email') border-red-500 @enderror"
                            placeholder="john@example.com" required>

                        @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Phone --}}
                    <div>
                        <label class="label-text">Phone Number</label>
                        <input type="text" name="phone"
                            value="{{ old('phone') }}"
                            class="input-field @error('phone') border-red-500 @enderror"
                            placeholder="03XXXXXXXXX" required>

                        @error('phone')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Gender --}}
                    <div>
                        <label class="label-text">Gender</label>
                        <select name="gender" class="input-field bg-white @error('gender') border-red-500 @enderror">
                            <option value="">Select Gender</option>
                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                        </select>

                        @error('gender')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Blood Group --}}
                    <div>
                        <label class="label-text">Blood Group</label>
                        <select name="blood_group" class="input-field bg-white @error('blood_group') border-red-500 @enderror">
                            <option value="">Select Blood Group</option>
                            @foreach(['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'] as $bg)
                            <option value="{{ $bg }}" {{ old('blood_group') == $bg ? 'selected' : '' }}>
                                {{ $bg }}
                            </option>
                            @endforeach
                        </select>

                        @error('blood_group')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Date of Birth --}}
                    <div>
                        <label class="label-text">Date of Birth</label>
                        <input type="date" name="date_of_birth"
                            value="{{ old('date_of_birth') }}"
                            class="input-field @error('date_of_birth') border-red-500 @enderror">

                        @error('date_of_birth')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Address --}}
                    <div class="md:col-span-2">
                        <label class="label-text">Residential Address</label>
                        <textarea name="address" rows="3"
                            class="input-field @error('address') border-red-500 @enderror"
                            placeholder="Street address, City">{{ old('address') }}</textarea>

                        @error('address')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                {{-- Buttons --}}
                <div class="mt-12 pt-8 border-t border-slate-100 flex gap-4">
                    <button type="submit" class="btn-primary">
                        Save Patient Record
                    </button>

                    <a href="{{ route('patients.index') }}" class="btn-secondary">
                        Cancel
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection