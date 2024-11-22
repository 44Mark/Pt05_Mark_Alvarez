<?php
// require dir llamo a usuari.php
require(__DIR__ . '/../Model/usuari.php');

// Incluye el archivo header.php desde la ruta correcta
include(__DIR__ . '/../Vista/header/header.php');

$usuaris = obtenirUsuaris();
?>