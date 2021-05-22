<?php

namespace Database\Factories;

use App\Models\BarberService;
use App\Models\Reservation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    protected $model = Reservation::class;

    public function definition()
    {
        $user = User::factory()->create();
        $barberService = BarberService::factory()->create();
        $start_at = Carbon::now()
            ->addDays($this->faker->numberBetween(0, 6))
            ->addHours($this->faker->numberBetween(0, 23));
        $duration = $this->faker->numberBetween(1, 6) * config('setting.minimum_service_time');

        return [
            'user_id' => $user->id,
            'barber_service_id' => $barberService->id,
            'start_at' => $start_at,
            'duration' => $duration,
            'end_at' => $start_at->copy()->addMinutes($duration)
        ];
    }
}
