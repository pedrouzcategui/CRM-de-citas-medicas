<?php

/**File Paths */

define('ROOT_PATH', __DIR__);
define('PATIENTS_FOLDER_PATH', __DIR__ . '/pacientes');
define('DOCTORS_FOLDER_PATH', __DIR__ . '/medicos');
define('APPOINTMENTS_FOLDER_PATH', __DIR__ . '/citas');
define('DIAGNOSTICS_FOLDER_PATH', __DIR__ . '/diagnosticos');
define('AUTH_FOLDER_PATH', __DIR__ . '/auth');
define('USERS_FOLDER_PATH', __DIR__ . '/users');

/**DB File Paths */
define('PATIENTS_CSV_FILE', PATIENTS_FOLDER_PATH . '/pacientes.csv');
define('DOCTORS_CSV_FILE', DOCTORS_FOLDER_PATH . '/medicos.csv');
define('APPOINTMENTS_CSV_FILE', APPOINTMENTS_FOLDER_PATH . '/citas.csv');
define('DIAGNOSTICS_CSV_FILE', DIAGNOSTICS_FOLDER_PATH . '/diagnosticos.csv');
define('USERS_CSV_FILE', USERS_FOLDER_PATH . '/users.csv');
define('MIDDLEWARE_FILE', ROOT_PATH . '/middleware.php');

/**Entities */
define('APPOINTMENT_OBJECT', [
    'id' => 'ID Cita',
    'patientID' => 'ID paciente',
    'doctorID' => 'ID Doctor',
    'date' => 'Fecha',
    'time' => 'Hora',
    'status' => 'Estatus',
    'diagnosticID' => 'ID Diagnostico'
]);

define('PATIENT_OBJECT', [
    'id' => 'ID Paciente',
    'name' => 'Nombre',
    'email' => 'Email',
    'gender' => 'Género',
    'birthdate' => 'Fecha de Nacimiento',
]);

define('DOCTOR_OBJECT', [
    'id' => 'ID Doctor',
    'name' => 'Nombre',
    'specialty' => 'Especialidad',
    'shift' => 'Turno',
    'availability' => 'Disponibilidad',
    'appointments_number' => 'Numero de citas diario',
]);

define('DIAGNOSTIC_OBJECT', [
    'id' => 'ID Diagnostico',
    'appointmentID' => 'ID Cita',
    'patientID' => 'ID paciente',
    'doctorID' => 'ID Doctor',
    'description' => 'Descripcion Diagnóstico'
]);

define('MEDICAL_HISTORY_KEYS', [
    'Cita ID',
    'Fecha Cita',
    'Estatus',
    'Doctor ID',
    'Nombre Doctor',
    'Diagnostico'
]);

define('USER_OBJECT', [
    'id' => 'ID',
    'name' => 'Nombre',
    'email' => 'Email',
    'password' => 'Password',
    'role' => 'Rol'
]);


define('DOCTOR_SPECIALTIES', [
    'cardiology' => 'Cardiologo',
    'trauma' => 'Traumatologo',
    'surgeon' => 'Cirujano',
    'childcare' => 'Pediatra',
]);

define('USER_ROLES', [
    'admin' => 'Administrador/Administradora',
    'doctor' => 'Doctor/Doctora',
    'nurse' => 'Enfermero/Enfermera',
]);

define('DAYS', [
    'L' => 'Lunes',
    'M' => 'Martes',
    'X' => 'Miercoles',
    'J' => 'Jueves',
    'V' => 'Viernes',
    'S' => 'Sabado',
    'D' => 'Domingo',
]);

define('SHIFTS', [
    'm' => 'Mañana',
    'm-n' => 'Mañana/Tarde',
    'm-e' => 'Mañana/Noche',
    'n' => 'Tarde',
    'n-e' => 'Tarde/Noche',
    'e' => 'Noche',
]);

define('APPOINTMENT_STATUSES', [
    'confirmed' => 'Confirmado',
    'cancelled' => 'Cancelado',
    'showed' => 'Finalizada'
]);

define('PATIENT_OBJECT_KEYS', array_keys(PATIENT_OBJECT));
define('APPOINTMENT_OBJECT_KEYS', array_keys(APPOINTMENT_OBJECT));
define('DOCTOR_OBJECT_KEYS', array_keys(DOCTOR_OBJECT));
define('DIAGNOSTIC_OBJECT_KEYS', array_keys(DIAGNOSTIC_OBJECT));
define('USER_OBJECT_KEYS', array_keys(USER_OBJECT));
