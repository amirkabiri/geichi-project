<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class IranMobile implements Rule
{
    public function __construct(){

    }

    public function passes($attribute, $value)
    {
        return preg_match('/^(((98)|(\+98)|(0098)|0)(9){1}[0-9]{9})+$/', $value)
            || preg_match('/^(9){1}[0-9]{9}+$/', $value);
    }

    public function message()
    {
        return trans('validation.iran_mobile');
    }
}
