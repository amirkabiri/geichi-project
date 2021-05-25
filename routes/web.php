<?php

use App\Http\Controllers\DocsController;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Morilog\Jalali\Jalalian;

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

Route::get('/test-time', function(){
    $timestamp = (string) Carbon::tomorrow()->addHours(15)->timestamp;
    $carbon = Carbon::createFromTimestamp($timestamp);

    return jdate($timestamp);
    return Jalalian::fromCarbon($carbon);

    $validation = Validator::make(request()->all(), [
        'date' => 'required|date'
    ]);

    return $validation->errors();

    return Jalalian::fromFormat('Y-m-d H:i:s', '1397-01-18 12:00:40');
    return Jalalian::fromDateTime('1400-03-01 13:15')->toString();
    return (new Carbon('2021-05-23 13:15:00'))->toDateTimeString();
//    return Carbon::tomorrow()->addHours(13)->addMinutes(15)->toDateTimeString();
});
