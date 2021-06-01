<?php

namespace Database\Seeders;

use App\Models\Apply;
use App\Models\Barber;
use App\Models\Comment;
use App\Models\Plan;
use App\Models\Service;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            AdminSeeder::class
        ]);

        $barber = Barber::factory()->create(['phone' => '09146878528']);
        $shop = Shop::factory()->create(['owner_id' => $barber->id]);
        $barber->update(['shop_id' => $shop->id]);

        User::factory(10)->create();
        Barber::factory(10)->create();
        Plan::factory(3)->create();
        Shop::factory(10)->create();

        foreach (Shop::all() as $shop){
            $data = ['shop_id' => $shop->id];

            Comment::factory(10)->create($data);
            Apply::factory(10)->create($data);
            Service::factory(10)->create($data);
        }
    }
}
