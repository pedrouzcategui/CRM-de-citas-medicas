<?php

require_once '../utils.php';
require_once '../middleware.php';
require_once '../csv_functions.php';

$id = get_param_from_url('id');

$appointment = find_record_by(APPOINTMENTS_CSV_FILE, 'id', $id, APPOINTMENT_OBJECT_KEYS);
$diagnostic = find_record_by(DIAGNOSTICS_CSV_FILE, 'id', $appointment['diagnosticID'], DIAGNOSTIC_OBJECT_KEYS);
$date = get_date_in_assoc_format($appointment["date"]);
$time = get_time_in_assoc_format($appointment["time"]);
$date_already_passed = has_date_passed($date, $time);

if ($date_already_passed) {
    redirect_to('/citas?error=date_already_passed');
}

delete_row_from_csv(DIAGNOSTICS_CSV_FILE, 'id', $appointment['diagnosticID'], DIAGNOSTIC_OBJECT_KEYS);
delete_row_from_csv(APPOINTMENTS_CSV_FILE, 'id', $id, APPOINTMENT_OBJECT_KEYS);

echo "Record Deleted";
echo "<a href='/crmmedico/citas/index.php'>Volver a citas</a>";

die();
