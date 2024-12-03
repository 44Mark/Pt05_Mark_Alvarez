<?php
// Llistat que tindra l'administrador per veure tots els usuaris
require(__DIR__ . '/../Model/usuari.php');
include(__DIR__ . '/../Vista/header/header.php');

$usuaris = obtenirUsuaris();
?>