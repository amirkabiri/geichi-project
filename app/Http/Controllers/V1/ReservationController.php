<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReservationResource;
use App\Models\Barber;
use App\Models\BarberService;
use App\Models\Reservation;
use App\Models\Service;
use App\Models\Shop;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    private function getBarberService(Barber $barber, Service $service){
        return BarberService::where('barber_id', $barber->id)
            ->where('service_id', $service->id)
            ->first();
    }
    private function acceptOrFail(Shop $shop, Barber $barber, Service $service, null|Reservation $reservation = null){
        // todo : also I should check $reservation
        $condition =
            ($barber->shop_id !== $shop->id) ||
            !$barber->services->contains($service->id) ||
            $service->shop_id !== $shop->id;

        if($condition) abort(404);
    }

    public function index(Shop $shop, Barber $barber, Service $service){
        $this->acceptOrFail($shop, $barber, $service);

        $barberService = $this->getBarberService($barber, $service);
        $reservations = Reservation::where('barber_service_id', $barberService->id)->paginate();

        return $reservations;
    }

    public function show(Shop $shop, Barber $barber, Service $service, Reservation $reservation){
        $this->acceptOrFail($shop, $barber, $service, $reservation);

        return new ReservationResource($reservation);
    }

    public function store(Shop $shop, Barber $barber, Service $service){
        $this->acceptOrFail($shop, $barber, $service);

        $barberService = $this->getBarberService($barber, $service);
    }
}
