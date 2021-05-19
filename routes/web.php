<?php

use App\Http\Controllers\DocsController;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/', [DocsController::class, 'view']);

Route::get('/test', function(){
//    $bs = \App\Models\BarberService::factory()->create();
//    return $bs->with('service', 'barber', 'reservations')->find($bs->id);
    $user = User::factory()->create();
    $shop = \App\Models\Shop::factory()->create();
    $barber = \App\Models\Barber::factory()->create(['shop_id' => $shop->id]);
    $service = \App\Models\Service::factory()->create(['shop_id' => $shop->id]);
    $barber->services()->attach([$service->id]);
//    return $shop->with('barbers.services')->find($shop->id);
    $reservation = \App\Models\Reservation::factory()->create();
    return $reservation->load('barberService.barber', 'barberService.service');
    return $reservation->with('barber')->find($reservation->id);

    $barber = \App\Models\Barber::find(1);
//    $barber->services()->attach($barber->shop->services()->pluck('id'));
//    return $barber;
    return $barber->with('services')->first();
    return $barber->shop->services->save(\App\Models\Service::factory()->make());
});

Route::get('/reserve-test', function (){
    $tomorrow = \Carbon\Carbon::tomorrow();
    $shop = \App\Models\Shop::factory()->create();
    $barber = \App\Models\Barber::factory()->create(['shop_id' => $shop->id]);
    $service = \App\Models\Service::factory()->create(['shop_id' => $shop->id]);
    $barber->services()->attach([$service->id]);
    $barberService = \App\Models\BarberService::where('barber_id', $barber->id)->where('service_id', $service->id)->first();

    return $barberService;
});
