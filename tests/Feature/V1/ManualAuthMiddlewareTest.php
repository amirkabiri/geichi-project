<?php

namespace Tests\Feature\V1;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class ManualAuthMiddlewareTest extends TestCase
{
    public $route_name_prefix = 'api.v1.shops.index';

    public function test_this_middleware_is_off_on_production()
    {
        $this->assumeProductionEnvironment();

        $response = $this->withAcceptJSONHeader()->get($this->route());

        $response->assertUnauthorized();
    }
}
