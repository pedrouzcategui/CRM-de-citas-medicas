<?php

require_once '../utils.php';
require_once '../middleware.php';
require_once '../csv_functions.php';
require_once '../components/table.php';
require_once '../components/select.php';

if (!is_user_allowed('nurse')) {
    redirect_to_not_found();
}

$appointments = file(APPOINTMENTS_CSV_FILE);
$patients = get_filtered_records(['id', 'name'], PATIENTS_CSV_FILE, array_keys(PATIENT_OBJECT));
$doctors = get_filtered_records(['id', 'name'], DOCTORS_CSV_FILE, array_keys(DOCTOR_OBJECT));

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

        <h2 class="text-center">Agregar Cita</h2>

        <form method="POST" action="agregar.php">
            <div class="grid grid-cols-2 gap" style="margin-bottom: 20px;">
                <div>
                    <?= render_select('patientID', 'Paciente', $patients, 'id', 'name') ?>
                </div>
                <div>
                    <?= render_select('doctorID', 'Doctor', $doctors, 'id', 'name') ?>
                </div>
                <div>
                    <label class="block mb-sm" for="">Fecha</label>
                    <input class="w-full" name="date" type="date">
                </div>
                <div>
                    <label class="block mb-sm" for="">Time</label>
                    <input class="w-full" name="time" type="time">
                </div>
            </div>
            <div class="form-control">
                <button type="submit">Agregar Cita</button>
            </div>
        </form>

        <h2>Lista Citas: </h2>
        <?= render_table(APPOINTMENT_OBJECT, $appointments) ?>
    </main>

</body>

</html>