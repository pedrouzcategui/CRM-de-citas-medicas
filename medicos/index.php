<?php

require_once '../utils.php';
require_once '../middleware.php';
require_once '../components/table.php';
require_once '../components/select.php';
require_once '../components/input.php';

$doctors = file(DOCTORS_CSV_FILE);

if (!is_user_allowed('admin')) {
    redirect_to_not_found();
}

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

        <h2 class="text-center">Agregar Medicos</h2>

        <form method="POST" action="agregar.php" autocomplete="false">
            <div class="grid grid-cols-2 gap" style="margin-bottom: 20px;">
                <?= render_input('text', 'name', 'Nombre', '', 'Ex: Pedro Pérez', true) ?>
                <div>
                    <?= render_select('specialty', 'Especialidad', DOCTOR_SPECIALTIES) ?>
                </div>
            </div>
            <div class="grid grid-cols-3 gap">
                <div class="form-control">
                    <label for="birthday" class="block mb-sm">Disponibilidad</label>
                    <div class="flex justify-between">
                        <div class="flex items-center">
                            <label class="custom_checkbox" for="availability">
                                <input type="checkbox" name="availabilty[]" value="L" />
                                <span class="checkmark">L</span>
                            </label>
                        </div>
                        <div class="flex items-center">
                            <label class="custom_checkbox" for="availability">
                                <input type="checkbox" name="availabilty[]" value="M" />
                                <span class="checkmark">M</span>
                            </label>
                        </div>
                        <div class="flex items-center">
                            <label class="custom_checkbox" for="availability">
                                <input type="checkbox" name="availabilty[]" value="X" />
                                <span class="checkmark">X</span>
                            </label>
                        </div>
                        <div class="flex items-center">
                            <label class="custom_checkbox" for="availability">
                                <input type="checkbox" name="availabilty[]" value="J" />
                                <span class="checkmark">J</span>
                            </label>
                        </div>
                        <div class="flex items-center">
                            <label class="custom_checkbox" for="availability">
                                <input type="checkbox" name="availabilty[]" value="V" />
                                <span class="checkmark">V</span>
                            </label>
                        </div>
                        <div class="flex items-center">
                            <label class="custom_checkbox" for="availability">
                                <input type="checkbox" name="availabilty[]" value="S" />
                                <span class="checkmark">S</span>
                            </label>
                        </div>
                        <div class="flex items-center">
                            <label class="custom_checkbox" for="availability">
                                <input type="checkbox" name="availabilty[]" value="D" />
                                <span class="checkmark">D</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-control flex flex-col justify-center">
                    <?= render_select('shift', 'Turno', SHIFTS) ?>
                </div>
                <div class="form-control">
                    <label class="block mb-sm" for="appointments_per_day">Numero de citas por dia</label>
                    <input name="appointments_per_day" class="form-input" type="number" min="1" value="1" required>
                </div>
            </div>
            <div class="form-control">
                <button type="submit">Agregar Medico</button>
            </div>
        </form>
        <!-- Table just in case -->
        <?= render_table(DOCTOR_OBJECT, $doctors) ?>
    </main>

</body>

</html>