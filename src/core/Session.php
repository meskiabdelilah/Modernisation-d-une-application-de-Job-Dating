<?php

namespace App\core;
class Session {

    public function __construct () 
    {
    // Démarrage de la session
        if(session_status() === PHP_SESSION_NONE)
        {
        ini_set('session.gc_maxlifetime', 1800);
        session_set_cookie_params(1800);

        session_start();
        }

        if (!isset($_SESSION['initiated'])) {
        session_regenerate_id(true);
        $_SESSION['initiated'] = true;
        }
    }

    // method for get a session value by key 
    public function get ($key, $default = null)
    {
        return $_SESSION[$key] ?? $default;
    }

    // method for set a session value by key
    public function set ($key, $value)
    {
        $_session[$key] = $value;
    }

    // method for remove a session value by key
    public function remove ($key)
    {
        unset($_SESSION[$key]);
    }

    // method for logout
    public function destroy() 
    {
        session_destroy();
        $_session = [];
    }
}
