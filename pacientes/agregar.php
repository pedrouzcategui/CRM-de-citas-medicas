<?php

require_once '../utils.php';
require_once '../csv_functions.php';

$name = trim($_POST['name']);
$email = trim($_POST['email']);
$birthday = trim($_POST['birthday']);
$gender = trim($_POST['gender']);
$row_number = uniqid();

$fields = array($row_number, $name, $email, $gender, $birthday);

add_row_to_csv(PATIENTS_CSV_FILE, $fields, PATIENT_OBJECT_KEYS);

echo "Patient created\n";
echo "<a href='/crmmedico/pacientes/index.php'>Volver a pacientes</a>";
die();
