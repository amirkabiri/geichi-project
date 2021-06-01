<?php

namespace App\Models;

use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class BarberService extends Pivot
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['barber_id', 'service_id'];
    protected $casts = [
        'barber_id' => 'integer',
        'service_id' => 'integer',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
    ];
    public $incrementing = true;

    public function isTimeFree(Carbon $start_at, $durationOrEndAt) {
        if($durationOrEndAt instanceof Carbon){
            $end_at = $durationOrEndAt;
        }else if(is_int($durationOrEndAt)){
            $end_at = $start_at->copy()->addMinutes($durationOrEndAt);
        }else{
            throw new Exception('second argument must be instance of Carbon or integer');
        }

        $reservation = Reservation::where('barber_service_id', $this->id)
            ->where(function($q) use ($start_at, $end_at) {
                return $q
                    ->where('start_at', '<', $start_at)->where('end_at', '>', $start_at)
                    ->orWhere('start_at', '<', $end_at)->where('end_at', '>', $end_at)
                    ->orWhere('start_at', '>', $start_at)->where('start_at', '<', $end_at)
                    ->orWhere('end_at', '>', $start_at)->where('end_at', '<', $end_at)
                    ->orWhere('start_at', $start_at)->where('end_at', $end_at);
            })
            ->first();
        return !$reservation;
    }

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
