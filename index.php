<?php

require 'vendor/autoload.php';
require 'config.php';

$uri = $_SERVER['REQUEST_URI'];
include ROOT_DIR."/includes/header.php";

require 'src/routes.php';

$router->dispatch($uri)
?>