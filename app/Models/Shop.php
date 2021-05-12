<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    public function owner(){
        return $this->belongsTo(Barber::class, 'owner_id', 'id');
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }
}
