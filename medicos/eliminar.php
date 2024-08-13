<?php

require_once '../utils.php';
require_once '../csv_functions.php';

$id = get_param_from_url('id');

delete_row_from_csv(DOCTORS_CSV_FILE, 'id', $id, DOCTOR_OBJECT_KEYS);
echo "Records Updated";
echo "<a href='/crmmedico/medicos/index.php'>Volver a medicos</a>";
