<?php

use App\Http\Controllers\ProfileController;
use App\Models\Appointment;
use App\Models\Payment;
use App\Models\Service;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard', [
        'serviceCount' => Service::count(),
        'appointmentCount' => Appointment::count(),
        'paymentCount' => Payment::count(),
        'unpaidAppointments' => Appointment::where('payment_status', 'Unpaid')->count(),
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('services', App\Http\Controllers\ServiceController::class)->except(['show']);
    Route::resource('appointments', App\Http\Controllers\AppointmentController::class)->except(['show']);
    Route::resource('payments', App\Http\Controllers\PaymentController::class)->except(['show']);
});

require __DIR__.'/auth.php';
