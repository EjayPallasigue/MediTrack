<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@meditrack.local',
            'password' => Hash::make('MediTrack@123'),
            'email_verified_at' => now(),
        ]);
    }
}