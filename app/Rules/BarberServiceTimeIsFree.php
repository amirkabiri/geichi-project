<?php

namespace App\Rules;

use App\Models\BarberService;
use Illuminate\Contracts\Validation\Rule;

class BarberServiceTimeIsFree implements Rule
{
    private BarberService $barberService;

    public function __construct(BarberService $barberService)
    {
        $this->barberService = $barberService;
    }

    public function passes($attribute, $value)
    {
        return $this->barberService->isTimeFree(toCarbon($value), $this->barberService->service->time);
    }

    public function message()
    {
        return 'This barber service is not free at this time';
    }
}
