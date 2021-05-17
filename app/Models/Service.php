<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['shop_id', 'title', 'price', 'time'];

    public function barbers(){
        return $this->belongsToMany(Barber::class)->withTimestamps();
    }

    public function shop(){
        return $this->belongsTo(Shop::class);
    }
}
