<?php

namespace Database\Factories;

use App\Models\Plan;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Plan::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => 'Plan ' . $this->faker->word,
            'description' => $this->faker->sentence,
            'price' => $this->faker->numberBetween(0, 5000),
            'barbers_count' => $this->faker->numberBetween(0, 100),
            'prepayment' => $this->faker->boolean,
        ];
    }
}
