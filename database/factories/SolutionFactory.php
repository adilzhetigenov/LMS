<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Task;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Solution>
 */
class SolutionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'solution' => fake()->paragraph(),
            'task_id' => Task::factory(),
            'student_id' => User::factory(),
            'points' => 0,
            'status' => 'not evaluated',
            'submitted_at' => now(),
            'evaluated_at' => null,
            'comments' => null
        ];
    }
}
