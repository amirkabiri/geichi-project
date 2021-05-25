<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['shop_id', 'sender_id', 'sender_type', 'message', 'score', 'parent'];
    protected $casts = [
        'shop_id' => 'integer',
        'sender_id' => 'integer',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
        'score' => 'integer',
    ];

    public function shop(){
        return $this->belongsTo(Shop::class);
    }

    public function sender(){
        return $this->morphTo();
    }
}
