<?php

if(! function_exists('classPathToName') ){
    function classPathToName($path){
        return last(explode('\\', $path));
    }
}
