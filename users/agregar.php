<?php

require_once '../utils.php';
require_once '../middleware.php';
require_once '../csv_functions.php';

$name = trim($_POST['name']);
$email = sanitize_input($_POST['email']);
$role = $_POST['role'];
$password = sanitize_input($_POST['password']);
$password = hash("sha256", $password);
$row_number = uniqid();

$user_fields = array($row_number, $name, $email, $password, $role);

if (find_record_by(USERS_CSV_FILE, 'email', $email, USER_OBJECT_KEYS)) {
    redirect_to('/users/index.php?error=email_already_exists');
}

add_row_to_csv(USERS_CSV_FILE, $user_fields, USER_OBJECT_KEYS);

echo "User created\n";
echo "<a href='/crmmedico/users/index.php'>Volver a usuarios</a>";
