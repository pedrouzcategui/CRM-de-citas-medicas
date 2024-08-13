<?php

require_once '../utils.php';
require_once '../csv_functions.php';
require_once '../components/table.php';

$id = get_param_from_url('id');
$patient = find_record_by(PATIENTS_CSV_FILE, 'id', $id, PATIENT_OBJECT_KEYS);
$appointments = find_records_by_id(APPOINTMENTS_CSV_FILE, 'patientID', $id, APPOINTMENT_OBJECT_KEYS);
$doctors = get_unique_records(get_filtered_records(['id', 'name'], DOCTORS_CSV_FILE, DOCTOR_OBJECT_KEYS));

function build_medical_history($appointments, $doctors)
{
    $medical_history = [];
    foreach ($appointments as $appointment) {
        $record = [
            'id' => $appointment['id'],
            'date' => $appointment['date'],
            'status' => $appointment['status'],
            'doctorID' => $appointment['doctorID'],
            'doctorName' => $doctors[$appointment['doctorID']],
            'diagnostic' => find_record_by(DIAGNOSTICS_CSV_FILE, 'id', $appointment['diagnosticID'], DIAGNOSTIC_OBJECT_KEYS)['description'],
        ];
        array_push($medical_history, $record);
    }

    $medical_history = sort_by_field($medical_history, 'date', true);
    $sorted_medical_history_csv = [];
    foreach ($medical_history as $record) {
        $record = convert_array_into_csv_row($record);
        array_push($sorted_medical_history_csv, $record);
    }

    return $sorted_medical_history_csv;
}

function get_appointments_insights(array $appointments): array
{
    return [
        'confirmed' => get_count_of_records_if($appointments, 'status', 'confirmed'),
        'cancelled' => get_count_of_records_if($appointments, 'status', 'cancelled'),
        'showed' => get_count_of_records_if($appointments, 'status', 'showed'),
    ];
}

$appointments_insights = get_appointments_insights($appointments);
$medical_history = build_medical_history($appointments, $doctors);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial Medico</title>
    <link rel="stylesheet" href="../styles.css">
</head>

<style>
    .insight {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin: 2rem 0px;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 1pt 5pt 20pt 1pt #ededed;

        .insight-number {
            font-size: 4rem;
            font-weight: bold;
        }
    }


    .confirmed {
        background-color: lightblue;
        color: darkblue
    }

    .cancelled {
        background-color: lightcoral;
        color: darkred
    }

    .showed {
        background-color: lightgreen;
        color: darkgreen
    }
</style>

<?php require_once '../partials/menu.php' ?>


<body>
    <main class="container">
        <h2 class="text-center">Historial Medico de <?= $patient['name'] ?></h2>
        <div class="grid grid-cols-3 gap">
            <div class="insight confirmed">
                <span>
                    Numero de citas confirmadas:
                </span>
                <span class="insight-number">
                    <?= $appointments_insights['confirmed'] ?>
                </span>
            </div>
            <div class="insight cancelled">
                <span>
                    Numero de citas canceladas:
                </span>
                <span class="insight-number">
                    <?= $appointments_insights['cancelled'] ?>
                </span>
            </div>
            <div class="insight showed">
                <span>
                    Numero de citas asistidas:
                </span>
                <span class="insight-number">
                    <?= $appointments_insights['showed'] ?>
                </span>
            </div>
        </div>
        <?= render_table(MEDICAL_HISTORY_KEYS, $medical_history, [], true, true) ?>
    </main>

</body>

</html>