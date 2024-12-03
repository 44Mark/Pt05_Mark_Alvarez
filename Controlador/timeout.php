<?php
// Controlador per a la gestió del timeout de la sessió de l'usuari
if (session_status() == PHP_SESSION_NONE) {
    // Durada de 40 minuts
    ini_set('session.gc_maxlifetime', 2400);
    session_start();
}


// Verifiquem si la sessió ha estat creada
if (isset($_SESSION['timeout'])) {
    // Verifiquem si la sessió ha expirat
    if ((time() - $_SESSION['timeout']) > ini_get('session.gc_maxlifetime')) {
        session_unset();
        session_destroy();
        $_SESSION['message'] = "Sessió finalitzada per inactivitat durant 40 minuts";
        header("Location: ../inici");
        exit();
    }
}

// Actualitzem el temps de timeout de la sessió
$_SESSION['timeout'] = time();