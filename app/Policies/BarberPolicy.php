<?php

namespace App\Policies;

use App\Models\Barber;
use Illuminate\Auth\Access\HandlesAuthorization;

class BarberPolicy
{
    use HandlesAuthorization;

    public function viewAny($entity)
    {
        //
    }

    public function view($entity, Barber $barber)
    {
        //
    }

    public function create($entity)
    {
        //
    }

    public function update($entity, Barber $barber)
    {
        //
    }

    public function delete($entity, Barber $barber)
    {
        //
    }

    public function restore($entity, Barber $barber)
    {
        //
    }

    public function forceDelete($entity, Barber $barber)
    {
        //
    }
}
