<?php

namespace Database\Factories;

use App\Models\Apply;
use App\Models\Barber;
use App\Models\Shop;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApplyFactory extends Factory
{
    protected $model = Apply::class;

    public function definition()
    {
        $barber = Barber::factory()->create();
        $shop = Shop::factory()->create();

        return [
            'barber_id' => $barber->id,
            'shop_id' => $shop->id,
            'description' => $this->faker->text,
            'status' => $this->faker->randomElement(['accepted', 'denied', 'pending']),
        ];
    }
}
