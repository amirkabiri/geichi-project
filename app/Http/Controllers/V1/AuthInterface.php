<?php

namespace App\Http\Controllers\V1;

interface AuthInterface{

    public function request(string $phone): string;

    public function verify(string $phone, string $code): string|null;

}
