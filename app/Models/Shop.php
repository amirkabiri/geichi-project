<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $casts = [
        'owner_id' => 'integer',
        'plan_id' => 'integer'
    ];
    protected $fillable = ['plan_id', 'owner_id', 'lat', 'lng', 'prepayment_amount', 'expire_at'];

    public function services(){
        return $this->hasMany(Service::class);
    }

    public function owner(){
        return $this->belongsTo(Barber::class, 'owner_id', 'id');
    }

    public function applies(){
        return $this->hasMany(Apply::class, 'shop_id', 'id');
    }

    public function barbers(){
        return $this->hasMany(Barber::class, 'shop_id', 'id');
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function invoices(){
        return $this->morphMany(Invoice::class, 'invoicable');
    }
}
