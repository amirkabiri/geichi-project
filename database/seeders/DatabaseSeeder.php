<?php

namespace Database\Seeders;

use App\Models\Apply;
use App\Models\Barber;
use App\Models\Comment;
use App\Models\Plan;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::factory(10)->create();
        Barber::factory(10)->create();
        Plan::factory(3)->create();
        Shop::factory(10)->create();

        foreach (Shop::all() as $shop){
            $shop_id = $shop->id;

            Comment::factory(10)->create(compact('shop_id'));
            Apply::factory(10)->create(compact('shop_id'));
        }
    }
}
