<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BillingController;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');
    Route::resource('billing', BillingController::class);
    Route::get('billing/{bill}/pdf', [BillingController::class, 'generatePDF'])->name('billing.pdf');
    Route::post('billing/{bill}/payment', [BillingController::class, 'recordPayment'])->name('billing.payment');
require __DIR__.'/auth.php';
