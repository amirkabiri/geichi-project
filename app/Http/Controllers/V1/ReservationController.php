<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReservationResource;
use App\Models\Barber;
use App\Models\BarberService;
use App\Models\Reservation;
use App\Models\Service;
use App\Models\Shop;
use App\Rules\BarberServiceTimeIsFree;
use App\Rules\FutureTimestamp;
use App\Rules\Timestamp;
use App\Rules\TimestampGreaterThan;
use App\Rules\TimestampLessThan;
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

        $this->authorize('viewAny', Reservation::class);

        $barberService = $this->getBarberService($barber, $service);
        $reservations = Reservation::where('barber_service_id', $barberService->id);

        return paginate($reservations);
    }

    public function show(Shop $shop, Barber $barber, Service $service, Reservation $reservation){
        $this->acceptOrFail($shop, $barber, $service, $reservation);

        $this->authorize('view', $reservation);

        return new ReservationResource($reservation);
    }

    public function store(Shop $shop, Barber $barber, Service $service, Request $request){
        $this->acceptOrFail($shop, $barber, $service);

        $this->authorize('create', Reservation::class);

        $barberService = $this->getBarberService($barber, $service);
        $request->validate([
            'start_at' => [
                'required', new Timestamp, new TimestampGreaterThan(now()),
                new TimestampLessThan(now()->addDays(7)),
                new BarberServiceTimeIsFree($barberService)
            ],
        ]);

        $start_at = toCarbon($request->start_at);
        $reservation = Reservation::create([
            'user_id' => auth()->id(),
            'barber_service_id' => $barberService->id,
            'start_at' => $start_at,
            'end_at' => $start_at->copy()->addMinutes($service->time),
            'duration' => $service->time,
        ]);

        return new ReservationResource($reservation);
    }

    public function update(Shop $shop, Barber $barber, Service $service, Reservation $reservation){
        $this->acceptOrFail($shop, $barber, $service, $reservation);

        $this->authorize('update', Reservation::class);

        // todo implement reservation update
    }

    public function destroy(Shop $shop, Barber $barber, Service $service, Reservation $reservation){
        $this->acceptOrFail($shop, $barber, $service, $reservation);

        $this->authorize('delete', $reservation);

        $reservation->delete();
    }
}
