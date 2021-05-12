<?php

if(! function_exists('currentGuard') ){
    function currentGuard(){
        $guards = array_keys(config('auth.guards'));
        return collect($guards)->first(function($guard){
            try{
                return auth()->guard($guard)->check();
            }catch (Exception $exception){
                return false;
            }
        });
    }
}
