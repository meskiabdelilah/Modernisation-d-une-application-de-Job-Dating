<?php

namespace App\controllers\front;

use App\core\Controller;

class UserController extends Controller
{
    public function Show($user, $product)
    {
        $this->render('test', [
            'user' => $user,
            'product' => $product
        ]);
    }
    public function test()
    {
        $this->twigView('auth/login');
    }
}
