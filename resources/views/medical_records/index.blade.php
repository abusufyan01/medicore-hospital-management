@extends('layouts.app')

@section('title', 'Medical Records')
@section('header_title', 'Clinical Records')

@section('content')
<div class="flex justify-between items-center mb-8">
    <div>
        <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Medical Records</h2>
        <p class="text-sm text-slate-500 font-medium">Permanent history of patient diagnoses and treatments.</p>
    </div>
    <a href="{{ route('medical_records.create') }}" class="bg-blue-600 text-white px-6 py-3 rounded-xl font-semibold shadow-lg shadow-blue-200 hover:bg-blue-700 transition-all flex items-center gap-2">
        <i data-feather="plus-circle" class="w-5 h-5"></i> Create Record
    </a>
</div>

<div class="bg-white rounded-[2rem] border border-slate-200 shadow-sm overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead class="bg-slate-50 border-b border-slate-100 text-slate-500 text-[11px] uppercase font-bold tracking-wider">
            <tr>
                <th class="px-8 py-5">Patient</th>
                <th class="px-8 py-5">Diagnosis</th>
                <th class="px-8 py-5">Prescribing Doctor</th>
                <th class="px-8 py-5 text-center">Date</th>
                <th class="px-8 py-5 text-center">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-50">
            @forelse($medicalRecords as $record)
            <tr class="hover:bg-slate-50/50 transition-colors">
                <td class="px-8 py-5">
                    <span class="font-bold text-slate-800">{{ $record->patient->name }}</span>
                </td>
                <td class="px-8 py-5">
                    <span class="text-sm text-slate-600 line-clamp-1 max-w-xs">{{ $record->diagnosis }}</span>
                </td>
                <td class="px-8 py-5 font-medium text-slate-500 italic">
                    Dr. {{ $record->doctor->name }}
                </td>
                <td class="px-8 py-5 text-center text-sm font-bold text-slate-700">
                    {{ $record->created_at->format('M d, Y') }}
                </td>
                <td class="px-8 py-5 text-center">
                    <div class="flex justify-center items-center gap-3">
                        <a href="{{ route('medical_records.show', $record->id) }}"
    class="flex items-center gap-1 bg-blue-50 text-blue-600 px-3 py-1.5 rounded-lg text-sm font-bold hover:bg-blue-100 transition-all">
    <i data-feather="eye" class="w-3.5 h-3.5"></i>
    View
</a>
                        <a href="{{ route('medical_records.edit', $record->id) }}" class="inline-flex items-center gap-2 px-3 py-2 rounded-xl border border-blue-100 bg-blue-50 text-blue-600 text-xs font-bold hover:bg-blue-600 hover:text-white transition-all">
                            <i data-feather="edit-2" class="w-3.5 h-3.5"></i> Edit
                        </a>
                        <form action="{{ route('medical_records.destroy', $record->id) }}" method="POST" onsubmit="return confirm('Delete this medical record permanently?')">
                            @csrf @method('DELETE')
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
                    <i data-feather="folder" class="w-12 h-12 text-slate-200 mx-auto mb-4"></i>
                    <p class="text-slate-500 font-bold">No medical records found.</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection