<!-- Mark Alvarez -->
<!DOCTYPE html>
<html lang="es">
<head>
    <?php include('./header.php'); ?>
</head>
<body>
    <div class="login">
        <h1>Inici Sessió</h1>
        <form action="login" method="post">
            <div class="contenedor-input">
                <label>Correu electrònic</label>
                <input type="email" name="correu" value="<?php echo isset($_COOKIE['correu']) ? htmlspecialchars($_COOKIE['correu']) : ''; ?>" >
            </div>

            <div class="contenedor-input">
                <label>Contrasenya</label>
                <input type="password" name="contrasenya" value="<?php echo isset($_COOKIE['contrasenya']) ? htmlspecialchars($_COOKIE['contrasenya']) : ''; ?>" >
            </div>
            
            <input type="checkbox" name="recordar" value="1" <?php echo isset($_COOKIE['correu']) ? 'checked' : ''; ?>>Recordar-me<br>
            <input type="submit" class="button button-block" value="Iniciar Sessió">
        </form>
        <?php
        
            // Si s'ha enviat el formulari, cridem a la funció login
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                require '../Controlador/verificarUsuari.php';
                $recordar = isset($_POST['recordar']) ? true : false;
                login($_POST['correu'], $_POST['contrasenya'], $recordar);
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