<?php
session_start();

require_once 'csv_functions.php';

function is_user_allowed(string ...$allowed_roles): bool
{
    $userID = $_SESSION['user_id'];
    $user = get_current_user_by_id($userID);
    if (!isset($userID) || !$user) return false;

    foreach ($allowed_roles as $allowed_role) {
        $user_role = get_user_role($user);
        if (($user_role !== $allowed_role)) return false;
    }

    return true;
}

function get_user_role($user): string
{
    return trim($user['role']);
}

function is_user_logged_in(): bool
{
    return isset($_SESSION['user_id']);
}

function get_current_user_by_id(string $id)
{
    return find_record_by(USERS_CSV_FILE, 'id', $id, USER_OBJECT_KEYS);
}

function destroy_session_and_redirect_to_login(): void
{
    session_unset();
    session_destroy();
    header('Location: http://localhost/crmmedico');
    die();
}

function redirect_to_not_found(): void
{
    header('Location: http://localhost/crmmedico/notfound.php');
}

function redirect_to(string $uri): void
{
    header("Location: http://localhost/crmmedico$uri");
    die();
}
