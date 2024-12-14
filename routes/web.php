<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\MedicalRecordController;

// Profile routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/prescriptions/create', [PrescriptionController::class, 'create'])->name('prescriptions.create');
Route::resource('prescriptions', PrescriptionController::class);
Route::put('prescriptions/{prescription}', [PrescriptionController::class, 'update'])->name('prescriptions.update');
Route::patch('prescriptions/{prescription}', [PrescriptionController::class, 'update'])->name('prescriptions.update');
Route::delete('prescriptions/{prescription}', [PrescriptionController::class, 'destroy'])->name('prescriptions.destroy');
Route::post('prescriptions/{prescription}/medications', [PrescriptionController::class, 'addMedication'])->name('prescriptions.medications');
Route::get('/prescriptions/{prescription}/print', [PrescriptionController::class, 'print'])->name('prescriptions.print');

Route::resource('doctors', DoctorController::class);

Route::resource('inventory', InventoryController::class);
Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');
Route::get('/inventory/create', [InventoryController::class, 'create'])->name('inventory.create');   
Route::get('/inventory/{inventory}/pdf', [InventoryController::class, 'generatePDF'])->name('inventory.pdf');
Route::get('/inventory/low-stock', [InventoryController::class, 'lowStock'])->name('inventory.low-stock');
Route::get('/inventory/expiring-soon', [InventoryController::class, 'expiringSoon'])->name('inventory.expiring-soon');


Route::resource('reports', ReportController::class);
Route::get('/reports/{report}/pdf', [ReportController::class, 'generatePDF'])->name('reports.pdf');


Route::middleware(['auth'])->group(function () {
    Route::resource('patients', PatientController::class);
    Route::get('patients/{patient}/medical-history', [PatientController::class, 'medicalHistory'])
         ->name('patients.medical-history');
    Route::get('patients/{patient}/appointments', [PatientController::class, 'appointments'])
         ->name('patients.appointments');
    Route::post('/patients', [PatientController::class, 'store'])->name('patients.store');
    Route::put('/patients/{patient}', [PatientController::class, 'update'])->name('patients.update');
    Route::patch('/patients/{patient}', [PatientController::class, 'update'])->name('patients.update');
    Route::delete('/patients/{patient}', [PatientController::class, 'destroy'])->name('patients.destroy');
});

Route::resource('medicalrecords', MedicalRecordController::class);
Route::get('medical-records/{medical_record}/edit', [MedicalRecordController::class, 'edit'])
    ->name('medical-records.edit');
Route::get('/medical-records', [MedicalRecordController::class, 'index'])->name('medical-records.index');
Route::get('medicalrecords/{medicalrecord}', [MedicalRecordController::class, 'destroy'])->name('medical-records.destroy');
Route::get('medicalrecords', [MedicalRecordController::class, 'create'])->name('medical-records.create');
Route::get('medicalrecords/{medicalrecord}', [MedicalRecordController::class, 'show'])->name('medical-records.show');   
Route::post('medicalrecords', [MedicalRecordController::class, 'store'])->name('medical-records.store');
Route::post('medicalrecords/{medicalrecord}/notes', [MedicalRecordController::class, 'addNotes'])->name('medical-records.notes');
Route::put('medicalrecords/{medicalrecord}', [MedicalRecordController::class, 'update'])->name('medical-records.update');
Route::patch('medicalrecords/{medicalrecord}', [MedicalRecordController::class, 'update'])->name('medical-records.update'); 
Route::delete('medicalrecords/{medicalrecord}', [MedicalRecordController::class, 'destroy'])->name('medical-records.destroy');

Route::resource('appointments', AppointmentController::class);
Route::put('appointments/{appointment}', [AppointmentController::class, 'update'])->name('appointments.update');
Route::patch('appointments/{appointment}', [AppointmentController::class, 'update'])->name('appointments.update');
Route::delete('appointments/{appointment}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');
Route::get('appointments/{appointment}/pdf', [AppointmentController::class, 'generatePDF'])->name('appointments.pdf');
Route::post('appointments/{appointment}/prescribe', [AppointmentController::class, 'prescribe'])->name('appointments.prescribe');

Route::resource('billing', BillingController::class);
Route::get('billing/{bill}/pdf', [BillingController::class, 'generatePDF'])->name('billing.pdf');
Route::post('billing/{bill}/payment', [BillingController::class, 'recordPayment'])->name('billing.payment');
Route::get('/billing/create', [BillingController::class, 'create'])->name('billing.create');

Route::view('/', 'welcome');
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
