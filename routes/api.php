<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PatientApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Patient API routes
Route::apiResource('patients', PatientApiController::class)->names([
    'index'   => 'api.patients.index',
    'store'   => 'api.patients.store',
    'show'    => 'api.patients.show',
    'update'  => 'api.patients.update',
    'destroy' => 'api.patients.destroy',
]);