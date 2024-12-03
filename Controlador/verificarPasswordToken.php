<?php
// Controlador que s'executa cada vegada que s'entra a la vista que redirigeix del correu de recuperació de contrasenya, 
// comprovem que el token sigui vàlid i que no hagi passat més de 2 dies des de la seva creació

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../../Model/usuari.php';

if (isset($_GET['token'])) {
    //Agafem el token de la url
    $token = $_GET['token'];
    // Verifiquem que el token sigui vàlid i estigui en la base de dades
    $correo = verificarToken($token);

    // Si no esta el token a la base de dades redirigim a la pàgina principal
    if ($correo === false) {
        $_SESSION['message'] = 'Token inválido';
        header('Location: index.php');
        exit();
    }

    // Agafem el temps del token
    $tokenTime = obtenirTempsToken($token);
    if ($tokenTime === false) {
        $_SESSION['message'] = 'Error al obtenir el temps del token';
        header('Location: index.php');
        exit();
    }

    $currentTime = new DateTime();
    $tokenDateTime = new DateTime($tokenTime);
    $interval = $currentTime->diff($tokenDateTime);

    // Si el temps del token es major a 2 dies eliminem el token de la base de dades i redirigim a la pàgina principal
    if ($interval->days >= 2) {
        eliminarToken($token, $correu);
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