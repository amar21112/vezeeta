<?php

namespace Database\Seeders;

use App\Models\PatientAppointment;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Appointment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PatientAppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create some sample users if they don't exist
        if (User::count() == 0) {
            User::create([
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'phone' => '12345678900',
                'password' => bcrypt('password'),
            ]);
            
            User::create([
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'phone' => '12345678901',
                'password' => bcrypt('password'),
            ]);
            
            User::create([
                'name' => 'Mike Johnson',
                'email' => 'mike@example.com',
                'phone' => '12345678902',
                'password' => bcrypt('password'),
            ]);
        }

        // Create sample doctors if they don't exist
        if (Doctor::count() == 0) {
            Doctor::create([
                'name' => 'Dr. Sarah',
                'surname' => 'Wilson',
                'email' => 'sarah@vezeeta.com',
                'phone' => '12345678903',
                'password' => bcrypt('password'),
                'graduate_from' => 'Medical University',
                'graduate_in' => 2015,
                'about' => 'Experienced cardiologist',
                'governorate' => 'Cairo',
                'city' => 'New Cairo',
                'street' => 'Main Street',
                'is_active' => true,
            ]);
            
            Doctor::create([
                'name' => 'Dr. Ahmed',
                'surname' => 'Hassan',
                'email' => 'ahmed@vezeeta.com',
                'phone' => '12345678904',
                'password' => bcrypt('password'),
                'graduate_from' => 'Cairo University',
                'graduate_in' => 2018,
                'about' => 'Pediatrician specialist',
                'governorate' => 'Giza',
                'city' => 'Dokki',
                'street' => 'Nile Street',
                'is_active' => true,
            ]);
        }

        // Create sample appointments if they don't exist
        if (Appointment::count() == 0) {
            $doctors = Doctor::all();
            foreach ($doctors as $doctor) {
                for ($i = 1; $i <= 5; $i++) {
                    Appointment::create([
                        'doctor_id' => $doctor->id,
                        'date' => Carbon::now()->addDays($i)->format('Y-m-d'),
                        'time' => '10:00:00',
                        'price' => 200,
                    ]);
                    
                    Appointment::create([
                        'doctor_id' => $doctor->id,
                        'date' => Carbon::now()->addDays($i)->format('Y-m-d'),
                        'time' => '14:00:00',
                        'price' => 200,
                    ]);
                }
            }
        }

        // Create patient appointments with different statuses
        $users = User::all();
        $appointments = Appointment::all();
        $statuses = ['pending', 'confirmed', 'completed', 'cancelled'];

        foreach ($users as $user) {
            foreach ($appointments->take(6) as $index => $appointment) {
                PatientAppointment::create([
                    'user_id' => $user->id,
                    'doctor_id' => $appointment->doctor_id,
                    'appointment_id' => $appointment->id,
                    'status' => $statuses[$index % 4],
                    'created_at' => Carbon::now()->subDays(rand(1, 30)),
                    'updated_at' => Carbon::now()->subDays(rand(1, 30)),
                ]);
            }
        }
    }
}
