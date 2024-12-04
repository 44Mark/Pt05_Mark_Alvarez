<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../env.php';
require_once '../vendor/autoload.php';
require '../Model/usuari.php';

use League\OAuth2\Client\Provider\Google;

// Reemplaza estos valores por los que Google te proporcionó
$clientID = GOOGLE_CLIENT_ID;
$clientSecret = GOOGLE_CLIENT_SECRET;
$redirectUri = 'https://markalvarez.cat/Controlador/oAuth.php';

$variable = new Google([
    'clientId' => $clientID,
    'clientSecret' => $clientSecret,
    'redirectUri' => $redirectUri
]);

// Si el código de autorización está presente
if (!isset($_GET['code'])) {
    $variable2 = $variable->getAuthorizationUrl();
    $_SESSION['oauth2state'] = $variable->getState();
    header('Location: ' . $variable2);
    exit();
}


// Si no tenemos el token, pedirlo
if (!isset($_GET['state']) || $_GET['state'] !== $_SESSION['oauth2state']) {
    unset($_SESSION['oauth2state']);
    exit('Invalid state');
} else {
    // Intentar obtener el token de acceso
    $token = $variable->getAccessToken('authorization_code', [
        'code' => $_GET['code']
    ]);

    // Opcional: ahora que tenemos el token, vamos a buscar algo de información del usuario
    try {
        $user = $variable->getResourceOwner($token);
        $userData = $user->toArray();
        $userEmail = $userData['email'];
        $userName = $userData['name'];
        $userPicture = $userData['picture'];
        
            // Comprobar si el usuario ya existe, sino, insertarlo
        if (!correuExisteix($userEmail)) {
            insertUsuariHybrid($userName, $userEmail, $userPicture, 'Google');
        }

        // Guardar los datos en la sesión
        $_SESSION['correu'] = $userEmail;
        $_SESSION['nom'] = $userName;
        $_SESSION['foto'] = $userPicture;
        $_SESSION['HybridAuth'] = true;

        // Redirigir a una página de bienvenida o al área de usuario
        header('Location: ../inici');
        exit();
    } catch (Exception $e) {
        exit('Error: ' . $e->getMessage());
    }


    
}
?>