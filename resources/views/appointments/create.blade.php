@extends('layouts.app')

@section('title', 'Book Appointment')
@section('header_title', 'New Appointment')

@section('content')
<div class="max-w-4xl mx-auto">
    <a href="{{ url()->previous() }}" class="inline-flex items-center text-sm text-slate-500 hover:text-blue-600 mb-6 transition-colors font-medium">
        <i data-feather="arrow-left" class="w-4 h-4 mr-2"></i> Back
    </a>
    {{-- <a href="{{ url()->previous() }}"
    class="flex items-center gap-2 text-slate-500 hover:text-slate-700 text-sm font-medium w-fit">
    <i data-feather="arrow-left" class="w-4 h-4"></i>
    Back
</a> --}}

    @if ($errors->any())
        <div class="mb-6 p-4 bg-rose-50 border border-rose-100 rounded-2xl flex items-start gap-3 text-rose-700">
            <i data-feather="alert-circle" class="w-5 h-5 mt-0.5"></i>
            <div>
                <p class="font-bold text-sm">Please correct the following errors:</p>
                <ul class="text-xs list-disc list-inside mt-1 font-medium">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <div class="card-container p-10">
        <form action="{{ route('appointments.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <div>
                    <label class="label-text">Select Patient</label>
                    <select name="patient_id" class="input-field bg-white @error('patient_id') border-rose-500 @enderror" required>
                        <option value="">-- Choose Patient --</option>
                        @foreach($patients as $patient)
                            <option value="{{ $patient->id }}" {{ old('patient_id') == $patient->id ? 'selected' : '' }}>
                                {{ $patient->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="label-text">Select Doctor</label>
                    <select name="doctor_id" class="input-field bg-white @error('doctor_id') border-rose-500 @enderror" required>
                        <option value="">-- Choose Doctor --</option>
                        @foreach($doctors as $doctor)
                            <option value="{{ $doctor->id }}" {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}>
                                Dr. {{ $doctor->name }} ({{ $doctor->specialization }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="label-text">Appointment Date</label>
                    <input type="date" name="appointment_date" value="{{ old('appointment_date') }}" class="input-field @error('appointment_date') border-rose-500 @enderror" required>
                </div>

                <div>
                    <label class="label-text">Appointment Time</label>
                    <input type="time" name="appointment_time" value="{{ old('appointment_time') }}" class="input-field {{ $errors->has('appointment_time') ? 'border-rose-500 ring-4 ring-rose-50' : '' }}" required>
                    
                    @error('appointment_time')
                        <p class="text-rose-500 text-xs mt-2 font-bold flex items-center gap-1">
                            <i data-feather="clock" class="w-3 h-3"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label class="label-text">Status</label>
                    <select name="status" class="input-field bg-white">
                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ old('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label class="label-text">Notes (Optional)</label>
                    <textarea name="notes" rows="3" class="input-field" placeholder="Reason for visit...">{{ old('notes') }}</textarea>
                </div>
            </div>

            <div class="mt-12 pt-8 border-t border-slate-100 flex gap-4">
                <button type="submit" class="btn-primary">
                    Confirm Appointment
                </button>
                <a href="{{ route('appointments.index') }}" class="btn-secondary">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection