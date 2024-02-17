<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class TourFactory extends Factory
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
            'travelId' => fake()->uuid(),
            'startingDate' => fake()->dateTimeBetween(startDate: '+2 days', endDate: '+5 days'),
            'endingDate' => fake()->dateTimeBetween(startDate: '+5 days', endDate: '+365 days'),
            'price' => fake()->randomNumber(5),
        ];
    }
}
