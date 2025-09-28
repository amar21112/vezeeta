<?php

namespace Database\Seeders;

use App\Models\Specialist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecialistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $specialists = [
            'Cardiology',
            'Pediatrics',
            'Dermatology',
            'Orthopedics',
            'Neurology',
            'Gynecology',
            'Ophthalmology',
            'ENT (Ear, Nose, Throat)',
            'Psychiatry',
            'General Medicine',
            'Oncology',
            'Radiology',
            'Anesthesiology',
            'Pathology',
            'Emergency Medicine',
            'Adult Dentistry',
            'Pediatric Dentistry',
            'Elder Dentistry',
            'Orthodontics',
            'Endodontics',
            'Cosmetic Dentistry',
            'Implantology',
            'Oral and Maxillofacial Surgery',
            'Periodontics',
            'Prosthodontics',
            'Oral Radiology'
        ];

        foreach ($specialists as $specialistName) {
            Specialist::firstOrCreate([
                'special_name' => $specialistName
            ]);
        }
    }
}
