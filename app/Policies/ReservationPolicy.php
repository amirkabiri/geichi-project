<?php

namespace App\Policies;

use App\Models\Barber;
use App\Models\Reservation;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReservationPolicy
{
    use HandlesAuthorization;

    public function viewAny(Barber $barber)
    {
        //
    }

    public function view(Barber $barber, Reservation $reservation)
    {
        //
    }

    public function create(Barber $barber)
    {
        //
    }

    public function update(Barber $barber, Reservation $reservation)
    {
        //
    }

    public function delete(Barber $barber, Reservation $reservation)
    {
        //
    }

    public function restore(Barber $barber, Reservation $reservation)
    {
        //
    }

    public function forceDelete(Barber $barber, Reservation $reservation)
    {
        //
    }
}
