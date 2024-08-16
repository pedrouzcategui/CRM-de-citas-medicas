<?php

require_once '../utils.php';
require_once '../middleware.php';
require_once '../csv_functions.php';

$id = get_param_from_url('id');

// Check if doctor already have showed patients
/**
 * SELECT doctorId FROM citas
 * WHERE status = 'showed'
 * 
 * if ID is not in $filtered_patients -> delete()
 * 
 */

$appointments = get_csv_as_array(APPOINTMENTS_CSV_FILE, APPOINTMENT_OBJECT_KEYS);
$showed_appointments = get_records_where($appointments, 'status', 'showed');
$has_doctor_showed_patients = does_value_exist_in_array($showed_appointments, 'doctorID', $id);

if ($has_doctor_showed_patients) {
    redirect_to('/medicos?error=doctor_already_attended_patients');
}

// delete_row_from_csv(DOCTORS_CSV_FILE, 'id', $id, DOCTOR_OBJECT_KEYS);
echo "Records Updated";
echo "<a href='/crmmedico/medicos/index.php'>Volver a medicos</a>";
