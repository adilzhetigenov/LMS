<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\Solution;

class SolutionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tasks = Task::all();
        
        foreach ($tasks as $task) {
            // Get students enrolled in this subject
            $enrolledStudents = $task->subject->students;
            
            // Create 1-3 solutions per task for each enrolled student
            foreach ($enrolledStudents as $student) {
                $solutionCount = rand(1, 3);
                Solution::factory()->count($solutionCount)->create([
                    'task_id' => $task->id,
                    'student_id' => $student->id,
                    'points' => 0,
                    'status' => 'not evaluated',
                    'submitted_at' => now(),
                    'evaluated_at' => null,
                    'comments' => null
                ]);
            }
        }
    }
}
