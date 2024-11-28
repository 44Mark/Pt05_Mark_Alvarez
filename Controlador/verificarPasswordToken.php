<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../../Model/usuari.php';

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $correo = verificarToken($token);

    if ($correo === false) {
        $_SESSION['message'] = 'Token inválido';
        header('Location: index.php');
        exit();
    }

    $tokenTime = obtenirTempsToken($token);
    if ($tokenTime === false) {
        $_SESSION['message'] = 'Error al obtenir el temps del token';
        header('Location: index.php');
        exit();
    }

    $currentTime = new DateTime();
    $tokenDateTime = new DateTime($tokenTime);
    $interval = $currentTime->diff($tokenDateTime);

    if ($interval->days >= 2) {
        eliminarToken($token);
        $_SESSION['message'] = 'El token porta mes de 2 dies tornar a sol·licitar la recuperació de la contrasenya';
        header('Location: index.php');
        exit();
    }


} else {
    $_SESSION['message'] = 'Token no proporcionat';
    header('Location: index.php');
    exit();
}
?>