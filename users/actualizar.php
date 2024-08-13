<?php

require_once '../utils.php';
require_once '../middleware.php';
require_once '../csv_functions.php';

$id = get_param_from_url('id');
$name = trim($_POST['name']);
$email = sanitize_input($_POST['email']);
$role = $_POST['role'];
$password = sanitize_input($_POST['password']);
$new_password = sanitize_input($_POST['new_password']);
$password = hash("sha256", $password);

$existing_user = find_record_by(USERS_CSV_FILE, 'id', $id, USER_OBJECT_KEYS);

if ($existing_user['password'] != $password) {
    redirect_to("/users/editar?id=$id&error=incorrect_current_password");
}

$user_fields = array($id, $name, $email, $new_password, $role);

edit_row_from_csv(USERS_CSV_FILE, 'id', $id, $user_fields, USER_OBJECT_KEYS);
echo "User edited\n";
echo "<a href='/crmmedico/users/index.php'>Volver a usuarios</a>";
