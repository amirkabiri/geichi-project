<?php

namespace App\Http\Controllers\V1;

use App\Models\Barber;
use App\Models\User;
use Carbon\Carbon;

class Auth implements AuthInterface
{
    public function __construct(User|Barber $model){
        $this->model = $model;
    }

    public function request(string $phone): string
    {
        $entity = $this->model->where('phone', $phone)->first();
        if(!$entity){
            $entity = $this->model->create(compact('phone'));
        }

        $entity->login_code = rand(1000, 9999);
        $entity->save();

        return (string) $entity->login_code;
    }

    public function verify(string $phone, string $code): string|null
    {
        $entity = $this->model->where('phone', $phone)->first();
        if(is_null($entity) || $entity->login_code !== $code){
            return null;
        }

        if(is_null($entity->registered_at)){
            $entity->registered_at = Carbon::now();
        }
        $entity->login_code = null;
        $token = $entity->generateApiToken();
        $entity->save();

        return $token;
    }

}
