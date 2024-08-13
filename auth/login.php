<?php
session_start();

require_once '../utils.php';
require_once '../csv_functions.php';
require_once '../middleware.php';

$email = sanitize_input($_POST['email']);
$password = sanitize_input($_POST['password']);
$password = hash("sha256", $password);
$user = find_record_by(USERS_CSV_FILE, 'email', $email, USER_OBJECT_KEYS);

if (!$user) {
    header("Location: http://localhost/crmmedico?error=user_does_not_exist");
    die();
}

if (!($password == $user['password'])) {
    header("Location: http://localhost/crmmedico?error=incorrect_password");
    die();
}

$_SESSION['user_id'] = $user['id'];

switch (get_user_role($user)) {
    case 'admin':
        header("Location: http://localhost/crmmedico/medicos");
        break;
    case 'doctor':
        header("Location: http://localhost/crmmedico/diagnosticos");
        break;
    case 'nurse':
        header("Location: http://localhost/crmmedico/pacientes");
        break;
    default:
        header("Location: http://localhost/crmmedico/notfound.php");
        break;
}
