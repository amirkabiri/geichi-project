<?php

use Faker\Factory as Faker;

if(! function_exists('generateFakePhone')){
    function generateFakePhone(){
        $faker = Faker::create();
        return '+989' . $faker->numberBetween(100000000, 999999999);
    }
}
