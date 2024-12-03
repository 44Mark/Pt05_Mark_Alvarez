<?php
// Vista la qual arrivem després de clicar al link de canviar contrasenya que ens ha arribat per correu

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include('../header/header.php');
require_once '../../Controlador/verificarPasswordToken.php';

if (isset($_GET['token'])) {
    $token = $_GET['token'];
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Canviar Contraseña</title>
    <link rel="stylesheet" href="../../Vista/estils.css">
</head>
<body>
    <div class="contrasenya">
        <h2>Canviar Contraseña token</h2>
        <form action=<?="newPasswordToken?token=". $token?> method="POST">
            <div class="form-group">
                <label for="nova">Nova Contraseña:</label><br>
                <input type="password" id="nova" name="nova">
            </div>

            <div class="form-group">
                <label for="repetir">Repetir Nova Contraseña:</label><br>
                <input type="password" id="repetir" name="repetir">
            </div>

            <button type="submit" class="botonindex">Canviar Contraseña</button>
        </form>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            require '../../Controlador/verificarUsuari.php';
            
            canviarContrasenyaToken($_POST['nova'], $_POST['repetir']);
        }
        // Si hi ha un missatge, el mostrem
        if (isset($_SESSION['message'])) {
            $missatge = $_SESSION['message'];
            echo "<p class='missatge'>$missatge</p>";
            unset($_SESSION['message']);
        }
        ?>
    </div>
</body>
</html>