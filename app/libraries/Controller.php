<?php

namespace app\libraries;
use app\helpers\Session;

//Load the model and the view
class Controller
{
    public $session;
    public function __construct()
    {
        $this->session = new Session();
    }
    public function layout($path, $data, $session) {
        require '../app/views/layouts/layout.php';
    }

    //Load the view (checks for the file)
    public function view($view, $data = [])
    {
//        extract($data);
        if (file_exists('../app/views/' . $view . '.php')) {
//            require_once '../app/views/' . $view . '.php';

            $this->layout($view, $data, $this->session);
        } else {
            die("View does not exists.");
        }
    }

}