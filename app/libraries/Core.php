<?php

namespace app\libraries;
/*
 * App Core Class
 * Creates URL & loads core controller
 * URL FORMAT - /controller/method/params
 */

class Core
{
    protected $currentController = 'app\controllers\Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    protected $controllerNamespace = 'app\controllers\\';

    public function __construct()
    {
        $url = $this->getUrl();

        // Look in BLL for first value
        if (class_exists($this->controllerNamespace.ucwords($url[0]))) {
            // If exists, set as controller
            $this->currentController = $this->controllerNamespace.ucwords($url[0]);
            // Unset 0 Index
            unset($url[0]);
        }


        // Instantiate controller class
        $this->currentController = new $this->currentController;

        // Check for second part of url
        if (isset($url[1])) {
            // Check to see if method exists in controller
            if (method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];
                // Unset 1 index
                unset($url[1]);
            }
        }

        // Get params
        $this->params = $url ? array_values($url) : [];

        // Call a callback with array of params
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    public function getUrl()
    {
        $path = explode('?', $_SERVER['REQUEST_URI'])[0];
        $path = ltrim($path, '/');
        return explode('/', $path);
    }
}