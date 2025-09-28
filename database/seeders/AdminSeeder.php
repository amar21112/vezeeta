<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'name' => 'Super Admin',
            'email' => 'admin@vezeeta.com',
            'phone' => '12345678900',
            'password' => Hash::make('admin123'),
        ]);

        Admin::create([
            'name' => 'John Doe',
            'email' => 'john@vezeeta.com',
            'phone' => '12345678910',
            'password' => Hash::make('password123'),
        ]);
    }
}
