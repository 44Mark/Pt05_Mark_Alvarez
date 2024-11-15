<!-- Mark Alvarez -->
<!DOCTYPE html>
<html lang="es">
<head>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include('./header.php'); 

if (!isset($_SESSION['correu'])) {
    header('Location: error401');
    exit;
}
?>

</head> 
<body>
    <h1 class="fons">Inserció de Llibres</h1>
    <div class="insertar">
        <form action="insert" method="post" class="insert">  
            <input type="hidden" name="accion" value="insertarLlibre">

            <div class="contenedor-input">
                <label for="isbn">ISBN:</label>
                <input type="text" id="isbn" name="isbn" value="<?php echo isset($_POST['isbn']) ? htmlspecialchars($_POST['isbn']) : ''; ?>">
            </div>

            <div class="contenedor-input">
                <label for="titol">Titol:</label>
                <input type="text" id="titol" name="titol" value="<?php echo isset($_POST['titol']) ? htmlspecialchars($_POST['titol']) : ''; ?>">
            </div>

            <div class="contenedor-input">
                <label for="cos">Cos:</label>
                <textarea name="cos" rows="8" cols="38"><?php echo isset($_POST['cos']) ? htmlspecialchars($_POST['cos']) : ''; ?></textarea>
            </div>

            <input type="submit" value="Enviar" class="button">
        </form>
        <button class="button" onclick="window.location.href='inici';">Tornar al menu</button>
        
        <?php
        // Si s'ha enviat el formulari, cridem a la funció comprovacioInsertarLlibre
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            require('../Controlador/insertarLlibre.php');
            $missatge = comprovacioInsertarLlibre($_POST['isbn'], $_POST['titol'], $_POST['cos'], $_SESSION['correu']);
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