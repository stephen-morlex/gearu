<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ExchangeRate>
 */
class ExchangeRateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date' => $this->faker->dateTimeBetween('2025-05-01', 'now')->format('Y-m-d'),
            'selling_rate' => $this->faker->randomFloat(2, 5800, 5900),
            'buying_rate' => $this->faker->randomFloat(2, 6100, 63000),
            'currency_id' => \App\Models\Currency::factory(),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}