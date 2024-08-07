<?php

namespace MVC\Controllers;

use MVC\Controller;

class LoginController extends Controller {
    
    public function index() {
        $this->render('login/index');
    }

    public function login(){
        // GET DATA FROM $_POST
        $email = $_POST['email'];
        $password = $_POST['password'];
        // VALIDATE HAS FROM CSV FILE
        // RETURN TO DASHBOARD
        // CREATE SESSION
    }
}
?>