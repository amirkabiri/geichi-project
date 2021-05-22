<?php

namespace Tests\Feature\V1;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LatestVerifyCodeTest extends TestCase
{
    protected $route_name_prefix = 'api.v1.latest-verify-code';

    public function test_endpoint_is_not_exists_on_production()
    {
        $this->assumeProductionEnvironment();

        $response = $this->withAcceptJSONHeader()->get($this->route_name_prefix);

        $response->assertNotFound();
    }
}
