<?php

require 'vendor/autoload.php';
require 'config.php';

include ROOT_DIR."/includes/header.php";

require 'src/routes.php';

$router->dispatch();
?>