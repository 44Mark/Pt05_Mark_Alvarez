<?php
session_start();

if (!isset($_SESSION['login_intents'])) {
    $_SESSION['login_intents'] = 0;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <?php include('./header.php'); ?>
</head>
<body>
    <div class="login">
        <h1>Iniciar sesión</h1>
        <form action="login" method="post">
            <div class="contenedor-input">
                <label>Correo electrónico</label>
                <input type="email" name="correu" value="<?php echo isset($_POST['correu']) ? htmlspecialchars($_POST['correu']) : ''; ?>">
            </div>

            <div class="contenedor-input">
                <label>Contraseña</label>
                <input type="password" name="contrasenya" value="<?php echo isset($_POST['contrasenya']) ? htmlspecialchars($_POST['contrasenya']) : ''; ?>">
            </div>

            <!-- ReCAPTCHA: Solo se muestra si hay más de 3 intentos fallidos -->
            <?php if ($_SESSION['login_intents'] >= 3): ?>
                <div class="g-recaptcha" data-sitekey="6Ld4738qAAAAAHVjkxjU-4lvk2RNqPN4dUQETIqp" required></div>
            <?php endif; ?>

            <input type="checkbox" name="recordar" value="1" <?php echo isset($_POST['recordar']) ? 'checked' : ''; ?>> Recordarme<br>
            <input type="submit" class="button button-block" value="Iniciar sesión">
        </form>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>

        <?php
            // Si se ha enviado el formulario, llamamos a la función login
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                require '../Controlador/verificarUsuari.php';
                $recordar = isset($_POST['recordar']) ? true : false;
                // Se pasa el valor de g-recaptcha-response directamente
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
