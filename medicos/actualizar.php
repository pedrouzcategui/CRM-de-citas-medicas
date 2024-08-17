<?php

require_once '../medicos/entity.php';

require_once '../utils.php';
require_once '../csv_functions.php';


$doctor_id = get_param_from_url('id');

$name = trim($_POST['name']);
$specialty = trim($_POST['specialty']);
$availability = get_days_as_string_from_days_array($_POST['availabilty']);
$shift = SHIFTS[$_POST['shift']];
$appointments_per_day = trim($_POST['appointments_per_day']);

$doctor_fields = [$doctor_id, $name, $specialty, $shift, $availability, $appointments_per_day];

$updated_doctor = update_doctor($doctor_id, $doctor_fields);
// edit_row_from_csv(DOCTORS_CSV_FILE, 'id', $id, $doctor, DOCTOR_OBJECT_KEYS);
echo "Record with Doctor ID: $doctor_id - has been updated\n";
echo "<a href='index.php'>Volver a doctores</a>";
