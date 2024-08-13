<?php

require_once '../utils.php';
require_once '../middleware.php';
require_once '../csv_functions.php';
require_once '../components/table.php';
require_once '../components/select.php';
require_once '../components/input.php';

$id = get_param_from_url('id');
$user = find_record_by(USERS_CSV_FILE, 'id', $id, USER_OBJECT_KEYS);
if (!$user) {
    redirect_to_not_found();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM Médico - Editar Usuario</title>
    <link rel="stylesheet" href="../styles.css">
</head>

<?php require_once '../partials/menu.php' ?>

<body>
    <main class="container">

        <h2 class="text-center">Editar Usuario</h2>

        <form method="POST" action="actualizar.php?id=<?= $id ?>" autocomplete="false">
            <div>
                <?= render_input('text', 'name', 'Nombre', $user['name'], 'Ex: Pedro', true) ?>
                <?= render_input('email', 'email', 'Email', $user['email'], 'Ex: pedro@crmmedico.com', true) ?>
                <!-- //I need to figure out the way to have it selected by default -->
                <?= render_select('role', 'Rol', USER_ROLES) ?>
                <?= render_input('password', 'password', 'Contraseña Actual', '', '* * * * * * * ', true) ?>
                <?= render_input('password', 'new_password', 'Nueva Contraseña', '', '* * * * * * * ', false) ?>
            </div>
            <div class="form-control">
                <button type="submit">Editar Usuario</button>
            </div>
        </form>
    </main>

</body>

</html>