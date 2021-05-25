<?php

namespace App\Policies;

use App\Models\Barber;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReservationPolicy
{
    use HandlesAuthorization;

    public function viewAny($entity) {
        return true;
    }

    public function view($entity, Reservation $reservation) {
        return true;
    }

    public function create($entity) {
        return $entity instanceof User;
    }

    public function update($entity, Reservation $reservation) {
        return false;
    }

    public function delete($entity, Reservation $reservation) {
        return ($entity instanceof Barber) && ($reservation->user_id === $entity->id);
    }

    public function restore($entity, Reservation $reservation) {
        return false;
    }

    public function forceDelete($entity, Reservation $reservation) {
        return false;
    }
}
