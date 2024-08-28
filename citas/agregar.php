<?php

// Entidades
require_once "../citas/entity.php";
require_once "../diagnosticos/entity.php";

// Utilidades
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

if (!is_doctor_available_for_another_appointment_on_this_date($doctorID, $date, $time)) {
    dd('This slot is not available');
}

$appointment = create_appointment($appointment_fields);
$diagnostic = create_diagnostic($diagnostic_fields);

echo "Appointment Created\n";
echo "<a href='/crmmedico/citas/index.php'>Volver a citas</a>";
