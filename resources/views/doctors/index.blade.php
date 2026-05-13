@extends('layouts.app')

@section('title', 'Doctor List')
@section('header_title', 'Doctor Management')

@section('content')
<div class="flex justify-between items-center mb-8">
    <div>
        <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Doctors</h2>
        <p class="text-sm text-slate-500 font-medium">Manage hospital specialists and their departments.</p>
    </div>
    <a href="{{ route('doctors.create') }}" class="btn-primary">
        <i data-feather="plus" class="w-5 h-5"></i> Add New Doctor
    </a>
</div>

<div class="table-container">
    <table class="w-full text-left border-collapse">
        <thead class="bg-slate-50 border-b border-slate-100 text-slate-500 text-[11px] uppercase font-bold tracking-wider">
            <tr>
                <th class="px-8 py-5">Doctor Info</th>
                <th class="px-8 py-5 text-center">Specialization</th>
                <th class="px-8 py-5 text-center">Qualification</th>
                <th class="px-8 py-5 text-center">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-50">
            @forelse($doctors as $doctor)
            <tr class="hover:bg-slate-50/50 transition-colors group">
                <td class="px-8 py-5">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-xs">
                            {{ substr($doctor->name, 0, 2) }}
                        </div>
                        <div class="flex flex-col">
                            <span class="font-bold text-slate-800 text-base">Dr. {{ $doctor->name }}</span>
                            <span class="text-xs text-slate-400 font-medium italic">{{ $doctor->email }} | {{ $doctor->phone ?? 'No Phone' }}</span>
                        </div>
                    </div>
                </td>
                
                <td class="px-8 py-5 text-center">
                    <span class="badge bg-emerald-50 text-emerald-700 border border-emerald-100">
                        {{ $doctor->specialization ?? 'General' }}
                    </span>
                </td>

                <td class="px-8 py-5 text-center font-semibold text-sm text-slate-600">
                    {{ $doctor->qualification ?? 'MBBS' }}
                </td>

                <td class="px-8 py-5 text-center">
                    <div class="flex justify-center items-center gap-3">
                        <a href="{{ route('doctors.show', $doctor->id) }}"
    class="flex items-center gap-1 bg-blue-50 text-blue-600 px-3 py-1.5 rounded-lg text-sm font-bold hover:bg-blue-100 transition-all">
    <i data-feather="eye" class="w-3.5 h-3.5"></i>
    View
</a>
                        <a href="{{ route('doctors.edit', $doctor->id) }}" 
                           class="inline-flex items-center gap-2 px-3 py-2 rounded-xl border border-blue-100 bg-blue-50 text-blue-600 text-xs font-bold hover:bg-blue-600 hover:text-white transition-all">
                            <i data-feather="edit-2" class="w-3.5 h-3.5"></i> Edit
                        </a>
                        <form action="{{ route('doctors.destroy', $doctor->id) }}" method="POST" onsubmit="return confirm('Remove Dr. {{ $doctor->name }} from system?')">
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
                <td colspan="4" class="px-8 py-24 text-center">
                    <div class="flex flex-col items-center">
                        <i data-feather="shield" class="w-12 h-12 text-slate-200 mb-4"></i>
                        <h3 class="text-lg font-bold text-slate-800">No Doctors Registered</h3>
                        <p class="text-slate-500 text-sm mt-1">Start by adding your first medical specialist.</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection