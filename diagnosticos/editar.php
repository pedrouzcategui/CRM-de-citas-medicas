<?php

require_once '../utils.php';
require_once '../csv_functions.php';
require_once '../components/table.php';
require_once '../components/select.php';
$id = get_param_from_url('id');
$diagnostic = find_record_by(DIAGNOSTICS_CSV_FILE, 'id', $id, DIAGNOSTIC_OBJECT_KEYS);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Citas</title>
    <link rel="stylesheet" href="../styles.css">
</head>

<?php require_once '../partials/menu.php' ?>

<body>
    <main class="container">
        <h2 class="text-center">Editar Diagnostico</h2>

        <form method="POST" action="actualizar.php?id=<?= $id ?>">
            <div class="grid" style="margin-bottom: 20px;">
                <div>
                    <label class="block mb-sm" for="diagnostic_description">Diagnostico</label>
                    <textarea class="form-input" name="diagnostic_description" placeholder="Ex: El paciente presentó sintomas de tos, se le recetó teragrip."><?= $diagnostic['description'] ?></textarea>
                </div>
            </div>

            <div class="form-control">
                <button type="submit">Editar Diagnostico</button>
            </div>
        </form>
    </main>

</body>

</html>