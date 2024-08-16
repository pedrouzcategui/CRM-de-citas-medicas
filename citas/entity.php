<?php
require_once '../utils.php';
require_once '../middleware.php';
require_once '../csv_functions.php';

function find_appointment(string $appointment_id): array
{
    $appointment = find_record_by(APPOINTMENTS_CSV_FILE, 'id', $appointment_id, APPOINTMENT_OBJECT_KEYS);
    if (!$appointment) throw new Exception("No appointment with ID: $appointment_id was found");
    return $appointment;
}

function create_appointment(array $appointment_fields): array
{
    $appointment = add_row_to_csv(APPOINTMENTS_CSV_FILE, $appointment_fields, APPOINTMENT_OBJECT_KEYS);
    return $appointment;
}

function has_appointment_datetime_already_passed(array $appointment): bool
{
    $date = get_date_in_assoc_format($appointment["date"]);
    $time = get_time_in_assoc_format($appointment["time"]);
    return has_date_passed($date, $time);
}

function update_appointment(string $appointment_id, array $new_appointment_fields): array
{
    $appointment = find_appointment($appointment_id);

    $datetime_already_passed = has_appointment_datetime_already_passed($appointment);
    if ($datetime_already_passed) throw new Exception("This appointment cannot be edited because the datetime already passed");

    $updated_appointment = edit_row_from_csv(APPOINTMENTS_CSV_FILE, 'id', $appointment_id, $new_appointment_fields, APPOINTMENT_OBJECT_KEYS);
    return $updated_appointment;
}

function delete_appointment(string $appointment_id)
{
    $appointment = find_appointment($appointment_id);

    $datetime_already_passed = has_appointment_datetime_already_passed($appointment);
    if ($datetime_already_passed) throw new Exception("This appointment cannot be deleted because the datetime already passed");

    return delete_row_from_csv(APPOINTMENTS_CSV_FILE, 'id', $appointment_id, APPOINTMENT_OBJECT_KEYS);
}
