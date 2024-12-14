<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Patient;

class PatientSeeder extends Seeder
{
    public function run()
    {
        Patient::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'date_of_birth' => '1990-01-01',
            'gender' => 'male',
            'phone_number' => '1234567890',
            'email' => 'john.doe@example.com',
            'address' => '123 Main St, Anytown, USA',
        ]);

       
    }
}

