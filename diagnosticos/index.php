<?php

require_once '../utils.php';
require_once '../middleware.php';
require_once '../components/table.php';

if (!is_user_allowed('doctor')) {
    redirect_to_not_found();
}

$diagnostics = file(DIAGNOSTICS_CSV_FILE);


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
        <h2 class="text-center">Agregar Diagnostico</h2>

        <h2>Lista Diagnosticos: </h2>
        <?= render_table(DIAGNOSTIC_OBJECT, $diagnostics, [], false, true) ?>
    </main>
</body>

</html>