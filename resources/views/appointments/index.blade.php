@extends('layouts.app')

@section('title', 'Appointments')
@section('header_title', 'Appointment Schedule')

@section('content')
<div class="flex justify-between items-center mb-8">
    <div>
        <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Appointments</h2>
        <p class="text-sm text-slate-500 font-medium">Manage patient visits and doctor availability.</p>
    </div>
    <a href="{{ route('appointments.create') }}" class="btn-primary">
        <i data-feather="calendar" class="w-5 h-5"></i> Book Appointment
    </a>
</div>

<div class="table-container">
    <table class="w-full text-left border-collapse">
        <thead class="bg-slate-50 border-b border-slate-100 text-slate-500 text-[11px] uppercase font-bold tracking-wider">
            <tr>
                <th class="px-8 py-5">Patient</th>
                <th class="px-8 py-5">Doctor</th>
                <th class="px-8 py-5 text-center">Date & Time</th>
                <th class="px-8 py-5 text-center">Status</th>
                <th class="px-8 py-5 text-center">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-50">
            @forelse($appointments as $appointment)
            <tr class="hover:bg-slate-50/50 transition-colors group">
                <td class="px-8 py-5">
                    <span class="font-bold text-slate-800">{{ $appointment->patient->name }}</span>
                </td>
                <td class="px-8 py-5">
                    <span class="font-medium text-slate-600 italic">Dr. {{ $appointment->doctor->name }}</span>
                </td>
                <td class="px-8 py-5 text-center">
                    <div class="flex flex-col">
                        <span class="text-sm font-bold text-slate-700">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y') }}</span>
                        <span class="text-xs text-slate-400 font-medium">{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</span>
                    </div>
                </td>
                <td class="px-8 py-5 text-center">
                    @php
                        $statusClasses = [
                            'pending'   => 'bg-amber-50 text-amber-600 border-amber-100',
                            'confirmed' => 'bg-emerald-50 text-emerald-600 border-emerald-100',
                            'cancelled' => 'bg-rose-50 text-rose-600 border-rose-100',
                        ];
                        $currentClass = $statusClasses[$appointment->status] ?? 'bg-slate-50 text-slate-600';
                    @endphp
                    <span class="badge {{ $currentClass }} border">
                        {{ $appointment->status }}
                    </span>
                </td>
                <td class="px-8 py-5 text-center">
                    <div class="flex justify-center items-center gap-3">
                        <a href="{{ route('appointments.show', $appointment->id) }}"
    class="flex items-center gap-1 bg-blue-50 text-blue-600 px-3 py-1.5 rounded-lg text-sm font-bold hover:bg-blue-100 transition-all">
    <i data-feather="eye" class="w-3.5 h-3.5"></i>
    View
</a>
                        <a href="{{ route('appointments.edit', $appointment->id) }}" class="inline-flex items-center gap-2 px-3 py-2 rounded-xl border border-blue-100 bg-blue-50 text-blue-600 text-xs font-bold hover:bg-blue-600 hover:text-white transition-all">
                            <i data-feather="edit-2" class="w-3.5 h-3.5"></i> Edit
                        </a>
                        <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST" onsubmit="return confirm('Cancel this appointment?')">
                            @csrf 
                            @method('DELETE')
                            <button class="inline-flex items-center gap-2 px-3 py-2 rounded-xl border border-rose-100 bg-rose-50 text-rose-600 text-xs font-bold hover:bg-rose-600 hover:text-white transition-all">
                                <i data-feather="trash-2" class="w-3.5 h-3.5"></i> Delete
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-8 py-24 text-center">
                    <div class="flex flex-col items-center text-slate-400">
                        <div class="p-4 bg-slate-50 rounded-full mb-4">
                            <i data-feather="clock" class="w-10 h-10 text-slate-300"></i>
                        </div>
                        <h3 class="text-lg font-bold text-slate-800">No Appointments</h3>
                        <p class="text-sm mt-1">Schedule your first visit today.</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection