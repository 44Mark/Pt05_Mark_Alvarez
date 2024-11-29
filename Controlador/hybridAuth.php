<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../lib/hybridauth-3.11.0/src/autoload.php';
require_once '../env.php';
require '../Model/usuari.php';

use Hybridauth\Hybridauth;
use Hybridauth\HttpClient;
use Hybridauth\Exception\Exception;


$config = include('hybridAuth_Controller.php');
$hybridauth = new Hybridauth($config);

// Detectar el proveedor desde el parámetro GET
$provider = isset($_GET['provider']) ? $_GET['provider'] : null;

if (!$provider) {
    throw new Exception('Proveedor no especificado.');
}

// Autenticación con el proveedor
$adapter = $hybridauth->authenticate($provider);
$userProfile = $adapter->getUserProfile();

// Extraer datos del usuario autenticado
$nom = $userProfile->displayName;
$correu = $userProfile->email;
$foto = $userProfile->photoURL;

if (!correuExisteix($correu)) {
    insertUsuariHybrid($nom, $correu, $foto, $provider);
}

// Iniciar sesión con el usuario (crear sesión)
$_SESSION['correu'] = $correu;
$_SESSION['nom'] = $nom;
$_SESSION['foto'] = $foto;
$_SESSION['HybridAuth'] = true;

// Redirigir después de la autenticación
header('Location: ../inici');
exit;