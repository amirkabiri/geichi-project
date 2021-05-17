<?php

namespace App\Policies;

use App\Models\Barber;
use App\Models\Shop;
use Illuminate\Auth\Access\HandlesAuthorization;

class ShopPolicy
{
    use HandlesAuthorization;

    // Determine whether the entity can view any models.
    public function viewAny($entity)
    {
        return true;
    }

    // Determine whether the entity can view the model.
    public function view($entity, Shop $shop)
    {
        return true;
    }

    // Determine whether the entity can create models.
    public function create($entity)
    {
        return $entity instanceof Barber;
    }

    // Determine whether the entity can update the model.
    public function update($entity, Shop $shop)
    {
        return ($entity instanceof Barber) && $entity->isOwnerOfShop($shop);
    }

    // Determine whether the entity can delete the model.
    public function delete($entity, Shop $shop)
    {
        return ($entity instanceof Barber) && $entity->isOwnerOfShop($shop);
    }

    // Determine whether the entity can restore the model.
    public function restore($entity, Shop $shop)
    {
        //
    }

    // Determine whether the entity can permanently delete the model.
    public function forceDelete($entity, Shop $shop)
    {
        //
    }

    // Determines whether the entity(barber) can apply to work in the shop.
    // for this purpose, entity(barber) should be unemployed
    public function applyBarber($entity, Shop $shop){
        return ($entity instanceof Barber) && ($entity->ownings()->count() === 0) && is_null($entity->shop_id);
    }

    // Determines whether the entity can fire the barber.
    public function fireBarber($entity, Shop $shop){
        return ($entity instanceof Barber) && ($shop->owner->id === $entity->id);
    }

    // Determines whether the entity can server any service in the shop
    public function serveService($entity, Shop $shop){
        return ($entity instanceof Barber) && ($entity->shop_id === $shop->id);
    }
}
