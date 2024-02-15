<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class TravelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'slug' => fake()->name(),
            'description' => fake()->text(200),
            'numberOfDays' => fake()->numberBetween(1, 99),
            'public' => fake()->boolean(),
            'moods' => [
                'nature' => 80,
                'relax' => 20,
                'history' => 90,
                'culture' => 30,
                'party' => 10,
            ],
        ];
    }
}
