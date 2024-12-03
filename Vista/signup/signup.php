<?php
// Vista per que l'usuari es pugi registrar en la nostra pàgina web

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include('../header/header.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar-se</title>
    <link rel="stylesheet" href="../../Vista/estils.css">
</head>
<body>
    <div class="registrar">
        <h1>Registrar-se</h1>
        <form action="signup" method="post">
        <div class="contenedor-input">
            <label>Nom</label>
            <input type="text" name="nombre" value="<?php echo isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : ''; ?>">
        </div>
        <div class="contenedor-input">
            <label>Correu electrònic</label>
            <input type="email" name="correo" value="<?php echo isset($_POST['correo']) ? htmlspecialchars($_POST['correo']) : ''; ?>">
        </div>
            <div class="contenedor-input">
                <label>Contrasenya</label>
                <input type="password" name="contrasenya">
            </div>
            <div class="contenedor-input">
                <label>Confirmació de contrasenya</label>
                <input type="password" name="confirmacio_contrasenya">
            </div>
            <input type="submit" class="button" value="Registrar-se">
        </form>
        
        <?php
        // Si s'ha enviat el formulari, cridem a la funció signup
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            require '../../Controlador/verificarUsuari.php';
            signup($_POST['nombre'], $_POST['correo'], $_POST['contrasenya'], $_POST['confirmacio_contrasenya']);
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