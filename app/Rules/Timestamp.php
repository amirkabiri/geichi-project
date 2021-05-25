<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Timestamp implements Rule
{
    public function __construct()
    {
        //
    }

    public function passes($attribute, $value)
    {
        return isTimestamp($value);
    }

    public function message()
    {
        return 'The input must be a valid timestamp.';
    }
}
