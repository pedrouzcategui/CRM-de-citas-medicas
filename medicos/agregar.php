<?php

require_once '../utils.php';
require_once '../csv_functions.php';

$name = trim($_POST['name']);
$specialty = trim($_POST['specialty']);
// $password = sanitize_input($_POST['password']);
// $password = hash("sha256", $password);

$availability = get_days_as_string_from_days_array($_POST['availabilty']);
$shift = SHIFTS[$_POST['shift']];
$appointments_per_day = trim($_POST['appointments_per_day']);
$row_number = uniqid();

$doctor_fields = array($row_number, $name, $specialty, $shift, $availability, $appointments_per_day);
// $user_fields = array($row_number, $name, $email, $password, 'doctor');

add_row_to_csv(DOCTORS_CSV_FILE, $doctor_fields, DOCTOR_OBJECT_KEYS);
// add_row_to_csv(USERS_CSV_FILE, $user_fields, USER_OBJECT_KEYS);

echo "Doctor created\n";
echo "<a href='/crmmedico/medicos/index.php'>Volver a medicos</a>";
