<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function getPatients()
    {
        $patients = Patient::all();
        return response()->json(['data' => $patients]);
    }

    public function getAppointments()
    {
        $appointments = Appointment::with(['patient', 'doctor'])->get();
        return response()->json(['data' => $appointments]);
    }

    public function createAppointment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'appointment_date' => 'required|date|after:now',
            'reason' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $appointment = Appointment::create($validator->validated());
        return response()->json(['data' => $appointment], 201);
    }

    public function getDoctorSchedule(Doctor $doctor)
    {
        $schedule = $doctor->appointments()
            ->where('appointment_date', '>=', now())
            ->get();
        return response()->json(['data' => $schedule]);
    }

    public function getPatientHistory(Patient $patient)
    {
        $history = [
            'appointments' => $patient->appointments()->with('doctor')->get(),
            'prescriptions' => $patient->prescriptions()->with('doctor')->get(),
            'medical_records' => $patient->medicalRecords()->with('doctor')->get()
        ];
        return response()->json(['data' => $history]);
    }
}