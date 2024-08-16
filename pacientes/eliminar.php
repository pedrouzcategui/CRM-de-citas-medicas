<?php

require_once '../utils.php';
require_once '../middleware.php';
require_once '../csv_functions.php';

$id = get_param_from_url('id');

$appointments = get_csv_as_array(APPOINTMENTS_CSV_FILE, APPOINTMENT_OBJECT_KEYS);
$showed_appointments = get_records_where($appointments, 'status', 'showed');
$has_patient_shown_to_any_appointments = does_value_exist_in_array($showed_appointments, 'patientID', $id);

if ($has_patient_shown_to_any_appointments) {
    redirect_to('/pacientes?error=patient_already_shown_to_appointments');
}

// delete_row_from_csv(PATIENTS_CSV_FILE, 'id', $id, PATIENT_OBJECT_KEYS);
echo "Records Updated";
echo "<a href='/crmmedico/pacientes/index.php'>Volver a pacientes</a>";
