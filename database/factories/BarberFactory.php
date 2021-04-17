<?php

namespace Database\Factories;

use App\Models\Barber;
use Illuminate\Database\Eloquent\Factories\Factory;

class BarberFactory extends Factory
{
    protected $model = Barber::class;

    public function definition()
    {
        return [
            'phone' => '+989' . $this->faker->numberBetween(100000000, 999999999),
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'start_time' => $this->faker->numberBetween(7, 14),
            'end_time' => $this->faker->numberBetween(19, 24),
        ];
    }
}
