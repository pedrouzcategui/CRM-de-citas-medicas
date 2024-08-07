<?php

namespace MVC\Controllers;

use MVC\Controller;
use MVC\Models\User;

class UserController extends Controller {
    public function index() {
        $this->render('user/index',['users' => 'These are some users'],'Dashboard');
    }
}
?>