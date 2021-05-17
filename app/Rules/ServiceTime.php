<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ServiceTime implements Rule
{
    public function __construct()
    {
        //
    }

    // todo implement ServiceTime rule
    public function passes($attribute, $value)
    {
        return true;
    }

    public function message()
    {
        return 'The validation error message.';
    }
}
