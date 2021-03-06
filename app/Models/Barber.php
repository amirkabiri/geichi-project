<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Barber extends Authenticatable
{
    use HasFactory;

    protected $fillable = ['shop_id', 'phone', 'first_name', 'last_name', 'avatar', 'start_time', 'end_time'];
    protected $hidden = ['api_token', 'login_code'];
    protected $casts = [
        'shop_id' => 'integer',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
    ];

    public function getFullNameAttribute(){
        return $this->first_name . ' ' . $this->last_name;
    }

    public function isEmployed(){
        return !$this->isUnemployed();
    }

    public function isUnemployed(){
        return is_null($this->shop_id) && is_null(Shop::where('owner_id', $this->id)->first());
    }

    public function isOwnerOfShop(Shop $shop){
        return $this->id === $shop->owner_id;
    }

    public function barberServices(){
        return $this->hasMany(BarberService::class);
    }

    public function services(){
        return $this->belongsToMany(Service::class)
            ->withTimestamps()
            ->withPivot('id')
            ->using(BarberService::class);
    }

    public function applies(){
        return $this->hasMany(Apply::class, 'barber_id', 'id');
    }

    public function ownings(){
        return $this->hasMany(Shop::class, 'owner_id', 'id');
    }

    public function shop(){
        return $this->belongsTo(Shop::class, 'shop_id', 'id');
    }

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
