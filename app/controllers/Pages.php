<?php

namespace app\controllers;

use app\libraries\Controller;
use app\models\User;

class Pages extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->userModel = new User();
    }

    public function index()
    {
        $data = [
            'title' => 'Home Page'
        ];
        $this->view('index', $data);
    }

}