<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Prescription;

class Prescriptionseeder extends Seeder
{
    public function run()
    {
        Prescription::create([
            'patient_id' => 1, 
            'doctor_id' => 1, 
            'medication' => 'Aspirin',
        ]);

        
    }
}

