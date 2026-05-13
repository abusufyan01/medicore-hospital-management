<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\SearchController;

// Home page redirect to dashboard
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Protected routes — must be logged in
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/search', [SearchController::class, 'search'])->name('search');
    Route::get('/dashboard', function () {
    $totalPatients      = \App\Models\Patient::count();
    $totalDoctors       = \App\Models\Doctor::count();
    $totalAppointments  = \App\Models\Appointment::count();
    $totalRecords       = \App\Models\MedicalRecord::count();
    $pendingAppointments    = \App\Models\Appointment::where('status', 'pending')->count();
    $confirmedAppointments  = \App\Models\Appointment::where('status', 'confirmed')->count();
    $todayAppointments      = \App\Models\Appointment::whereDate('appointment_date', today())->count();

    return view('dashboard', compact(
        'totalPatients',
        'totalDoctors',
        'totalAppointments',
        'totalRecords',
        'pendingAppointments',
        'confirmedAppointments',
        'todayAppointments'
    ));
})->name('dashboard');

    // Hospital modules
    Route::resource('patients', PatientController::class);
    Route::resource('doctors', DoctorController::class);
    Route::resource('appointments', AppointmentController::class);
    Route::resource('medical_records', MedicalRecordController::class);

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';