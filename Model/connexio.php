<?php
// Mark Alvarez

// Connexió a la BBDD
$host = '127.0.0.1';        // Servidor
$dbname = 'bd_mark';   // Nom de la BBDD
$user = 'root';             // Usuari de la BBDD
$pass = '';                 // Contraseña

try {
    $connexio = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
} catch (PDOException $e) { 
    echo "Error en la conexión: " . $e->getMessage(); }

?>