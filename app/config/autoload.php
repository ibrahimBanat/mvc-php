<?php

spl_autoload_register(function ($class) {
    $name = str_replace('\\','/',$class);
    if(file_exists(ROOT.'/'.$name.'.php')){
    require_once (ROOT.'/'.$name.'.php');
    }
});