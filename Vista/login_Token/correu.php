<?php
// Vista per demanar el correu i enviar un correu amb el token per recuperar la contrasenya

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
    <title>Recuperar Contrasenya</title>
    <link rel="stylesheet" href="../../Vista/estils.css">
</head>
<body>
    <div class="login">
        <h1>Recuperar Contrasenya</h1>
        <form action="../../Controlador/comprovacionsToken.php" method="post">
            <div class="contenedor-input">
                <label>Correu electrònic</label>
                <input type="email" name="correu" value="<?php echo isset($_POST['correu']) ? htmlspecialchars($_POST['correu']) : ''; ?>">
            </div>
            <input type="submit" class="button" value="Enviar">
            <input type="button" class="button" value="Tornar" onclick="window.location.href='inici'">
        </form>
        <?php
            // Si hay un mensaje, lo mostramos
            if (isset($_SESSION['message'])) {
                echo "<p class='missatge'>".$_SESSION['message']."</p>";
                unset($_SESSION['message']);
            }
        ?>
    </div>
</body>
</html>