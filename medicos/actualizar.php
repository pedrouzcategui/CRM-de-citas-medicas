<?php

require_once '../utils.php';
require_once '../csv_functions.php';


$id = $_GET['id'];

$name = trim($_POST['name']);
$specialty = trim($_POST['specialty']);
$availability = get_days_as_string_from_days_array($_POST['availabilty']);
$shift = SHIFTS[$_POST['shift']];
$appointments_per_day = trim($_POST['appointments_per_day']);

$doctor = [$id, $name, $specialty, $shift, $availability, $appointments_per_day];

edit_row_from_csv(DOCTORS_CSV_FILE, 'id', $id, $doctor, DOCTOR_OBJECT_KEYS);
echo "Record with Doctor ID: $id - has been updated\n";
echo "<a href='index.php'>Volver a doctores</a>";
