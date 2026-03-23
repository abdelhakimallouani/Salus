<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Doctor;


class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
    Doctor::create([
        'name' => 'Dr Karim',
        'specialty' => 'Cardiologist',
        'city' => 'Casablanca',
        'yearsofexperience' => 10,
        'consultation_price' => 300,
        'available_days' => ['Mon', 'Tue', 'Fri'],
    ]);

    Doctor::create([
        'name' => 'Dr Sara',
        'specialty' => 'Generalist',
        'city' => 'Rabat',
        'yearsofexperience' => 5,
        'consultation_price' => 200,
        'available_days' => ['Mon', 'Wed'],
    ]);

    Doctor::create([
        'name' => 'Dr Youssef',
        'specialty' => 'Dermatologist',
        'city' => 'Fes',
        'yearsofexperience' => 8,
        'consultation_price' => 250,
        'available_days' => ['Tue', 'Thu'],
    ]);
}
}
