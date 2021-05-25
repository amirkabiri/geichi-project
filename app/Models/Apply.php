<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apply extends Model
{
    use HasFactory;

    protected $casts = [
        'barber_id' => 'integer',
        'shop_id' => 'integer',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
    ];

    protected $fillable = ['barber_id', 'shop_id', 'description', 'status'];

    public function shop(){
        return $this->belongsTo(Shop::class, 'shop_id', 'id');
    }

    public function barber(){
        return $this->belongsTo(Barber::class, 'barber_id', 'id');
    }
}
