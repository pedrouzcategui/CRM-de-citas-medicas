<?php

require_once '../medicos/entity.php';

require_once '../utils.php';
require_once '../csv_functions.php';

$row_number = uniqid();
$name = trim($_POST['name']);
$specialty = trim($_POST['specialty']);

$availability = get_days_as_string_from_days_array($_POST['availabilty']);
$shift = SHIFTS[$_POST['shift']];
$appointments_per_day = trim($_POST['appointments_per_day']);

$doctor_fields = array($row_number, $name, $specialty, $shift, $availability, $appointments_per_day);
$doctor = create_doctor($doctor_fields);

echo "Doctor created\n";
echo "<a href='/crmmedico/medicos/index.php'>Volver a medicos</a>";
