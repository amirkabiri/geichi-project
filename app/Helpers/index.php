<?php

$files = scandir(__DIR__);
foreach (array_diff($files, ['.', '..', 'index.php']) as $file){
    include_once $file;
}






