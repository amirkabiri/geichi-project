<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['shop_id', 'sender_id', 'sender_type', 'message', 'score', 'parent'];

    public function shop(){
        return $this->belongsTo(Shop::class);
    }

    public function sender(){
        return $this->morphTo();
    }

//    public function user(){
//        return $this->hasOne()
//    }
}
