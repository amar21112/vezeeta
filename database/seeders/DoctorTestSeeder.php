<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Doctor;
use App\Models\Specialist;
use App\Models\Appointment;
use Carbon\Carbon;

class DoctorTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create some specialists first
        $specialties = [
            ['special_name' => 'Cardiology'],
            ['special_name' => 'Dermatology'], 
            ['special_name' => 'Pediatrics'],
            ['special_name' => 'Orthopedics'],
            ['special_name' => 'Neurology'],
            ['special_name' => 'Dentistry'],
        ];

        foreach ($specialties as $specialty) {
            Specialist::firstOrCreate(['special_name' => $specialty['special_name']], $specialty);
        }

        // Sample doctors data
        $doctors = [
            [
                'name' => 'Mohamed',
                'surname' => 'Mostafa',
                'phone' => '01123456789',
                'email' => 'mohamed.mostafa@example.com',
                'password' => bcrypt('password123'),
                'graduate_from' => 'Cairo University',
                'graduate_in' => 2010,
                'about' => 'Dr. Mohamed Mostafa is a highly experienced cardiologist specializing in heart disease treatment and prevention. With over 15 years of experience, he has helped thousands of patients achieve better heart health.',
                'governorate' => 'cairo',
                'city' => 'Nasr City',
                'street' => 'Abbas Al Akkad Street',
                'is_active' => true,
                'image' => 'https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?w=400&h=400&fit=crop&crop=face',
                'rating' => 4.8,
                'reviews_count' => 245,
                'fees' => 300.00,
                'waiting_time' => 20,
                'call_cost' => 150.00,
                'telehealth_available' => true,
                'hospital_name' => 'Cairo Heart Center',
                'symptoms_services' => 'Heart Disease, Blood Pressure, Chest Pain, Arrhythmia',
                'specialties' => ['Cardiology']
            ],
            [
                'name' => 'Sara',
                'surname' => 'Ahmed',
                'phone' => '01123456790',
                'email' => 'sara.ahmed@example.com',
                'password' => bcrypt('password123'),
                'graduate_from' => 'Alexandria University',
                'graduate_in' => 2012,
                'about' => 'Dr. Sara Ahmed is a renowned dermatologist specializing in skin conditions, cosmetic dermatology, and laser treatments. She combines medical expertise with aesthetic sensibility.',
                'governorate' => 'alexandria',
                'city' => 'Sidi Gaber',
                'street' => 'Corniche Road',
                'is_active' => true,
                'image' => 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=400&h=400&fit=crop&crop=face',
                'rating' => 4.6,
                'reviews_count' => 189,
                'fees' => 250.00,
                'waiting_time' => 15,
                'call_cost' => 120.00,
                'telehealth_available' => true,
                'hospital_name' => 'Alexandria Skin Clinic',
                'symptoms_services' => 'Acne, Eczema, Skin Cancer Screening, Laser Treatment',
                'specialties' => ['Dermatology']
            ],
            [
                'name' => 'Omar',
                'surname' => 'Hassan',
                'phone' => '01123456791',
                'email' => 'omar.hassan@example.com',
                'password' => bcrypt('password123'),
                'graduate_from' => 'Ain Shams University',
                'graduate_in' => 2008,
                'about' => 'Dr. Omar Hassan is a dedicated pediatrician with extensive experience in child healthcare. He is known for his gentle approach with children and comprehensive care.',
                'governorate' => 'giza',
                'city' => 'Mohandessin',
                'street' => 'Gameat El Dewal Street',
                'is_active' => true,
                'image' => 'https://images.unsplash.com/photo-1582750433449-648ed127bb54?w=400&h=400&fit=crop&crop=face',
                'rating' => 4.7,
                'reviews_count' => 312,
                'fees' => 220.00,
                'waiting_time' => 18,
                'call_cost' => 100.00,
                'telehealth_available' => true,
                'hospital_name' => 'Children\'s Medical Center',
                'symptoms_services' => 'Vaccinations, Growth Monitoring, Pediatric Infections, Nutrition',
                'specialties' => ['Pediatrics']
            ],
            [
                'name' => 'Fatma',
                'surname' => 'Mahmoud',
                'phone' => '01123456792',
                'email' => 'fatma.mahmoud@example.com',
                'password' => bcrypt('password123'),
                'graduate_from' => 'Cairo University',
                'graduate_in' => 2015,
                'about' => 'Dr. Fatma Mahmoud is a skilled orthopedic surgeon specializing in bone and joint disorders. She has particular expertise in sports medicine and joint replacement.',
                'governorate' => 'cairo',
                'city' => 'Heliopolis',
                'street' => 'El Merghany Street',
                'is_active' => true,
                'image' => 'https://images.unsplash.com/photo-1594824375467-d8bb91e2a555?w=400&h=400&fit=crop&crop=face',
                'rating' => 4.5,
                'reviews_count' => 156,
                'fees' => 400.00,
                'waiting_time' => 25,
                'call_cost' => 200.00,
                'telehealth_available' => false,
                'hospital_name' => 'Orthopedic Excellence Hospital',
                'symptoms_services' => 'Joint Pain, Sports Injuries, Fractures, Arthritis',
                'specialties' => ['Orthopedics']
            ],
            [
                'name' => 'Amr',
                'surname' => 'Khaled',
                'phone' => '01123456793',
                'email' => 'amr.khaled@example.com',
                'password' => bcrypt('password123'),
                'graduate_from' => 'Mansoura University',
                'graduate_in' => 2013,
                'about' => 'Dr. Amr Khaled is a neurologist with expertise in brain and nervous system disorders. He uses advanced diagnostic techniques and modern treatment approaches.',
                'governorate' => 'cairo',
                'city' => 'Maadi',
                'street' => 'Corniche El Maadi',
                'is_active' => true,
                'image' => 'https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?w=400&h=400&fit=crop&crop=face',
                'rating' => 4.9,
                'reviews_count' => 98,
                'fees' => 450.00,
                'waiting_time' => 30,
                'call_cost' => 250.00,
                'telehealth_available' => true,
                'hospital_name' => 'Neuroscience Institute',
                'symptoms_services' => 'Headaches, Epilepsy, Stroke, Memory Disorders',
                'specialties' => ['Neurology']
            ]
        ];

        foreach ($doctors as $doctorData) {
            $specialtyNames = $doctorData['specialties'];
            unset($doctorData['specialties']);
            
            $doctor = Doctor::create($doctorData);
            
            // Attach specialties
            foreach ($specialtyNames as $specialtyName) {
                $specialty = Specialist::where('special_name', $specialtyName)->first();
                if ($specialty) {
                    $doctor->specialties()->attach($specialty->id);
                }
            }
            
            // Create sample appointments for each doctor
            $this->createAppointments($doctor->id);
        }
    }

    private function createAppointments($doctorId)
    {
        $appointments = [];
        $startDate = Carbon::now()->startOfDay();
        
        // Create appointments for the next 7 days
        for ($day = 0; $day < 7; $day++) {
            $date = $startDate->copy()->addDays($day);
            
            // Skip weekends for some doctors
            if ($date->isWeekend() && rand(0, 1)) {
                continue;
            }
            
            // Create appointments for different time slots
            $timeSlots = [
                '09:00:00', '09:30:00', '10:00:00', '10:30:00', '11:00:00', '11:30:00',
                '12:00:00', '12:30:00', '14:00:00', '14:30:00', '15:00:00', '15:30:00',
                '16:00:00', '16:30:00', '17:00:00', '17:30:00', '18:00:00', '18:30:00'
            ];
            
            foreach ($timeSlots as $time) {
                // Randomly create appointments (70% available, 30% booked)
                if (rand(1, 10) <= 7) {
                    $appointments[] = [
                        'doctor_id' => $doctorId,
                        'date' => $date->format('Y-m-d'),
                        'time' => $time,
                        'status' => rand(1, 10) <= 8 ? 'available' : 'booked',
                        'user_id' => rand(1, 10) <= 2 ? null : null, // Some booked appointments
                        'price' => rand(150, 500),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }
        }
        
        // Insert appointments in batches for better performance
        $chunks = array_chunk($appointments, 50);
        foreach ($chunks as $chunk) {
            Appointment::insert($chunk);
        }
    }
}
