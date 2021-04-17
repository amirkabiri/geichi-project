<?php

namespace App\Http\Controllers\V1;

use App\Http\Requests\PlanRequest;
use App\Http\Resources\PlanResource;
use App\Models\Plan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PlanController extends Controller
{
    public function __construct()
    {
//        $this->authorizeResource(Plan::class, 'plan');
    }

    public function index(): AnonymousResourceCollection
    {
        return PlanResource::collection(Plan::paginate());
    }

    public function store(PlanRequest $request): PlanResource
    {
        $plan = Plan::create($request->validated());
        return new PlanResource($plan);
    }

    public function show(Plan $plan): PlanResource
    {
        return new PlanResource($plan);
    }

    public function update(PlanRequest $request, Plan $plan): PlanResource
    {
        $plan->update($request->validated());
        return new PlanResource($plan);
    }

    public function destroy(Plan $plan): PlanResource
    {
        $plan->delete();
        return new PlanResource($plan);
    }
}
