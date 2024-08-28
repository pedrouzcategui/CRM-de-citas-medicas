<?php

require_once '../utils.php';
require_once '../middleware.php';
require_once '../components/table.php';

require_once '../medicos/entity.php';
require_once '../citas/entity.php';
require_once '../pacientes/entity.php';
require_once '../diagnosticos/entity.php';


if (!is_user_allowed('doctor')) {
    redirect_to_not_found();
}

$appointments = get_appointments();
$patients = get_patients();
$doctors = get_doctors();
$diagnostics = get_diagnostics();

function build_diagnostics_table($diagnostics): array
{
    $formatted_diagnostics_rows = [];
    foreach ($diagnostics as $diagnostic) {
        $appt = find_appointment($diagnostic['appointmentID']);
        $doctor = find_doctor($diagnostic['doctorID']);
        $patient = find_patient($diagnostic['patientID']);
        $formatted_row = [
            'id' => $diagnostic['id'],
            'Cita ID' => $appt['id'],
            'Fecha Cita' => get_readable_date_spanish($appt['date']),
            'Hora Cita' => military_to_standard_time($appt['time']),
            'Doctor Asignado' => $doctor['name'],
            'Paciente' => $patient['name'],
            'Diagnostico' => $diagnostic['description'],
        ];
        array_push($formatted_diagnostics_rows, $formatted_row);
    }
    return $formatted_diagnostics_rows;
}

$formatted_diagnostics = build_diagnostics_table($diagnostics);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles.css">
</head>

<?php require_once '../partials/menu.php' ?>


<body>
    <main class="container">
        <h2 class="text-center">Agregar Diagnostico</h2>

        <h2>Lista Diagnosticos: </h2>
        <?= render_table_2($formatted_diagnostics, [], false, true) ?>
    </main>
</body>

</html>