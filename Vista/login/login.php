<?php
// Vista per poder iniciar Sessió

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include('../header/header.php');

if (!isset($_SESSION['login_intents'])) {
    $_SESSION['login_intents'] = 0;
}

//Cridem al env on tenim les dades privades de les claus del Recaptcha
require_once('../../env.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sessió</title>
    <link rel="stylesheet" href="../../Vista/estils.css">
</head>
<body>
    <div class="login">
        <h1>Iniciar sesió</h1>
        <form action="login" method="post">
            <div class="contenedor-input">
                <label>Correu electrònic</label>
                <input type="email" name="correu" value="<?php echo isset($_POST['correu']) ? htmlspecialchars($_POST['correu']) : ''; ?>">
            </div>

            <div class="contenedor-input">
                <label>Contrasenya</label>
                <input type="password" name="contrasenya" value="<?php echo isset($_POST['contrasenya']) ? htmlspecialchars($_POST['contrasenya']) : ''; ?>">
            </div>

            <!-- ReCAPTCHA: Si hi ha mes de 3 errors -->
            <?php if ($_SESSION['login_intents'] >= 3): ?>
                <div class="g-recaptcha" data-sitekey=<?= CLAU_PUBLICA?> required></div>
            <?php endif; ?>

            <input type="checkbox" name="recordar" value="1" <?php echo isset($_POST['recordar']) ? 'checked' : ''; ?>> Recordarme<br>
            
            <p>Contrasenya olbidada? <a href="tokenCorreu">Recuperar</a></p>   

            <input type="submit" class="button" value="Iniciar sesión">
            <input type="button" class="button" value="Tornar" onclick="window.location.href='inici'">

            <div class="login-container">
                <a href="../../Controlador/hybridAuth.php?provider=GitHub">
                    <img src="https://github.githubassets.com/images/modules/logos_page/GitHub-Mark.png" 
                        alt="Iniciar sesión con GitHub">
                </a>
            </div>
        </form>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>

        <?php
            // Si s'ha enviat les dades cridarem a la funció login
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                require '../../Controlador/verificarUsuari.php';
                $recordar = isset($_POST['recordar']) ? true : false;
                login($_POST['correu'], $_POST['contrasenya'], $recordar, $_POST['g-recaptcha-response']);
            }

            // Si hay un mensaje, lo mostramos
            if (isset($_SESSION['message'])) {
                echo "<p class='missatge'>".$_SESSION['message']."</p>";
                unset($_SESSION['message']);
            }
        ?>
    </div>
</body>
</html>