<?php
require_once '../utils.php';
require_once '../middleware.php';
require_once '../csv_functions.php';

function get_doctors(): array
{
    return get_csv_as_array(DOCTORS_CSV_FILE, DOCTOR_OBJECT_KEYS);
}

function find_doctor(string $doctor_id): array
{
    $doctor = find_record_by(DOCTORS_CSV_FILE, 'id', $doctor_id, DOCTOR_OBJECT_KEYS);
    if (!$doctor) throw new Exception("No doctor with ID: $doctor_id was found");
    return $doctor;
}

function create_doctor(array $doctor_fields): array
{
    $doctor = add_row_to_csv(DOCTORS_CSV_FILE, $doctor_fields, DOCTOR_OBJECT_KEYS);
    return $doctor;
}

function update_doctor(string $doctor_id, array $new_doctor_fields): array
{
    $doctor = find_doctor($doctor_id);
    $udpated_doctor = edit_row_from_csv(DOCTORS_CSV_FILE, 'id', $doctor['id'], $new_doctor_fields, DOCTOR_OBJECT_KEYS);
    return $udpated_doctor;
}

function delete_doctor(string $doctor_id): bool
{
    $appointments = get_csv_as_array(APPOINTMENTS_CSV_FILE, APPOINTMENT_OBJECT_KEYS);
    $showed_appointments = get_records_where($appointments, 'status', 'showed');
    $doctor = find_doctor($doctor_id);
    $has_any_doctors_patient_already_shown = does_value_exist_in_array($showed_appointments, 'doctorID', $doctor['id']);

    if ($has_any_doctors_patient_already_shown) {
        throw new Exception("Doctor already has at least a patient that already showed to an appointment");
    }

    return delete_row_from_csv(DOCTORS_CSV_FILE, 'id', $doctor['id'], DOCTOR_OBJECT_KEYS);
}
