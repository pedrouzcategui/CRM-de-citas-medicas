<?php

require_once '../citas/entity.php';

require_once '../utils.php';
require_once '../middleware.php';
require_once '../csv_functions.php';

$appointment_id = get_param_from_url('id');
$appointment = find_appointment($appointment_id);

if (has_appointment_datetime_already_passed($appointment)) {
    redirect_to('/citas?error=date_already_passed');
}

$diagnosticID = $_POST['diagnosticID'];
$patientID = $_POST['patientID'];
$doctorID = $_POST['doctorID'];
$date = $_POST['date'];
$time = $_POST['time'];
$status = $_POST['status'];

$appointment_fields = [$appointment_id, $patientID, $doctorID, $date, $time, $status, $diagnosticID];
$updated_appointment = update_appointment($appointment_id, $appointment_fields);


echo "Record with Appointment ID: $appointment_id - has been updated\n";
echo "<a href='index.php'>Volver a citas</a>";
