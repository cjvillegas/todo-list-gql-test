<?php

namespace Database\Factories;

use App\Enums\Status;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->text,
            'status' => $this->faker->randomElement([Status::ACTIVE->value, Status::DONE->value]),
            'created_by_id' => User::first()->id,
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
