<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;
use App\Models\Barber;
use App\Models\Service;
use App\Models\Shop;
use Illuminate\Http\Request;

class BarberServiceController extends Controller
{
    private function acceptOrFail(Shop $shop, Barber $barber, Service|null $service = null){
        if($barber->shop_id !== $shop->id ||
            !is_null($service) && !$barber->services->contains($service->id) ||
            !is_null($service) && $service->shop_id !== $shop->id) {
            abort(404);
        }
    }

    public function index(Shop $shop, Barber $barber)
    {
        $this->acceptOrFail($shop, $barber);

        return ServiceResource::collection($barber->services);
    }

    public function show(Shop $shop, Barber $barber, Service $service)
    {
        $this->acceptOrFail($shop, $barber, $service);

        return new ServiceResource($service);
    }

    public function reserve(Shop $shop, Barber $barber, Service $service){
        $this->acceptOrFail($shop, $barber, $service);


    }
}
