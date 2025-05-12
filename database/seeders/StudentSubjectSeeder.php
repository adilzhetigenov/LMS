<?php

namespace Database\Seeders;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Seeder;

class StudentSubjectSeeder extends Seeder
{
    public function run(): void
    {
        // Create some students if they don't exist
        $students = User::where('role', 'student')->get();
        if ($students->isEmpty()) {
            User::factory()->count(10)->create(['role' => 'student']);
            $students = User::where('role', 'student')->get();
        }

        // Get all subjects
        $subjects = Subject::all();

        // Enroll students in subjects
        foreach ($subjects as $subject) {
            // Ensure we have at least 3 students before trying to enroll them
            if ($students->count() < 3) {
                // Create more students if needed
                $additionalStudents = User::factory()->count(10)->create(['role' => 'student']);
                $students = $students->concat($additionalStudents);
            }
            
            // Randomly select 3-7 students to enroll in this subject
            $enrolledStudents = $students->random(rand(3, min(7, $students->count())));
            
            foreach ($enrolledStudents as $student) {
                // Check if student is already enrolled
                if (!$subject->students->contains($student->id)) {
                    $subject->students()->attach($student->id);
                }
            }
        }
    }
} 