<?php

namespace App\Policies;

use App\Models\Barber;
use App\Models\Shop;
use Illuminate\Auth\Access\HandlesAuthorization;

class ShopPolicy
{
    use HandlesAuthorization;

    // Determine whether the user can view any models.
    public function viewAny($entity)
    {
        return true;
    }

    // Determine whether the user can view the model.
    public function view($entity, Shop $shop)
    {
        return true;
    }

    // Determine whether the user can create models.
    public function create($entity)
    {
        return $entity instanceof Barber;
    }

    // Determine whether the user can update the model.
    public function update($entity, Shop $shop)
    {
        return ($entity instanceof Barber) && $entity->isOwnerOfShop($shop);
    }

    // Determine whether the user can delete the model.
    public function delete($entity, Shop $shop)
    {
        return ($entity instanceof Barber) && $entity->isOwnerOfShop($shop);
    }

    // Determine whether the user can restore the model.
    public function restore($entity, Shop $shop)
    {
        //
    }

    // Determine whether the user can permanently delete the model.
    public function forceDelete($entity, Shop $shop)
    {
        //
    }

    public function applyBarber($entity, Shop $shop){
        return ($entity instanceof Barber) && ($entity->ownings()->count() === 0) && is_null($entity->shop_id);
    }

    public function fireBarber($entity, Shop $shop){
        return ($entity instanceof Barber) && ($shop->owner->id === $entity->id);
    }
}
