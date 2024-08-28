<?php
session_start();

require_once 'csv_functions.php';

/**
 * 
 * Esta función chequea si un usuario esta permitido para ver el contenido de una página en específico
 * 
 */

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

/***
 * 
 * Esta función se usa para obtener el role de un usuario en la base de datos
 * 
 */

function get_user_role($user): string
{
    return trim($user['role']);
}

/***
 * 
 * 
 * Esta función se usa para saber si un usuario está loggeado.
 * 
 * 
 */

function is_user_logged_in(): bool
{
    return isset($_SESSION['user_id']);
}

/**
 * 
 * 
 * Esta función se usa para conocer el ID del usuario que está logueado
 * 
 * 
 */

function get_current_user_by_id(string $id)
{
    return find_record_by(USERS_CSV_FILE, 'id', $id, USER_OBJECT_KEYS);
}

/**
 * 
 * Esta función se usa para destruir una sesión y redirigir al usuario al login de la aplicación
 * 
 */

function destroy_session_and_redirect_to_login(): void
{
    session_unset();
    session_destroy();
    header('Location: http://localhost/crmmedico');
    die();
}

/**
 * 
 * Esta función se usa para redirigir al usuario a la página de NotFound
 * 
 */

function redirect_to_not_found(): void
{
    header('Location: http://localhost/crmmedico/notfound.php');
}

/**
 * 
 * Esta función se usa para devolver al usuario a una página en específico, con un mensaje en específico.
 * 
 */

function redirect_to(string $uri, string $message = ''): void
{
    header("Location: http://localhost/crmmedico$uri");
    die();
}
