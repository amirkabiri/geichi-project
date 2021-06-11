<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Plan;
use Illuminate\Auth\Access\HandlesAuthorization;

class PlanPolicy
{
    use HandlesAuthorization;

    public function before($entity, $ability)
    {
        if ($entity instanceof Admin) return true;
    }

    public function viewAny($entity)
    {
        return true;
    }

    public function view($entity, Plan $plan)
    {
        return true;
    }

    public function create($entity)
    {
        return false;
    }

    public function update($entity, Plan $plan)
    {
        return false;
    }

    public function delete($entity, Plan $plan)
    {
        return false;
    }

    public function restore($entity, Plan $plan)
    {
        return false;
    }

    public function forceDelete($entity, Plan $plan)
    {
        return false;
    }
}
