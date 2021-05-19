<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApplyResource;
use App\Http\Resources\BarberResource;
use App\Models\Apply;
use App\Models\Barber;
use App\Models\Service;
use App\Models\Shop;
use Illuminate\Http\Request;

class BarberController extends Controller
{
    private function acceptOrFail(Shop $shop, Barber|null $barber = null){
        if(!is_null($barber) && $barber->shop_id !== $shop->id) abort(404);
    }

    public function index(Shop $shop){
        $this->acceptOrFail($shop);

        return BarberResource::collection($shop->barbers);
    }

    public function show(Shop $shop, Barber $barber){
        $this->acceptOrFail($shop, $barber);

        return new BarberResource($barber);
    }

    public function fire(Shop $shop, Barber $barber){
        $this->acceptOrFail($shop, $barber);

        $this->authorize('fireBarber', $shop);

        $barber->shop_id = null;
        $barber->save();
    }
}
