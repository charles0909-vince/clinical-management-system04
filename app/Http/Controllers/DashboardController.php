<?php
namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Models\MedicalRecord;

class DashboardController extends Controller
{
    public function index()
    {
       
        $stats = [
            'total_patients' => Patient::count(),
            'total_appointments' => Appointment::count(),
            'total_doctors' => Doctor::count(),
            'today_appointments' => Appointment::whereDate('appointment_date', today())->count(),
            'total_medical_records' => MedicalRecord::count(), 
        ];

     
        $recent_appointments = Appointment::with(['patient', 'doctor'])
            ->latest()
            ->take(5)
            ->get();

    
        $recent_doctors = Doctor::latest()
            ->take(5)
            ->get();


        $recent_medical_records = MedicalRecord::with(['patient', 'doctor'])
            ->latest()
            ->take(5)
            ->get();

       
        return view('dashboard', compact('stats', 'recent_appointments', 'recent_doctors','recent_medical_records'));
    }
}
