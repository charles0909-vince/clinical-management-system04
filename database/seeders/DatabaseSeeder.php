<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\PatientSeeder;
use Database\Seeders\DoctorSeeder;
use Database\Seeders\AppointmentSeeder;
use Database\Seeders\PrescriptionSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\UsersTableSeeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            PatientSeeder::class,
            DoctorSeeder::class,
            AppointmentSeeder::class,
            PrescriptionSeeder::class,
            UserSeeder::class,
            UsersTableSeeder::class,
        ]);
    }
}


