<?php

use App\Livewire\Appointment\CreateAppointment;
use App\Livewire\Appointment\CreatePayment;
use App\Livewire\Appointment\EditAppointment;
use App\Livewire\Appointment\IndexAppointment;
use App\Livewire\Patient\CreatePatient;
use App\Livewire\Patient\EditPatient;
use App\Livewire\Patient\IndexPatient;
use App\Livewire\Payment\EditPayment;
use App\Livewire\Payment\IndexPayment;
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
        Route::get('/create', CreatePatient::class)->name('create');
        Route::get('/{id}/edit', EditPatient::class)->name('edit');
    });

    Route::prefix('appointment')->name('appointment.')->group(function () {
        Route::get('/', IndexAppointment::class)->name('index');
        Route::get('/create', CreateAppointment::class)->name('create');
        Route::get('/{id}/edit', EditAppointment::class)->name('edit');
        Route::get('/{id}/payment', CreatePayment::class)->name('payment');
    });

    Route::prefix('payment')->name('payment.')->group(function () {
        Route::get('/', IndexPayment::class)->name('index');
        Route::get('/{id}/edit', EditPayment::class)->name('edit');
    });

});
