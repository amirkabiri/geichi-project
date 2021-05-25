<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Carbon;

class TimestampLessThan implements Rule
{
    private Carbon $base;

    public function __construct(Carbon $base)
    {
        $this->base = $base;
    }

    public function passes($attribute, $value)
    {
        return isTimestamp($value) && toCarbon($value)->lessThan($this->base);
    }

    public function message()
    {
        return 'The timestamp must be less than a threshold';
    }
}
