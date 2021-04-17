<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function withAcceptJSONHeader(): TestCase
    {
        return $this->withHeader('Accept', 'application/json');
    }

    public function route($route = '', $params = []): string{
        return route(($this->route_name_prefix ?? '') . $route, $params);
    }
}
