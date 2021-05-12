<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barber extends Model
{
    use HasFactory;

    protected $fillable = ['phone', 'first_name', 'last_name', 'avatar', 'start_time', 'end_time'];
    protected $hidden = ['api_token', 'login_code'];

    public function comments(){
        return $this->morphMany(Comment::class, 'sender');
    }

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
