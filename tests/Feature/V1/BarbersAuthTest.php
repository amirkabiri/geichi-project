<?php

namespace Tests\Feature\V1;

use App\Models\Barber;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BarbersAuthTest extends TestCase
{
    use RefreshDatabase;

    public $route_name_prefix = 'api.v1.barbers.auth.';

    public function test_request__status_is_200()
    {
        $barber = Barber::factory()->make();

        $this->withAcceptJSONHeader()
            ->post($this->route('request'), ['phone' => $barber->phone])
            ->assertStatus(200);
    }

    public function test_user__inserted_in_db()
    {
        $barber = Barber::factory()->make();

        $this->withAcceptJSONHeader()
            ->post($this->route('request'), ['phone' => $barber->phone]);

        $this->assertTrue(!!Barber::where('phone', $barber->phone)->first());
    }

    public function test_request__user_login_code_updated()
    {
        $barber = Barber::factory()->create();

        $this->withAcceptJSONHeader()
            ->post($this->route('request'), ['phone' => $barber->phone]);

        $barber->refresh();

        $this->assertFalse(is_null($barber->login_code));
    }

    public function test_request__phone_is_required(){
        $response = $this->withAcceptJSONHeader()
            ->post($this->route('request'));

        $response->assertStatus(422);
    }

    public function test_verify__phone_is_required(){
        $this->withAcceptJSONHeader()
            ->post($this->route('verify'), ['code' => '3231'])
            ->assertStatus(422)
            ->assertJsonStructure([
                'errors' => ['phone']
            ]);
    }

    public function test_verify__code_is_required(){
        $this->withAcceptJSONHeader()
            ->post($this->route('verify'), ['phone' => generateFakePhone()])
            ->assertStatus(422)
            ->assertJsonStructure([
                'errors' => ['code']
            ]);
    }

    public function test_verify__send_phone_which_does_not_exists(){
        $this->withAcceptJSONHeader()
            ->post($this->route('verify'), ['phone' => generateFakePhone(), 'code' => '4324'])
            ->assertStatus(422)
            ->assertJsonStructure([
                'errors' => ['phone']
            ]);
    }

    public function test_verify__send_invalid_code(){
        $barber = Barber::factory()->create();

        $this->withAcceptJSONHeader()
            ->post($this->route('verify'), ['phone' => $barber->phone, 'code' => 'invalid'])
            ->assertStatus(422)
            ->assertJsonStructure([
                'errors' => ['code']
            ]);
    }

    public function test_verify__success_status_is_200(){
        $login_code = rand(1000, 9999);
        $barber = Barber::factory()->create(compact('login_code'));

        $this->withAcceptJSONHeader()
            ->post($this->route('verify'), ['phone' => $barber->phone, 'code' => $login_code])
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => ['token']
            ]);
    }

    public function test_verify__token_is_valid(){
        $login_code = rand(1000, 9999);
        $barber = Barber::factory()->create(compact('login_code'));

        $res = $this->withAcceptJSONHeader()
            ->post($this->route('verify'), ['phone' => $barber->phone, 'code' => $login_code]);

        $token = $res->json()['data']['token'];
        $barber->refresh();

        $this->assertEquals($barber->api_token, $token);
    }
}
