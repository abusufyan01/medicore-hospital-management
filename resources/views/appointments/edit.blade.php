@extends('layouts.app')

@section('title', 'Edit Appointment')
@section('header_title', 'Update Appointment')

@section('content')
<div class="max-w-4xl mx-auto">
    <a href="{{ route('appointments.index') }}" class="inline-flex items-center text-sm text-slate-500 hover:text-blue-600 mb-6 transition-colors font-medium">
        <i data-feather="arrow-left" class="w-4 h-4 mr-2"></i> Back to Schedule
    </a>

    <div class="card-container p-10">
        <form action="{{ route('appointments.update', $appointment->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <div>
                    <label class="label-text">Patient</label>
                    <select name="patient_id" class="input-field bg-white" required>
                        @foreach($patients as $patient)
                            <option value="{{ $patient->id }}" {{ $appointment->patient_id == $patient->id ? 'selected' : '' }}>
                                {{ $patient->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="label-text">Doctor</label>
                    <select name="doctor_id" class="input-field bg-white" required>
                        @foreach($doctors as $doctor)
                            <option value="{{ $doctor->id }}" {{ $appointment->doctor_id == $doctor->id ? 'selected' : '' }}>
                                Dr. {{ $doctor->name }} ({{ $doctor->specialization }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="label-text">Date</label>
                    <input type="date" name="appointment_date" value="{{ old('appointment_date', $appointment->appointment_date) }}" class="input-field" required>
                </div>

                <div>
                    <label class="label-text">Time</label>
                    <input type="time" name="appointment_time" value="{{ old('appointment_time', \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i')) }}" class="input-field {{ $errors->has('appointment_time') ? 'border-rose-500 ring-4 ring-rose-50' : '' }}" required>
                    
                    @error('appointment_time')
                        <p class="text-rose-500 text-xs mt-2 font-bold flex items-center gap-1">
                             <i data-feather="alert-circle" class="w-3 h-3"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label class="label-text">Status</label>
                    <select name="status" class="input-field bg-white">
                        <option value="pending" {{ $appointment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ $appointment->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="cancelled" {{ $appointment->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label class="label-text">Notes</label>
                    <textarea name="notes" rows="3" class="input-field">{{ old('notes', $appointment->notes) }}</textarea>
                </div>
            </div>

            <div class="mt-12 pt-8 border-t border-slate-100 flex gap-4">
                <button type="submit" class="btn-primary">
                    Update Appointment
                </button>
                <a href="{{ route('appointments.index') }}" class="btn-secondary">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection