<?php

namespace MVC\Controllers;

use MVC\Controller;

class CalendarController extends Controller {
    public function index() {
        $this->render('calendar/index', ['data' => 'Some Data']);
    }
}
?>