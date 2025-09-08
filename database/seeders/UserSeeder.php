<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Dr. Sarah Williams',
                'email' => 'sarah.williams@meditrack.com',
                'password' => Hash::make('password'),
                'role' => 'doctor',
                'phone' => '555-1001',
                'specialization' => 'Internal Medicine',
            ],
            [
                'name' => 'Dr. Michael Brown',
                'email' => 'michael.brown@meditrack.com',
                'password' => Hash::make('password'),
                'role' => 'doctor',
                'phone' => '555-1002',
                'specialization' => 'Cardiology',
            ],
            [
                'name' => 'Dr. Emily Davis',
                'email' => 'emily.davis@meditrack.com',
                'password' => Hash::make('password'),
                'role' => 'doctor',
                'phone' => '555-1003',
                'specialization' => 'Pediatrics',
            ],
            [
                'name' => 'Nurse Jennifer Wilson',
                'email' => 'jennifer.wilson@meditrack.com',
                'password' => Hash::make('password'),
                'role' => 'nurse',
                'phone' => '555-2001',
                'specialization' => 'General Nursing',
            ],
            [
                'name' => 'Receptionist Lisa Johnson',
                'email' => 'lisa.johnson@meditrack.com',
                'password' => Hash::make('password'),
                'role' => 'receptionist',
                'phone' => '555-3001',
                'specialization' => null,
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
