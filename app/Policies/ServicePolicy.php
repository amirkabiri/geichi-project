<?php

namespace App\Policies;

use App\Models\Barber;
use App\Models\Service;
use App\Models\Shop;
use Illuminate\Auth\Access\HandlesAuthorization;

class ServicePolicy
{
    use HandlesAuthorization;

    public function viewAny($entity, Shop $shop)
    {
        return true;
    }

    public function view($entity, Service $service, Shop $shop)
    {
        return true;
    }

    public function create($entity, Shop $shop)
    {
        return ($entity instanceof Barber) && $entity->isOwnerOfShop($shop);
    }

    public function update($entity, Service $service, Shop $shop)
    {
        return ($entity instanceof Barber) && $entity->isOwnerOfShop($shop);
    }

    public function delete($entity, Service $service, Shop $shop)
    {
        return ($entity instanceof Barber) && $entity->isOwnerOfShop($shop);
    }

    public function restore($entity, Service $service, Shop $shop)
    {
        //
    }

    public function forceDelete($entity, Service $service, Shop $shop)
    {
        //
    }
}
