<?php

namespace Tests\Feature\V1;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UsersAuthTest extends TestCase
{
    use RefreshDatabase;

    public $route_name_prefix = 'api.v1.users.auth.';

    public function test_request__status_is_200()
    {
        $user = User::factory()->make();

        $this->withAcceptJSONHeader()
            ->post($this->route('request'), ['phone' => $user->phone])
            ->assertStatus(200);
    }

    public function test_user__inserted_in_db()
    {
        $user = User::factory()->make();

        $this->withAcceptJSONHeader()
            ->post($this->route('request'), ['phone' => $user->phone]);

        $this->assertTrue(!!User::where('phone', $user->phone)->first());
    }

    public function test_request__user_login_code_updated()
    {
        $user = User::factory()->create();

        $this->withAcceptJSONHeader()
            ->post($this->route('request'), ['phone' => $user->phone]);

        $user->refresh();

        $this->assertFalse(is_null($user->login_code));
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
        $user = User::factory()->create();

        $this->withAcceptJSONHeader()
            ->post($this->route('verify'), ['phone' => $user->phone, 'code' => 'invalid'])
            ->assertStatus(422)
            ->assertJsonStructure([
                'errors' => ['code']
            ]);
    }

    public function test_verify__success_status_is_200(){
        $login_code = rand(1000, 9999);
        $user = User::factory()->create(compact('login_code'));

        $this->withAcceptJSONHeader()
            ->post($this->route('verify'), ['phone' => $user->phone, 'code' => $login_code])
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => ['token']
            ]);
    }

    public function test_verify__token_is_valid(){
        $login_code = rand(1000, 9999);
        $user = User::factory()->create(compact('login_code'));

        $res = $this->withAcceptJSONHeader()
            ->post($this->route('verify'), ['phone' => $user->phone, 'code' => $login_code]);

        $token = $res->json()['data']['token'];
        $user->refresh();

        $this->assertEquals($user->api_token, $token);
    }
}
