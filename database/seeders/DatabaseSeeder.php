<?php

namespace Database\Seeders;

use App\Models\Barber;
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
    }
}
