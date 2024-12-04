<?php
// Controlador que valida el correu electrònic i envia un correu amb un token per a la recuperació de la contrasenya
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require('../Model/usuari.php'); 


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $correu = isset($_POST['correu']) ? trim($_POST['correu']) : '';

    // Verificar que el camp no estigui buit
    if (empty($correu)) {
        $_SESSION['message'] = "El camp de correu electrònic no pot estar buit.";
        header('Location: ../tokenCorreu');
        exit();
    }

    // Verificar que el correu electrònic existeixi
    if (!correuExisteix($correu)) { 
        $_SESSION['message'] = "El correu electrònic no està registrat.";
        header('Location: ../tokenCorreu');
        exit();
    }

    // Si existeix, es generara un token i es guardara a la base de dades
    $token = bin2hex(random_bytes(16));
    guardarToken($correu, $token); 
    
    if (enviarCorreuRecuperacio($correu, $token)) {
        $_SESSION['message'] = "Rebràs un missatge amb instruccions per recuperar la teva contrasenya.";
    } else {
        $_SESSION['message'] = "Hi ha hagut un error al enviar el correu. Torna-ho a intentar més tard.";
    }

    $_SESSION['message'] = "Rebràs un missatge amb instruccions per recuperar la teva contrasenya en el correu.";
    header('Location: ../inici');
    exit();
}

?>