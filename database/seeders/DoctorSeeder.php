<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Doctor;

class DoctorSeeder extends Seeder
{
    public function run()
    {
        Doctor::create([
            'first_name' => 'Jane',
            'last_name' => 'Smith',
            'specialization' => 'Cardiology',
            'phone_number' => '0987654321',
            'email' => 'jane.smith@example.com',
        ]);

    
    }
}
