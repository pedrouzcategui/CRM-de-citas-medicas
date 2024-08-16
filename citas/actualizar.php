<?php

require_once '../utils.php';
require_once '../middleware.php';
require_once '../csv_functions.php';

$appointment_id = get_param_from_url('id');
$appointment = find_record_by(APPOINTMENTS_CSV_FILE, 'id', $appointment_id, APPOINTMENT_OBJECT_KEYS);

$date = get_date_in_assoc_format($appointment["date"]);
$time = get_time_in_assoc_format($appointment["time"]);
$date_already_passed = has_date_passed($date, $time);

if ($date_already_passed) {
    redirect_to('/citas?error=date_already_passed');
}

$diagnosticID = $_POST['diagnosticID'];
$patientID = $_POST['patientID'];
$doctorID = $_POST['doctorID'];
$date = $_POST['date'];
$time = $_POST['time'];
$status = $_POST['status'];

$appointment_fields = [$appointment_id, $patientID, $doctorID, $date, $time, $status, $diagnosticID];

$updated_appointment = edit_row_from_csv(APPOINTMENTS_CSV_FILE, 'id', $appointment_id, $appointment_fields, APPOINTMENT_OBJECT_KEYS);

echo "Record with Appointment ID: $appointment_id - has been updated\n";
echo "<a href='index.php'>Volver a citas</a>";
