<?php

namespace App\Http\Controllers\V1\Users;

use App\Http\Controllers\Controller;
use App\Http\Controllers\V1\Auth;
use App\Models\User;
use App\Rules\IranMobile;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private Auth $auth;

    public function __construct(){
        $this->auth = new Auth(new User);

        $this->middleware('normalize.phone');
    }

    public function request(Request $request){
        $request->validate([
            'phone' => ['required', new IranMobile]
        ]);

        $this->auth->request($request->phone);
    }

    public function verify(Request $request){
        $request->validate([
            'phone' => ['required', 'exists:users,phone', new IranMobile],
            'code' => 'required'
        ]);

        $token = $this->auth->verify($request->phone, $request->code);

        if(is_null($token)){
            return response(['errors' => ['code' => ['invalid code']]])->setStatusCode(422);
        }

        return ['data' => compact('token')];
    }
}
