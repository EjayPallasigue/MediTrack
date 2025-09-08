<?php

namespace Database\Seeders;

use App\Models\Patient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $patients = [
            [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'date_of_birth' => '1985-03-15',
                'gender' => 'male',
                'phone' => '555-0101',
                'email' => 'john.doe@email.com',
                'address' => '123 Main Street',
                'city' => 'Springfield',
                'state' => 'IL',
                'postal_code' => '62701',
                'emergency_contact_name' => 'Jane Doe',
                'emergency_contact_phone' => '555-0102',
                'notes' => 'Allergic to penicillin',
            ],
            [
                'first_name' => 'Sarah',
                'last_name' => 'Johnson',
                'date_of_birth' => '1990-07-22',
                'gender' => 'female',
                'phone' => '555-0201',
                'email' => 'sarah.johnson@email.com',
                'address' => '456 Oak Avenue',
                'city' => 'Springfield',
                'state' => 'IL',
                'postal_code' => '62702',
                'emergency_contact_name' => 'Mike Johnson',
                'emergency_contact_phone' => '555-0202',
                'notes' => 'Regular checkups',
            ],
            [
                'first_name' => 'Robert',
                'last_name' => 'Smith',
                'date_of_birth' => '1978-11-08',
                'gender' => 'male',
                'phone' => '555-0301',
                'email' => 'robert.smith@email.com',
                'address' => '789 Pine Street',
                'city' => 'Springfield',
                'state' => 'IL',
                'postal_code' => '62703',
                'emergency_contact_name' => 'Lisa Smith',
                'emergency_contact_phone' => '555-0302',
                'notes' => 'Diabetes management',
            ],
            [
                'first_name' => 'Emily',
                'last_name' => 'Davis',
                'date_of_birth' => '1995-04-12',
                'gender' => 'female',
                'phone' => '555-0401',
                'email' => 'emily.davis@email.com',
                'address' => '321 Elm Street',
                'city' => 'Springfield',
                'state' => 'IL',
                'postal_code' => '62704',
                'emergency_contact_name' => 'David Davis',
                'emergency_contact_phone' => '555-0402',
                'notes' => 'Prenatal care',
            ],
            [
                'first_name' => 'Michael',
                'last_name' => 'Wilson',
                'date_of_birth' => '1982-09-25',
                'gender' => 'male',
                'phone' => '555-0501',
                'email' => 'michael.wilson@email.com',
                'address' => '654 Maple Drive',
                'city' => 'Springfield',
                'state' => 'IL',
                'postal_code' => '62705',
                'emergency_contact_name' => 'Susan Wilson',
                'emergency_contact_phone' => '555-0502',
                'notes' => 'Cardiology follow-up',
            ],
        ];

        foreach ($patients as $patient) {
            Patient::create($patient);
        }
    }
}
