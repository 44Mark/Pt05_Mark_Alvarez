<?php
// Si l'usuari vol fer logout, es destrueix la sessió i es redirigeix a la pàgina d'inici
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
session_destroy();
header("Location: inici");
exit();
?>