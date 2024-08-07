<?php

use MVC\Router;
use MVC\Controllers\UserController;
use MVC\Controllers\LoginController;

$router = new Router();

// Routes
$router->addRoute('/', LoginController::class, 'index');
?>