<?php

use App\Http\Controllers\API\ClinicController;
use App\Http\Controllers\API\PatientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/clinic', [ClinicController::class, 'index'])->name('api.clinic.index');

Route::get('/patient', [PatientController::class, 'index'])->name('api.patient.index');
