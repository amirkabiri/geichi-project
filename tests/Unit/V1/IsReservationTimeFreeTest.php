<?php

namespace Tests\Unit\V1;

use App\Models\BarberService;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class IsReservationTimeFreeTest extends TestCase
{
    use RefreshDatabase;

    private function testOverlaps(Carbon $start_at, int $duration, Carbon $start_at2, int $duration2, bool $overlap){
        $barberService = BarberService::factory()->create();

        Reservation::factory()->create([
            'barber_service_id' => $barberService->id,
            'start_at' => $start_at,
            'duration' => $duration,
            'end_at' => $start_at->copy()->addMinutes($duration)
        ]);

        $this->assertEquals(!$overlap, $barberService->isTimeFree($start_at2, $duration2));
    }

    public function test_exact_range(){
        $this->testOverlaps(
            Carbon::tomorrow(), 20,
            Carbon::tomorrow(), 20,
            true
        );
    }

    public function test_inner_range(){
        $this->testOverlaps(
            Carbon::tomorrow(), 30,
            Carbon::tomorrow()->addMinutes(10), 15,
            true
        );
    }

    public function test_outer_range(){
        $this->testOverlaps(
            Carbon::tomorrow(), 30,
            Carbon::tomorrow()->subMinutes(10), 100,
            true
        );
    }

    public function test_overlap_db_first(){
        $this->testOverlaps(
            Carbon::tomorrow(), 30,
            Carbon::tomorrow()->addMinutes(10), 100,
            true
        );
    }

    public function test_overlap_query_first(){
        $this->testOverlaps(
            Carbon::tomorrow(), 30,
            Carbon::tomorrow()->subMinutes(10), 30,
            true
        );
    }

    public function test_overlap_start_of_ranges_same(){
        $this->testOverlaps(
            Carbon::tomorrow(), 30,
            Carbon::tomorrow(), 20,
            true
        );
    }

    public function test_overlap_end_of_ranges_same(){
        $this->testOverlaps(
            Carbon::tomorrow()->addMinutes(10), 20,
            Carbon::tomorrow(), 30,
            true
        );
    }

    public function test_ranges_dont_overlap(){
        $this->testOverlaps(
            Carbon::tomorrow()->subMinutes(30), 30,
            Carbon::tomorrow(), 30,
            false
        );

        $this->testOverlaps(
            Carbon::tomorrow()->subMinutes(100), 30,
            Carbon::tomorrow(), 30,
            false
        );
    }
}
