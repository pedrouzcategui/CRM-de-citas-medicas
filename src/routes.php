<?php

use MVC\Router;
use MVC\Controllers\LoginController;
use MVC\Controllers\DashboardController;
use MVC\Controllers\CalendarController;

$router = new Router();

// Login/Sign Up Routes
$router->get('/', LoginController::class, 'index');
$router->post('/login', LoginController::class, 'login');

// Dashboard
$router->get('/dash', DashboardController::class, 'index');

// Patients
# GET /patients
# GET /patients/:patientID
# GET /patients/add
# POST /patients/
# GET /patients/edit/patient:ID
# PUT /patients/patient:ID
# DELETE /patients/patient:ID

// Doctors
# GET /patients
# GET /patients/:patientID
# GET /patients/add
# POST /patients/
# GET /patients/edit/patient:ID
# PUT /patients/patient:ID
# DELETE /patients/patient:ID

// Appointments
$router->get('/appointments', CalendarController::class, 'index');
# GET /appointments/
# GET /appointments/:appointmentID
# GET /appointments/add
# POST /appointments/
# GET /appointments/edit/appointment:ID
# PUT /appointments/appointment:ID
# DELETE /appointments/appointment:ID

?>