<?php

namespace Database\Factories;

use App\Models\Barber;
use App\Models\BarberService;
use App\Models\Service;
use App\Models\Shop;
use Illuminate\Database\Eloquent\Factories\Factory;

class BarberServiceFactory extends Factory
{
    protected $model = BarberService::class;

    public function definition()
    {
        $shop = Shop::factory()->create();
        $barber_id = Barber::factory()->create(['shop_id' => $shop->id])->id;
        $service_id = Service::factory()->create(['shop_id' => $shop->id])->id;

        return compact('barber_id', 'service_id');
    }
}
