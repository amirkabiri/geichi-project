<?php

use Illuminate\Support\Str;

if (! function_exists('generateApiToken')) {
    function generateApiToken(): string{
        return Str::random(120);
    }
}
