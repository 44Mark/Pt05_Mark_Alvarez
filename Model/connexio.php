<?php
// Arxiu per connectar-se a la BBDD
require_once __DIR__ . '/../env.php';

// Connexió a la BBDD
$host = DB_HOST;      // Servidor
$dbname = DB_NAME;   // Nom de la BBDD
$user = DB_USER;     // Usuari de la BBDD
$pass = DB_PASSW;    // Contraseña

try {
    $connexio = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
} catch (PDOException $e) { 
    echo "Error en la conexión: " . $e->getMessage(); }

?>