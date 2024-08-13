<?php

require_once '../utils.php';
require_once '../csv_functions.php';
require_once '../components/table.php';
require_once '../components/select.php';

$id = get_param_from_url('id');
$patients = get_filtered_records(['id', 'name'], PATIENTS_CSV_FILE, PATIENT_OBJECT_KEYS);
$doctors = get_filtered_records(['id', 'name'], DOCTORS_CSV_FILE, DOCTOR_OBJECT_KEYS);

$appointment_row_values = find_record_by(APPOINTMENTS_CSV_FILE, 'id', $id, APPOINTMENT_OBJECT_KEYS);
$appointment_info = array_combine(APPOINTMENT_OBJECT_KEYS, $appointment_row_values);
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

        <h2 class="text-center">Editar Cita</h2>

        <form method="POST" action="actualizar.php?id=<?= $id ?>">
            <div class="grid grid-cols-3 gap" style="margin-bottom: 20px;">
                <div>
                    <?= render_select('patientID', 'Paciente', $patients, 'id', 'name', $appointment_info['patientID']) ?>
                </div>
                <div>
                    <?= render_select('doctorID', 'Doctor', $doctors, 'id', 'name', $appointment_info['doctorID']) ?>
                </div>
                <div>
                    <?= render_select('status', 'Status', APPOINTMENT_STATUSES, '', '', $appointment_info['status']) ?>
                </div>
            </div>
            <div class="grid grid-cols-2 gap" style="margin-bottom: 20px;">
                <div>
                    <label class="block mb-sm" for="">Fecha</label>
                    <input class="w-full" name="date" type="date" value=<?= $appointment_info['date'] ?>>
                </div>
                <div>
                    <label class="block mb-sm" for="">Time</label>
                    <input class="w-full" name="time" type="time" value=<?= $appointment_info['time'] ?>>
                </div>
                <input type="hidden" name="diagnosticID" value=<?= $appointment_info['diagnosticID'] ?> />
            </div>
            <div class="form-control">
                <button type="submit">Editar Cita</button>
            </div>
        </form>
    </main>

</body>

</html>