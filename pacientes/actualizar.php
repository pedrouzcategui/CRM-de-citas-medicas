<?php

require_once '../pacientes/entity.php';

require_once '../utils.php';
require_once '../csv_functions.php';

$patient_id = get_param_from_url('id');

$name = trim($_POST['name']);
$email = trim($_POST['email']);
$birthday = trim($_POST['birthday']);
$gender = trim($_POST['gender']);

$patient_fields = [$patient_id, $name, $email, $gender, $birthday];

$patient = update_patient($patient_id, $patient_fields);

// edit_row_from_csv(PATIENTS_CSV_FILE, 'id', $id, $patient, PATIENT_OBJECT_KEYS);
echo "Record with Patient ID: $patient_id - has been updated\n";
echo "<a href='index.php'>Volver a pacientes</a>";
