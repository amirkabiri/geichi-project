<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['shop_id', 'title', 'price', 'time'];
    protected $casts = [
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
        'shop_id' => 'integer',
        'time' => 'integer',
    ];

    public function barbers(){
        return $this->belongsToMany(Barber::class)
            ->withTimestamps()
            ->withPivot('id')
            ->using(BarberService::class);
    }

    public function barberServices(){
        return $this->hasMany(BarberService::class);
    }

    public function shop(){
        return $this->belongsTo(Shop::class);
    }
}
