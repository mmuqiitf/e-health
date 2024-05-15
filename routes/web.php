<?php

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
    });
});
