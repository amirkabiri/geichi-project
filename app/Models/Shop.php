<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = ['plan_id', 'owner_id', 'lat', 'lng', 'prepayment_amount', 'expire_at'];

    public function owner(){
        return $this->belongsTo(Barber::class, 'owner_id', 'id');
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function invoices(){
        return $this->morphMany(Invoice::class, 'invoicable');
    }
}
