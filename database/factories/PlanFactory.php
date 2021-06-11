<?php

namespace Database\Factories;

use App\Models\Plan;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlanFactory extends Factory
{
    protected $model = Plan::class;

    public function definition()
    {
        return [
            'title' => 'Plan ' . $this->faker->word,
            'description' => implode(' ', $this->faker->words(100)),
            'price' => $this->faker->numberBetween(0, 5000),
            'barbers_count' => $this->faker->numberBetween(0, 100),
            'prepayment' => $this->faker->boolean,
        ];
    }
}
