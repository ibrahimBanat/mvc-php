<?php

namespace app\libraries;

class Model
{
    public static $db;



    public function __construct()
    {
        if (self::$db == null) {
            self::$db = new Database;
        }
    }
}