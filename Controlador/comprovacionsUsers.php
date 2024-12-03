<?php
// Controlador per comporvar si s'ha iniciat sessió amb l'usuari administrador o no, amb la finalitat de mostrar o no els botons d'administrador
require('./Model/usuari.php');

$correuadmin = CORREU_ADMIN;

// Si la sessió correu està definida, significa que l'usuari està autenticat
if (isset($_SESSION['correu'])) {
    $_SESSION['usuari_autenticat'] = true;
} else {
    $_SESSION['usuari_autenticat'] = false;
}

// Si la sessió correu està definida i és igual a la variable de correu admin, farem que una nova sessió sigui igual a true
if (isset($_SESSION['correu']) && $_SESSION['correu'] == $correuadmin) {
    $_SESSION['correuAdmin'] = true;
} else {
    $_SESSION['correuAdmin'] = false;
}
?>