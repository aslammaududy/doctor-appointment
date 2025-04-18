<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    // Admin user
    User::create([
        'name' => 'Admin',
        'email' => 'admin@example.com',
        'password' => Hash::make('password'),
        'role' => 'admin',
    ]);

    // Dokter user + profil
    $doctorUser = User::create([
        'name' => 'Dr. Budi',
        'email' => 'dokter@example.com',
        'password' => Hash::make('password'),
        'role' => 'doctor',
    ]);

    Doctor::create([
        'user_id' => $doctorUser->id,
        'specialization' => 'Dokter Umum',
        'bio' => 'Dokter berpengalaman 10 tahun.',
    ]);

    // Pasien user + profil
    $patientUser = User::create([
        'name' => 'Andi Pasien',
        'email' => 'pasien@example.com',
        'password' => Hash::make('password'),
        'role' => 'patient',
    ]);

    Patient::create([
        'user_id' => $patientUser->id,
        'birth_date' => '1990-01-01',
        'gender' => 'L',
        'address' => 'Jl. Mawar No. 123',
    ]);
}
}
