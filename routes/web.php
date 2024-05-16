<?php

use App\Livewire\Appoinment\IndexAppointment;
use App\Livewire\Patient\CreatePatient;
use App\Livewire\Patient\EditPatient;
use App\Livewire\Patient\IndexPatient;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::prefix('patient')->name('patient.')->group(function () {
        Route::get('/', IndexPatient::class)->name('index');
        Route::get('/{id}/edit', EditPatient::class)->name('edit');
        Route::get('/create', CreatePatient::class)->name('create');
    });

    Route::prefix('appointment')->name('appointment.')->group(function () {
        Route::get('/', IndexAppointment::class)->name('index');
    });

});
