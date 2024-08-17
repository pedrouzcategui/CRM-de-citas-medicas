<?php
require_once '../utils.php';
require_once '../middleware.php';
require_once '../csv_functions.php';

function get_patients(): array
{
    return get_csv_as_array(PATIENTS_CSV_FILE, PATIENT_OBJECT_KEYS);
}

function find_patient(string $patient_id): array
{
    $patient = find_record_by(PATIENTS_CSV_FILE, 'id', $patient_id, PATIENT_OBJECT_KEYS);
    if (!$patient) throw new Exception("No patient with ID: $patient_id was found");
    return $patient;
}

function create_patient(array $patient_fields): array
{
    $patient = add_row_to_csv(PATIENTS_CSV_FILE, $patient_fields, PATIENT_OBJECT_KEYS);
    return $patient;
}

function update_patient(string $patient_id, array $new_patient_fields): array
{
    $patient = find_patient($patient_id);
    $udpated_patient = edit_row_from_csv(PATIENTS_CSV_FILE, 'id', $patient['id'], $new_patient_fields, PATIENT_OBJECT_KEYS);
    return $udpated_patient;
}

function delete_patient(string $patient_id): bool
{
    $appointments = get_csv_as_array(APPOINTMENTS_CSV_FILE, APPOINTMENT_OBJECT_KEYS);
    $showed_appointments = get_records_where($appointments, 'status', 'showed');
    $patient = find_patient($patient_id);
    $has_patient_shown_to_any_appointments = does_value_exist_in_array($showed_appointments, 'patientID', $patient['id']);

    if ($has_patient_shown_to_any_appointments) {
        throw new Exception("Patient already showed to appointments");
    }

    return delete_row_from_csv(PATIENTS_CSV_FILE, 'id', $patient['id'], PATIENT_OBJECT_KEYS);
}
