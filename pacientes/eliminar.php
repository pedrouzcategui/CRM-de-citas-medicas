<?php

require_once '../pacientes/entity.php';

require_once '../utils.php';
require_once '../middleware.php';
require_once '../csv_functions.php';

$patient_id = get_param_from_url('id');
$is_patient_deleted = delete_patient($patient_id);

echo "Records Updated";
echo "<a href='/crmmedico/pacientes/index.php'>Volver a pacientes</a>";
