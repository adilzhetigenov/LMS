<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subject;
use App\Models\User;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a teacher if none exists
        if (!User::where('role', 'teacher')->exists()) {
            User::factory()->create([
                'name' => 'Test Teacher',
                'email' => 'teacher@example.com',
                'role' => 'teacher'
            ]);
        }

        // Create subjects
        Subject::factory()->count(5)->create();
    }
}
