<?php
// Recibir Datos
require_once "../utils.php";
require_once "../csv_functions.php";

$appointmentID = uniqid();
$diagnosticID = uniqid();
$patientID = $_POST['patientID'];
$doctorID = $_POST['doctorID'];
$date = $_POST['date'];
$time = $_POST['time'];
$status = 'confirmed';

$appointment_fields = [$appointmentID, $patientID, $doctorID, $date, $time, $status, $diagnosticID];
$diagnostic_fields = [$diagnosticID, $appointmentID, $patientID, $doctorID, " "];
add_row_to_csv(APPOINTMENTS_CSV_FILE, $appointment_fields, APPOINTMENT_OBJECT_KEYS);
add_row_to_csv(DIAGNOSTICS_CSV_FILE, $diagnostic_fields, DIAGNOSTIC_OBJECT_KEYS);

echo "Appointment Created\n";
echo "<a href='/crmmedico/citas/index.php'>Volver a citas</a>";
