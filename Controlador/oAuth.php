<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once './lib/vendor/autoload.php';

// Reemplaza estos valores por los que Google te proporcionó
$clientID = 'GOOGLE_CLIENT_ID';
$clientSecret = 'GOOGLE_CLIENT_SECRET';
$redirectUri = 'URL_REDIRECTION';

// Crear cliente de Google
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope(Google_Service_Oauth2::USERINFO_EMAIL);
$client->addScope(Google_Service_Oauth2::USERINFO_PROFILE);

$google_oauthV2 = new Google_Service_Oauth2($client);

// Si el código de autorización está presente
if (isset($_GET['code'])) {
    $client->authenticate($_GET['code']);
    $_SESSION['access_token'] = $client->getAccessToken();
    header('Location: ' . $redirectUri); // Redirige para que no se repita el proceso
    exit();
}

// Si no tenemos el token, pedirlo
if (!isset($_SESSION['access_token'])) {
    $authUrl = $client->createAuthUrl();
    echo "<a href='$authUrl'>Conectar con Google</a>"; // Enlace para iniciar la autenticación
} else {
    $client->setAccessToken($_SESSION['access_token']);
    
    // Obtener la información del usuario
    $userInfo = $google_oauthV2->userinfo->get();
    $userEmail = $userInfo->email;
    $userName = $userInfo->name;
    $userPicture = $userInfo->picture;

    // Aquí puedes guardar los datos en la base de datos si el usuario no existe
    echo "Bienvenido, " . $userName;
    echo "<img src='" . $userPicture . "' alt='Foto de perfil'>";
    
    // Guardar los datos en la sesión
    $_SESSION['user_email'] = $userEmail;
    $_SESSION['user_name'] = $userName;
    $_SESSION['user_picture'] = $userPicture;
    
    // Redirigir a una página de bienvenida o al área de usuario
    header('Location: welcome.php');
    exit();
}
?>
