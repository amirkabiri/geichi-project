<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApplyResource;
use App\Http\Resources\BarberResource;
use App\Models\Apply;
use App\Models\Barber;
use App\Models\Shop;
use Illuminate\Http\Request;

class BarberController extends Controller
{
    public function index(Shop $shop){
        return BarberResource::collection($shop->barbers);
    }

    public function show(Shop $shop, Barber $barber){
        return new BarberResource($barber);
    }

    public function fire(Shop $shop, Barber $barber){
        $this->authorize('fireBarber', $shop);
        if($barber->shop_id !== $shop->id) abort(404);

        $barber->shop_id = null;
        $barber->save();
    }
}
