<?php

namespace App\Policies;

use App\Models\Apply;
use App\Models\Barber;
use App\Models\Shop;
use Illuminate\Auth\Access\HandlesAuthorization;

class ApplyPolicy
{
    use HandlesAuthorization;

    public function viewAny($entity, Shop $shop)
    {
        return ($entity instanceof Barber) && $entity->isOwnerOfShop($shop);
    }

    public function view($entity, Apply $apply, Shop $shop)
    {
        return ($entity instanceof Barber) && (
            $entity->isOwnerOfShop($shop) || $entity->id === $apply->barber->id
        );
    }

    public function create($entity, Shop $shop)
    {
        return $entity instanceof Barber;
    }

    public function update($entity, Apply $apply, Shop $shop)
    {
        return ($entity instanceof Barber) && ($entity->id === $apply->barber->id);
    }

    public function delete($entity, Apply $apply, Shop $shop)
    {
        return ($entity instanceof Barber) && ($entity->id === $apply->barber->id);
    }

    public function restore($entity, Apply $apply, Shop $shop)
    {
        //
    }

    public function forceDelete($entity, Apply $apply, Shop $shop)
    {
        //
    }
}
