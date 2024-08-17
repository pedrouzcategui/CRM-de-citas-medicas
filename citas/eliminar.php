<?php

require_once '../citas/entity.php';
require_once '../diagnosticos/entity.php';

require_once '../utils.php';
require_once '../middleware.php';
require_once '../csv_functions.php';

$appointment_id = get_param_from_url('id');

$appointment = find_appointment($appointment_id);
$diagnostic_id = $appointment['diagnosticID'];

$diagnostic = find_diagnostic($diagnostic_id);


if (has_appointment_datetime_already_passed($appointment)) {
    redirect_to('/citas?error=date_already_passed');
}

delete_diagnostic($diagnostic_id);
delete_appointment($appointment_id);


echo "Record Deleted";
echo "<a href='/crmmedico/citas/index.php'>Volver a citas</a>";

die();
