<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date' => fake()->date(),
            'time' => fake()->time(),
            'price' => 250,
            'status' => fake()->randomElement(['pending', 'confirmed', 'cancelled']),
            'user_id' => User::inRandomOrder()->first()->id,
            'notes' => fake()->sentence(),
        ];
    }
}
