<?php

namespace app\libraries;

class Model
{
    public static $db;

    public function __construct()
    {
        if (static::$db == null) {
            static::$db = new Database;
        }
    }
}