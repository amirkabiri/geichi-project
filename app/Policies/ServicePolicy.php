<?php

namespace App\Policies;

use App\Models\Barber;
use App\Models\Service;
use Illuminate\Auth\Access\HandlesAuthorization;

class ServicePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\Barber  $barber
     * @return mixed
     */
    public function viewAny(Barber $barber)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Barber  $barber
     * @param  \App\Models\Service  $service
     * @return mixed
     */
    public function view(Barber $barber, Service $service)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Barber  $barber
     * @return mixed
     */
    public function create(Barber $barber)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Barber  $barber
     * @param  \App\Models\Service  $service
     * @return mixed
     */
    public function update(Barber $barber, Service $service)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Barber  $barber
     * @param  \App\Models\Service  $service
     * @return mixed
     */
    public function delete(Barber $barber, Service $service)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Barber  $barber
     * @param  \App\Models\Service  $service
     * @return mixed
     */
    public function restore(Barber $barber, Service $service)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Barber  $barber
     * @param  \App\Models\Service  $service
     * @return mixed
     */
    public function forceDelete(Barber $barber, Service $service)
    {
        //
    }
}
