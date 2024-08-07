<?php

require 'vendor/autoload.php';
require 'config.php';

require 'src/routes.php';

/** Dependiendo de la URL, se despacha la acción correspondiente */
$router->dispatch();
