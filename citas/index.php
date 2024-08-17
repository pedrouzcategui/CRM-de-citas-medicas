<?php

require_once '../citas/entity.php';
require_once '../pacientes/entity.php';
require_once '../medicos/entity.php';

require_once '../utils.php';
require_once '../middleware.php';
require_once '../csv_functions.php';
require_once '../components/table.php';
require_once '../components/select.php';
require_once '../components/input.php';

if (!is_user_allowed('nurse')) {
    redirect_to_not_found();
}

// $appointments = file(APPOINTMENTS_CSV_FILE);
$appointments = get_appointments();
$patients = get_patients();
$doctors = get_doctors();

$unique_patients_list =  get_unique_records(get_patients());
$unique_doctors_list = get_unique_records(get_doctors());

function build_appointments_table($appointments, $patients, $doctors): array
{
    $formatted_appointments_rows = [];
    foreach ($appointments as $appt) {
        $formatted_row = [
            'id' => $appt['id'],
            'Paciente' => $patients[$appt['patientID']],
            'Doctor' => $doctors[$appt['doctorID']],
            'Status' => $appt['status'],
            'Fecha' => get_readable_date_spanish($appt['date']),
            'Hora' => military_to_standard_time($appt['time'])
        ];
        array_push($formatted_appointments_rows, $formatted_row);
    }
    return $formatted_appointments_rows;
}

$formatted_appointments_rows = build_appointments_table($appointments, $unique_patients_list, $unique_doctors_list);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citas</title>
    <link rel="stylesheet" href="../styles.css">
</head>

<?php require_once '../partials/menu.php' ?>


<body>
    <main class="container">

        <h2 class="text-center">Agregar Cita</h2>

        <form method="POST" action="agregar.php">
            <div class="grid grid-cols-2 gap" style="margin-bottom: 20px;">
                <?= render_select('patientID', 'Paciente', $patients, 'id', 'name') ?>
                <?= render_select('doctorID', 'Doctor', $doctors, 'id', 'name') ?>
                <?= render_input('date', 'date', 'Fecha', '', '', true) ?>
                <?= render_input('time', 'time', 'Hora', '', '', true) ?>
            </div>
            <div class="form-control">
                <button type="submit">Agregar Cita</button>
            </div>
        </form>

        <h2>Lista Citas: </h2>
        <?= render_table_2($formatted_appointments_rows) ?>
    </main>

</body>

</html>