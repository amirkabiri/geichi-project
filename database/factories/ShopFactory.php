<?php

namespace Database\Factories;

use App\Models\Plan;
use App\Models\Shop;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShopFactory extends Factory
{
    protected $model = Shop::class;

    public function definition()
    {
        $plan = Plan::factory()->create();
        $owner = User::factory()->create();
        return [
            'plan_id' => $plan->id,
            'owner' => $owner->id,
            'lat' => $this->faker->numberBetween(-90, 90),
            'lng' => $this->faker->numberBetween(-90, 90),
            'expire_at' => Carbon::now()->addDays($this->faker->numberBetween(0, 90)),
        ];
    }
}
