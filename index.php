<?php

require_once 'components/input.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM medico</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="grid grid-cols-2" style="height: 100vh">
        <div class="flex flex-col justify-center" style="background-color: #74EBD5; background-image: linear-gradient(180deg, #74EBD5 0%, #9FACE6 100%); padding: 40px; color: white">
            <h1 style="font-size: 4rem;">CRM Médico</h1>
            <h2>Administra todas tus actividades clínicas <b>en un solo lugar</b> </h2>
        </div>
        <div class="flex flex-col justify-center" style="padding: 40px;">
            <h2 class="text-center">Login</h2>
            <form method="POST" action="auth/login.php">
                <?= render_input('email', 'email', 'Email', '', '', true) ?>
                <?= render_input('password', 'password', 'Contraseña', '', '', true) ?>
                <div class="form-control">
                    <button style="background-color: darkcyan; color: white" type="submit">Login</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>