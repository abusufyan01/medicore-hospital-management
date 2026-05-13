@extends('layouts.app')

@section('title', 'Patient List')
@section('header_title', 'Patient Registry')

@section('content')
<div class="flex justify-between items-center mb-8">
    <div>
        <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Patients</h2>
        <p class="text-sm text-slate-500 font-medium">Manage and monitor all registered hospital patients.</p>
    </div>
    <a href="{{ route('patients.create') }}" class="btn-primary">
        <i data-feather="plus" class="w-5 h-5"></i> 
        Add New Patient
    </a>
</div>

<div class="table-container">
    <table class="w-full text-left border-collapse">
        <thead class="bg-slate-50 border-b border-slate-100 text-slate-500 text-[11px] uppercase font-bold tracking-wider">
            <tr>
                <th class="px-8 py-5">Patient Info</th>
                <th class="px-8 py-5 text-center">Gender</th>
                <th class="px-8 py-5 text-center">Blood Group</th>
                <th class="px-8 py-5 text-center">Date of Birth</th>
                <th class="px-8 py-5 text-center">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-50">
            @forelse($patients as $patient)
            <tr class="hover:bg-slate-50/50 transition-colors group">
                <td class="px-8 py-5">
                    <div class="flex flex-col">
                        <span class="font-bold text-slate-800 text-base leading-tight">{{ $patient->name }}</span>
                        <span class="text-xs text-slate-400 mt-1 font-medium italic">{{ $patient->email }} | {{ $patient->phone }}</span>
                    </div>
                </td>
                
                <td class="px-8 py-5 text-center">
                    <span class="badge {{ $patient->gender == 'male' ? 'bg-blue-50 text-blue-700' : 'bg-pink-50 text-pink-700' }}">
                        {{ $patient->gender }}
                    </span>
                </td>

                <td class="px-8 py-5 text-center">
                    <span class="badge bg-rose-50 text-rose-600 border border-rose-100">
                        {{ $patient->blood_group }}
                    </span>
                </td>

                <td class="px-8 py-5 text-center">
                    <span class="text-sm text-slate-600 font-semibold">
                        {{ $patient->date_of_birth ? \Carbon\Carbon::parse($patient->date_of_birth)->format('M d, Y') : '—' }}
                    </span>
                </td>

                <td class="px-8 py-5 text-center">
                    <div class="flex justify-center items-center gap-3">
                        <a href="{{ route('patients.show', $patient->id) }}"
    class="flex items-center gap-1 bg-blue-50 text-blue-600 px-3 py-1.5 rounded-lg text-sm font-bold hover:bg-blue-100 transition-all">
    <i data-feather="eye" class="w-3.5 h-3.5"></i>
    View
</a>
                        <a href="{{ route('patients.edit', $patient->id) }}" 
                           class="inline-flex items-center gap-2 px-3 py-2 rounded-xl border border-blue-100 bg-blue-50 text-blue-600 text-xs font-bold hover:bg-blue-600 hover:text-white transition-all duration-200">
                            <i data-feather="edit-2" class="w-3.5 h-3.5"></i> Edit
                        </a>

                        <form action="{{ route('patients.destroy', $patient->id) }}" method="POST" onsubmit="return confirm('Wait! This will permanently remove the patient. Continue?')">
                            @csrf 
                            @method('DELETE')
                            <button type="submit" 
                                    class="inline-flex items-center gap-2 px-3 py-2 rounded-xl border border-rose-100 bg-rose-50 text-rose-600 text-xs font-bold hover:bg-rose-600 hover:text-white transition-all duration-200">
                                <i data-feather="trash-2" class="w-3.5 h-3.5"></i> Delete
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-8 py-24 text-center">
                    <div class="flex flex-col items-center">
                        <div class="p-4 bg-slate-50 rounded-full mb-4">
                            <i data-feather="users" class="w-10 h-10 text-slate-300"></i>
                        </div>
                        <h3 class="text-lg font-bold text-slate-800">No Patients Yet</h3>
                        <p class="text-slate-500 text-sm max-w-xs mx-auto mt-1">Start by adding your first patient record to the hospital database.</p>
                        <a href="{{ route('patients.create') }}" class="mt-6 text-blue-600 font-bold text-sm hover:underline flex items-center gap-2">
                            Add your first patient <i data-feather="arrow-right" class="w-4 h-4"></i>
                        </a>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6 px-4">
    <p class="text-xs text-slate-400 font-medium italic">Showing {{ $patients->count() }} total patient records</p>
</div>
@endsection