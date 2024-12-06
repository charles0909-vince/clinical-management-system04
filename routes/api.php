<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\ApiController;

Route::prefix('v1')->group(function () {
    Route::get('patients', [ApiController::class, 'getPatients']);
    Route::get('appointments', [ApiController::class, 'getAppointments']);
    Route::post('appointments', [ApiController::class, 'createAppointment']);
    Route::get('doctors/{doctor}/schedule', [ApiController::class, 'getDoctorSchedule']);
    Route::get('patients/{patient}/history', [ApiController::class, 'getPatientHistory']);
});