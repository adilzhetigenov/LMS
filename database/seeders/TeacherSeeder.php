<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TeacherSeeder extends Seeder
{
    public function run(): void
    {
        $teachers = [
            [
                'name' => 'John Smith',
                'email' => 'john.smith@example.com',
                'password' => Hash::make('password123')
            ],
            [
                'name' => 'Sarah Johnson',
                'email' => 'sarah.johnson@example.com',
                'password' => Hash::make('password123')
            ],
            [
                'name' => 'Michael Brown',
                'email' => 'michael.brown@example.com',
                'password' => Hash::make('password123')
            ]
        ];

        foreach ($teachers as $teacher) {
            // Check if teacher already exists
            if (!User::where('email', $teacher['email'])->exists()) {
                User::factory()
                    ->teacher()
                    ->state($teacher)
                    ->create();
            }
        }
    }
} 