<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class BarberService extends Pivot
{
    use HasFactory;

    protected $fillable = ['barber_id', 'service_id'];
    public $incrementing = true;

    public function barber(){
        return $this->belongsTo(Barber::class);
    }

    public function service(){
        return $this->belongsTo(Service::class);
    }

    public function reservations(){
        return $this->hasMany(Reservation::class, 'barber_service_id', 'id');
    }
}
