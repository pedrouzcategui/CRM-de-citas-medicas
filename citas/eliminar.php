<?php

require_once '../utils.php';
require_once '../csv_functions.php';

$id = get_param_from_url('id');

$appointment = find_record_by(APPOINTMENTS_CSV_FILE, 'id', $id, APPOINTMENT_OBJECT_KEYS);
$diagnostic = find_record_by(DIAGNOSTICS_CSV_FILE, 'id', $appointment['diagnosticID'], DIAGNOSTIC_OBJECT_KEYS);
delete_row_from_csv(DIAGNOSTICS_CSV_FILE, 'id', $appointment['diagnosticID'], DIAGNOSTIC_OBJECT_KEYS);
delete_row_from_csv(APPOINTMENTS_CSV_FILE, 'id', $id, APPOINTMENT_OBJECT_KEYS);
echo "Record Deleted";
echo "<a href='/crmmedico/citas/index.php'>Volver a citas</a>";
return;
