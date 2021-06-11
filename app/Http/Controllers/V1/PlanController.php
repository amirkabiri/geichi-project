<?php

namespace App\Http\Controllers\V1;

use App\Http\Requests\PlanRequest;
use App\Http\Resources\PlanResource;
use App\Models\Plan;
use App\Http\Controllers\Controller;
use App\Services\PlansService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PlanController extends Controller
{
    private PlansService $plansService;

    public function __construct(PlansService $plansService)
    {
        $this->plansService = $plansService;
    }

    public function index()
    {
        return $this->plansService->get();
    }

    public function show($plan): PlanResource
    {
        $plan = $this->plansService->find($plan);

        return new PlanResource($plan);
    }
}
