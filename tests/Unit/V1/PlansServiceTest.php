<?php

namespace Tests\Unit\V1;

use App\Http\Resources\PlanResource;
use App\Models\Plan;
use App\Models\User;
use App\Services\PlansService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PlansServiceTest extends TestCase
{
    use RefreshDatabase;

    private PlansService $plansService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->plansService = $this->app->make(PlansService::class);
    }

    public function test_get__is_paginated()
    {
        $plans = $this->loginAsUser()->plansService->get();

        $this->assertPaginatedResource($plans);
    }

    public function test_get__returns_plans(){
        $plans = PlanResource::collection(Plan::factory(1)->create());


        $res = $this->loginAsUser()->plansService->get()->toArray();

        $this->assertJsonStringEqualsJsonString([
            'data' => $plans->resolve()
        ]);
    }
}
