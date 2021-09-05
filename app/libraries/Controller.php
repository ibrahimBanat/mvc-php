<?php

namespace app\libraries;

//Load the model and the view
class Controller
{
    public function __construct()
    {

    }


    //Load the view (checks for the file)
    public function view($view, $data = [])
    {
        extract($data);
        if (file_exists('../app/views/' . $view . '.php')) {
            require_once '../app/views/' . $view . '.php';
        } else {
            die("View does not exists.");
        }
    }

}