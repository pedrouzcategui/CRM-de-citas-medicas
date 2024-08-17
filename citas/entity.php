<?php

require_once '../medicos/entity.php';

require_once '../utils.php';
require_once '../middleware.php';
require_once '../csv_functions.php';

function get_appointments(): array
{
    return get_csv_as_array(APPOINTMENTS_CSV_FILE, APPOINTMENT_OBJECT_KEYS);
}

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

function is_doctor_available_for_another_appointment_on_this_date(string $doctor_id, string $date, string $time): bool
{

    $doctor = find_doctor($doctor_id);
    $appointments = get_appointments();
    $doctor_appointments = get_records_where($appointments, 'doctorID', $doctor['id']);
    $doctor_appointments_in_date = get_records_where($doctor_appointments, 'date', $date);

    $are_there_any_slots_left =  count($doctor_appointments_in_date) <  intval($doctor['appointments_number']);
    if (!$are_there_any_slots_left) throw new Exception("There are no slots available for this date: $date - Please choose another date or another doctor");

    $is_slot_available = is_appointment_available_at_this_time($doctor_appointments_in_date, $date, $time);

    return $is_slot_available;
}

function is_appointment_available_at_this_time(array $appointments, string $date, string $time): bool
{
    foreach ($appointments as $appointment) {
        if ($appointment['time'] == $time) throw new Exception("There are no slots available for this date: '$date' and this time: '$time' - Please choose another time ");
    }

    return true;
}
