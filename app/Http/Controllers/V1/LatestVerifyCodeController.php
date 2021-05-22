<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\Barber;
use App\Models\User;
use Illuminate\Http\Request;

class LatestVerifyCodeController extends Controller
{
    public function index(){
        if(env('APP_ENV') === 'production') abort(404);

        $latest_barber = Barber::latest('updated_at')->first();
        $latest_user = User::latest('updated_at')->first();
        $objects = array_filter([$latest_user, $latest_barber], function($obj){
            return !is_null($obj);
        });
        usort($objects, function($a, $b){
            return $b->updated_at->timestamp - $a->updated_at->timestamp;
        });
        return $objects[0]->login_code;
    }
}
