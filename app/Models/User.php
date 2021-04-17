<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['first_name', 'last_name', 'phone'];
    protected $hidden = ['api_token', 'login_code'];

    public function setPhoneAttribute($phone){
        $this->attributes['phone'] = normalizePhone($phone);
    }

    public function generateApiToken(): string
    {
        do{
            $token = generateApiToken();
            $count = self::where('api_token', $token)->count();
        }while($count > 0);

        $this->api_token = $token;

        return $token;
    }
}
