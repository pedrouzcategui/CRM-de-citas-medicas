<?php

require_once '../utils.php';
require_once '../csv_functions.php';

$id = get_param_from_url('id');
$doctor_info = find_record_by(DOCTORS_CSV_FILE, 'id', $id, DOCTOR_OBJECT_KEYS);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Medicos</title>
    <link rel="stylesheet" href="../styles.css">
</head>

<?php require_once '../partials/menu.php' ?>

<body>
    <main class="container">

        <h2 class="text-center">Editar Medicos</h2>

        <form method="POST" action="actualizar.php?id=<?= $doctor_info['id'] ?>">
            <div class="grid grid-cols-2 gap" style="margin-bottom: 20px;">
                <div>
                    <label class="block mb-sm" for="name">Nombre</label>
                    <input class="form-input" type="text" name="name" value="<?= $doctor_info['name'] ?>" required placeholder="Ex: Pedro Pérez">
                </div>
                <div>
                    <label class="block mb-sm" for="specialty">Especialidad</label>
                    <select class="w-full" name="specialty" required>
                        <option value="cardiologo" <?= $doctor_info['specialty'] == 'cariologo' ? 'selected' : '' ?>>Cardiologo</option>
                        <option value="traumatologo" <?= $doctor_info['specialty'] == 'traumatologo' ? 'selected' : '' ?>>Traumatologo</option>
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-3 gap">
                <div class="form-control">
                    <label for="birthday" class="block mb-sm">Disponibilidad</label>
                    <div class="flex justify-between">
                        <div class="flex items-center">
                            <label class="custom_checkbox" for="availability">
                                <input type="checkbox" name="availabilty[]" value="L" <?= str_contains($doctor_info['availability'], 'Lunes') ? 'checked' : '' ?> />
                                <span class="checkmark">L</span>
                            </label>
                        </div>
                        <div class="flex items-center">
                            <label class="custom_checkbox" for="availability">
                                <input type="checkbox" name="availabilty[]" value="M" <?= str_contains($doctor_info['availability'], 'Martes') ? 'checked' : '' ?> />
                                <span class="checkmark">M</span>
                            </label>
                        </div>
                        <div class="flex items-center">
                            <label class="custom_checkbox" for="availability">
                                <input type="checkbox" name="availabilty[]" value="X" <?= str_contains($doctor_info['availability'], 'Miercoles') ? 'checked' : '' ?> />
                                <span class="checkmark">X</span>
                            </label>
                        </div>
                        <div class="flex items-center">
                            <label class="custom_checkbox" for="availability">
                                <input type="checkbox" name="availabilty[]" value="J" <?= str_contains($doctor_info['availability'], 'Jueves') ? 'checked' : '' ?> />
                                <span class="checkmark">J</span>
                            </label>
                        </div>
                        <div class="flex items-center">
                            <label class="custom_checkbox" for="availability">
                                <input type="checkbox" name="availabilty[]" value="V" <?= str_contains($doctor_info['availability'], 'Viernes') ? 'checked' : '' ?> />
                                <span class="checkmark">V</span>
                            </label>
                        </div>
                        <div class="flex items-center">
                            <label class="custom_checkbox" for="availability">
                                <input type="checkbox" name="availabilty[]" value="S" <?= str_contains($doctor_info['availability'], 'Sabado') ? 'checked' : '' ?> />
                                <span class="checkmark">S</span>
                            </label>
                        </div>
                        <div class="flex items-center">
                            <label class="custom_checkbox" for="availability">
                                <input type="checkbox" name="availabilty[]" value="D" <?= str_contains($doctor_info['availability'], 'Domingo') ? 'checked' : '' ?> />
                                <span class="checkmark">D</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-control flex flex-col justify-center">
                    <label class="block mb-sm" for="shift">Turno</label>
                    <select name="shift">
                        <option value="m" <?= $doctor_info['shift'] == 'Mañana' ? 'selected' : '' ?>>Mañana</option>
                        <option value="m-n" <?= $doctor_info['shift'] == 'Mañana/Tarde' ? 'selected' : '' ?>>Mañana/Tarde</option>
                        <option value="m-e" <?= $doctor_info['shift'] == 'Mañana/Noche' ? 'selected' : '' ?>>Mañana/Noche</option>
                        <option value="n" <?= $doctor_info['shift'] == 'Tarde' ? 'selected' : '' ?>>Tarde</option>
                        <option value="n-e" <?= $doctor_info['shift'] == 'Tarde/Noche' ? 'selected' : '' ?>>Tarde/Noche</option>
                        <option value="e" <?= $doctor_info['shift'] == 'Noche' ? 'selected' : '' ?>>Noche</option>
                    </select>
                </div>
                <div class="form-control">
                    <label for="appointments_per_day">Numero de citas por dia</label>
                    <input name="appointments_per_day" class="form-input" type="number" min="1" value=<?= $doctor_info['appointments_number'] ?> required>
                </div>
            </div>
            <div class="form-control">
                <button type="submit">Editar Medico</button>
            </div>
        </form>
    </main>

</body>

</html>