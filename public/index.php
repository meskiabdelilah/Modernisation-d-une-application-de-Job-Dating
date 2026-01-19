<?php
require_once __DIR__ . '/../vendor/autoload.php';
// require_once './config/config.php';
use App\core\Router;
use App\controllers\front\UserController;
// use App\core\Model;

// Create router instance
$router = Router::getRouter();
// Register the routes
$router->get('/user/{user}/product/{product}',[UserController::class,'Show']);
$router->get('/test',[UserController::class,'test']);

// Dispatch the router
$router->dispatch();
// $userModel = new App\models\User();

// $user = $userModel->all();
//   
