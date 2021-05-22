<?php

function strToCarbon($str){
    try{
//        \Carbon\Carbon::createFromTimestamp();
        return \Morilog\Jalali\Jalalian::fromFormat('Y-m-d H:i:s', $str);
        return new \Illuminate\Support\Carbon($str);
    }catch (Exception $exception){
        return $exception;
    }
}
