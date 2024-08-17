<?php

require_once '../medicos/entity.php';

require_once '../utils.php';
require_once '../middleware.php';
require_once '../csv_functions.php';

$doctor_id = get_param_from_url('id');
$is_doctor_deleted = delete_doctor($doctor_id);

//TODO: Flash exceptions from delete operations if any
// if ($has_doctor_showed_patients) {
//     redirect_to('/medicos?error=doctor_already_attended_patients');
// }

echo "Records Updated";
echo "<a href='/crmmedico/medicos/index.php'>Volver a medicos</a>";
