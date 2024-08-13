<?php

require_once '../utils.php';
require_once '../csv_functions.php';

$id = get_param_from_url('id');
$patient_info = find_record_by(PATIENTS_CSV_FILE, 'id', $id, PATIENT_OBJECT_KEYS);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pacientes</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<?php require_once '../partials/menu.php' ?>

<body>
    <main class="container">
        <h2 class="text-center">Editar Paciente</h2>

        <form method="POST" action="actualizar.php?id=<?= $patient_info['id'] ?>">
            <div class="grid grid-cols-2 gap" style="margin-bottom: 20px;">
                <div>
                    <label class="block mb-sm" for="name">Nombre</label>
                    <input class="form-input" type="text" name="name" placeholder="Ex: Pedro Pérez" required value="<?= $patient_info['name'] ?>">
                </div>
                <div>
                    <label class="block mb-sm" for="email">Email</label>
                    <input class="form-input" type="email" name="email" required placeholder="Ex: pedroperez@gmail.com" value="<?= $patient_info['email'] ?>">
                </div>
            </div>
            <div class="grid grid-cols-2 gap">
                <div class="form-control flex flex-col justify-center">
                    <label class="block mb-sm" for="gender">Genero</label>
                    <div class="flex items-center justify-between gap">
                        <label for="gender_m">
                            <input type="radio" name="gender" value="M" id="gender_m" <?= $patient_info['gender'] == 'M' ? 'checked' : '' ?> />
                            Masculino
                        </label>
                        <label for="gender_f">
                            <input type="radio" name="gender" value="F" id="gender_f" <?= $patient_info['gender'] == 'F' ? 'checked' : '' ?> />
                            Femenino
                        </label>
                    </div>
                </div>
                <div class="form-control">
                    <label for="birthday" class="block mb-sm">Fecha de nacimiento</label>
                    <input type="date" name="birthday" class="w-full form-input" required value=<?= $patient_info['birthdate'] ?> />
                </div>
            </div>
            <div class="form-control">
                <button type="submit">Editar Paciente</button>
            </div>
        </form>
    </main>

</body>

</html>