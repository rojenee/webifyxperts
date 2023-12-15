<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Laundry>
 */
class LaundryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => rand(1, 10),
            'laundry_name' => fake()->text(20),
            'weight_laundry' => 20,
            'base_price_per_weight' => 70,
            'total_laundry_price' => 20 * 70,
        ];
    }
}
