<?php

namespace Tests;

use App\Models\Barber;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Pagination\AbstractPaginator;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $actingAsEntity;

    public function assumeProductionEnvironment(){
        app()->detectEnvironment(function(){
            return 'production';
        });
    }

    public function withAcceptJSONHeader(): TestCase
    {
        return $this->withHeader('Accept', 'application/json');
    }

    public function route($route = '', $params = []): string{
        return route(($this->route_name_prefix ?? '') . $route, $params);
    }

    public function loginAsBarber(){
        $barber = Barber::factory()->create();
        $this->actingAsEntity = $barber;
        return $this->actingAs($barber, 'barber');
    }

    public function loginAsUser(){
        $user = User::factory()->create();
        $this->actingAsEntity = $user;
        return $this->actingAs($user, 'user');
    }

    public function expectAuthorizationException(){
        $this->expectException(AuthorizationException::class);
    }

    public function assertPaginatedResource($resouce){
        $this->assertInstanceOf(AbstractPaginator::class, $resouce);
    }
}
