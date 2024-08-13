<?php

require_once '../utils.php';
require_once '../csv_functions.php';

$id = get_param_from_url('id');

delete_row_from_csv(PATIENTS_CSV_FILE, 'id', $id, PATIENT_OBJECT_KEYS);
echo "Records Updated";
echo "<a href='/crmmedico/pacientes/index.php'>Volver a pacientes</a>";
