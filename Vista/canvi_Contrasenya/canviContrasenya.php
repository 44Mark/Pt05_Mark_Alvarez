<?php
// Vista per canviar la contrasenya de l'usuari, demanem l'antiga contrasenya i la nova

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include('../header/header.php');

// Si no hi ha una sessió iniciada, redirigim a error401
if (!isset($_SESSION['correu'])) {
    header('Location: error401');
    exit;
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
        <h2>Canviar Contraseña</h2>
        <form action="canviContrasenya" method="POST">
            <div class="form-group">
                <label for="antiga">Contrasenya Antiga:</label><br>
                <input type="password" id="antiga" name="antiga">
            </div>

            <div class="form-group">
                <label for="nova">Nova Contraseña:</label><br>
                <input type="password" id="nova" name="nova">
            </div>

            <div class="form-group">
                <label for="repetir">Repetir Nova Contraseña:</label><br>
                <input type="password" id="repete" name="repetir">
            </div>

            <button type="submit" class="botonindex">Canviar Contraseña</button>
        </form>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            require '../../Controlador/verificarUsuari.php';
            canviarContrasenya($_POST['antiga'], $_POST['nova'], $_POST['repetir']);
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
