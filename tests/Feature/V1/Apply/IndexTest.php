<?php

namespace Tests\Feature\V1\Apply;

use App\Models\Apply;
use App\Models\Barber;
use App\Models\Shop;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    public $route_name_prefix = 'api.v1.shops.applies.';


    // todo fix Apply test, requests get 403 error
    public function test_status()
    {
        $barber = Barber::factory()->create();
        $shop = Shop::factory()->create(['owner_id' => $barber->id]);
        $route = $this->route('index', ['shop' => $shop->id]);

        $response = $this->withAcceptJSONHeader()->actingAs($barber, 'barber')->get($route);

        $response->assertStatus(200);
    }

    public function test_data()
    {
        $barber = Barber::factory()->create();
        $shop = Shop::factory()->create(['owner_id' => $barber->id]);
        $route = $this->route('index', ['shop' => $shop->id]);
        $apply = Apply::factory()->create(['shop_id' => $shop->id]);

        $response = $this->withAcceptJSONHeader()->actingAs($barber, 'barber')->get($route)->json();

        $this->assertJson(json_encode($response['data'][0]), json_encode($apply));
    }

    public function test_structure()
    {
        $barber = Barber::factory()->create();
        $shop = Shop::factory()->create(['owner_id' => $barber->id]);

        $response = $this->actingAs($barber, 'barber')->get($this->route('index', ['shop' => $shop->id]));

        $response->assertJsonStructure();
    }
}
