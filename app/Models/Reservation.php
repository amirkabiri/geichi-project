<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'barber_service_id', 'start_at', 'end_at', 'duration'];
    protected $casts = [
        'user_id' => 'integer',
        'barber_service_id' => 'integer',
        'duration' => 'integer',
        'start_at' => 'timestamp',
        'end_at' => 'timestamp',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function barberService(){
        return $this->belongsTo(BarberService::class, 'barber_service_id', 'id');
    }
}
