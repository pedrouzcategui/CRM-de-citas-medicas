<?php

require_once '../utils.php';
require_once '../middleware.php';
require_once '../csv_functions.php';
require_once '../components/table.php';
require_once '../components/select.php';
require_once '../components/input.php';

if (!is_user_allowed('admin')) {
    redirect_to_not_found();
}


$filtered_user_keys = ['id', 'name', 'email', 'role'];
$users = get_filtered_records($filtered_user_keys, USERS_CSV_FILE, USER_OBJECT_KEYS);
$users_modified_csv = [];
foreach ($users as $user) {
    array_push($users_modified_csv, convert_array_into_csv_row($user));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM Médico - Usuarios</title>
    <link rel="stylesheet" href="../styles.css">
</head>

<?php require_once '../partials/menu.php' ?>

<body>
    <main class="container">

        <h2 class="text-center">Agregar Usuarios</h2>

        <form method="POST" action="agregar.php" autocomplete="false">
            <div>
                <?= render_input('text', 'name', 'Nombre', '', 'Ex: Pedro', true) ?>
                <?= render_input('email', 'email', 'Email', '', 'Ex: pedro@crmmedico.com', true) ?>
                <?= render_select('role', 'Rol', USER_ROLES) ?>
                <?= render_input('password', 'password', 'Contraseña', '', '* * * * * * * ', true) ?>
            </div>
            <div class="form-control">
                <button type="submit">Agregar Usuario</button>
            </div>
        </form>
        <!-- Table just in case -->
        <?= render_table($filtered_user_keys, $users_modified_csv) ?>
    </main>

</body>

</html>