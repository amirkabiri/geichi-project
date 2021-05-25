<?php

use Carbon\Carbon;

function toCarbon($input): Carbon
{
    if($input instanceof Carbon) return $input;

    return Carbon::createFromTimestamp($input);
}
