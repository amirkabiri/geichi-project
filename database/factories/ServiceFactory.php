<?php

namespace Database\Factories;

use App\Models\Service;
use App\Models\Shop;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    protected $model = Service::class;

    public function definition()
    {
        $shop = Shop::factory()->create();
        return [
            'shop_id' => $shop->id,
            'title' => implode(' ', $this->faker->words(3)),
            'price' => (string)($this->faker->numberBetween(10, 50) * 1000),
            'time' => $this->faker->numberBetween(1,4),
        ];
    }
}
