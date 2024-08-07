<?php

namespace MVC\Controllers;

use MVC\Controller;

class LoginController extends Controller {
    public function index() {
        $this->render('login/index', ['data' => 'Some Data']);
    }
}
?>