<?php
// Controlador per a la autenticació amb HybridAuth
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../vendor/autoload.php';
require_once '../env.php';
require '../Model/usuari.php';

use Hybridauth\Hybridauth;
use Hybridauth\Exception\Exception;


$config = include('hybridAuth_Controller.php');
$hybridauth = new Hybridauth($config);

// Agafem el provider que es passa per GET (Google, GitHub, etc.)
$provider = isset($_GET['provider']) ? $_GET['provider'] : null;

if (!$provider) {
    throw new Exception('Proveedor no especificado.');
}

// Autenticació amb el provider
$adapter = $hybridauth->authenticate($provider);
$userProfile = $adapter->getUserProfile();

// Extreure les dades de l'usuari
$nom = $userProfile->displayName;
$correu = $userProfile->email;
$foto = $userProfile->photoURL;

// Comprovar si l'usuari ja existeix, sino, l'insertem
if (!correuExisteix($correu)) {
    insertUsuariHybrid($nom, $correu, $foto, $provider);
}

// Sessions necessaries per poder tenir el funcionament de la BD, i per poder fer el login
$_SESSION['correu'] = $correu;
$_SESSION['nom'] = $nom;
$_SESSION['foto'] = $foto;
$_SESSION['HybridAuth'] = true;

// Redirigir después de la autenticación
header('Location: ../inici');
exit;