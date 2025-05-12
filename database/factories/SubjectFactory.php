<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subject>
 */
class SubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Generate subject code in format IK-SSSNNN
        $letters = strtoupper(fake()->lexify('???'));
        $numbers = fake()->numerify('###');
        $code = "IK-{$letters}{$numbers}";

        return [
            'name' => fake()->words(3, true),
            'description' => fake()->paragraph(),
            'code' => $code,
            'credits' => fake()->numberBetween(1, 9),
            'teacher_id' => User::where('role', 'teacher')->inRandomOrder()->first()->id ,
            'student_id' => User::where('role', 'student')->inRandomOrder()->first()->id ?? 
                           User::factory()->create(['role' => 'student'])->id,
        ];
    }
}
