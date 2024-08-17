<?php

require_once '../middleware.php';
require_once '../utils.php';
require_once '../components/table.php';
require_once '../components/input.php';

if (!is_user_allowed('nurse')) {
    redirect_to_not_found();
}

$patients = file('pacientes.csv');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pacientes</title>
    <link rel="stylesheet" href="../styles.css">
</head>

<?php require_once '../partials/menu.php' ?>

<body>

    <main class="container">
        <h2 class="text-center">Agregar Paciente</h2>

        <form method="POST" action="agregar.php">
            <div class="grid grid-cols-2 gap" style="margin-bottom: 20px;">
                <?= render_input('text', 'name', 'Nombre', '', 'Ex: Pedro Pérez', true) ?>
                <?= render_input('email', 'email', 'Email', '', 'Ex: pedroperez@gmail.com', true) ?>
            </div>
            <div class="grid grid-cols-2 gap">
                <div class="form-control flex flex-col justify-center">
                    <label class="block mb-sm" for="gender">Genero</label>
                    <div class="flex items-center gap">
                        <label for="gender">
                            <input type="radio" name="gender" value="M" checked />
                            Masculino
                        </label>
                        <label for="gender">
                            <input type="radio" name="gender" value="F" />
                            Femenino
                        </label>
                    </div>
                </div>
                <?= render_input('date', 'birthday', 'Fecha de nacimiento', '', '', true) ?>
            </div>
            <div class="form-control">
                <button type="submit">Agregar Paciente</button>
            </div>
        </form>

        <h2>Lista Pacientes: </h2>
        <?= render_table(PATIENT_OBJECT, $patients, ['filename' => 'history.php', 'label' => 'Ver Historial Médico']) ?>
    </main>

</body>

</html>