<?php

namespace App\Observers;

use App\Events\CommentSenderDeleted;
use App\Models\Barber;

class BarberObserver
{
    /**
     * Handle the Barber "created" event.
     *
     * @param  \App\Models\Barber  $barber
     * @return void
     */
    public function created(Barber $barber)
    {
        //
    }

    /**
     * Handle the Barber "updated" event.
     *
     * @param  \App\Models\Barber  $barber
     * @return void
     */
    public function updated(Barber $barber)
    {
        //
    }

    /**
     * Handle the Barber "deleted" event.
     *
     * @param  \App\Models\Barber  $barber
     * @return void
     */
    public function deleted(Barber $barber)
    {
        CommentSenderDeleted::dispatch($barber);
    }

    /**
     * Handle the Barber "restored" event.
     *
     * @param  \App\Models\Barber  $barber
     * @return void
     */
    public function restored(Barber $barber)
    {
        //
    }

    /**
     * Handle the Barber "force deleted" event.
     *
     * @param  \App\Models\Barber  $barber
     * @return void
     */
    public function forceDeleted(Barber $barber)
    {
        //
    }
}
