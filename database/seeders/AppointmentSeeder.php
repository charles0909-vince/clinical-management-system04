<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Appointment;

class AppointmentSeeder extends Seeder
{
    public function run()
    {
        Appointment::create([
            'patient_id' => 1, 
            'doctor_id' => 1, 
            'date' => '2023-10-01',
        ]);

     
    }
}


