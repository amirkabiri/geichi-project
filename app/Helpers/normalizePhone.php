<?php

if (! function_exists('normalizePhone')) {
    function normalizePhone(string $phone): string{
        if(substr($phone, 0, 3) === '+98'){
            return $phone;
        }
        if(substr($phone, 0, 2) === '98'){
            return '+' . $phone;
        }
        if(substr($phone, 0, 2) === '09'){
            return '+98' . substr($phone, 1);
        }
        if(substr($phone, 0, 1) === '9'){
            return '+98' . substr($phone, 0);
        }
        return $phone;
    }
}
