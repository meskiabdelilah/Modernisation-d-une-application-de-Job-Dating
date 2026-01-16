<?php

namespace App\core;

use App\core\Router;

abstract class Controller
{
    protected function render($view, $data = [])
    {
        extract($data);
        $path =__DIR__ . '/../views/' . $view . '.php';

        if (file_exists($path)) {
            require_once $path;
        }else{
            die('View ' . $view . 'not found' . $path);
        }
    }
}
