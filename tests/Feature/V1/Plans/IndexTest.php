<?php

namespace Tests\Feature\V1\Plans;

use App\Http\Resources\PlanResource;
use App\Models\Plan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    public $route_name_prefix = 'api.v1.plans.index';

    public function test_status(){
        $response = $this->get($this->route());

        $response->assertStatus(200);
    }

    public function test_empty_data(){
        $plans = Plan::paginate();
        $resource = PlanResource::collection($plans);

        $response = $this->get($this->route());
        $response->assertJson([
            'data' => $resource->resolve()
        ]);
    }

    public function test_data(){
        Plan::factory()->count(30)->create();

        $plans = Plan::paginate();
        $resource = PlanResource::collection($plans);

        $response = $this->get($this->route());
        $response->assertJson([
            'data' => $resource->resolve()
        ]);
    }
}
