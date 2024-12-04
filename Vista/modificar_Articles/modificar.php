<?php
// Vista per poder modificar un llibre
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include('../header/header.php');

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
    <title>Modificar Llibre</title>
    <link rel="stylesheet" href="../../Vista/estils.css">
</head>
<body>
<h1 class="fons">Modificació de Llibres</h1>
    <div class="modificar">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="insert">  
            <input type="hidden" name="accion" value="actualitzarLlibre">

            <div class="contenedor-input">
                <label for="isbn">ISBN:</label>
                <input type="text" id="isbn" name="isbn" value="<?php echo isset($_SESSION['isbn']) ? htmlspecialchars($_SESSION['isbn']) : ''; ?>" readonly>
            </div>

            <div class="contenedor-input">
                <label for="titol">Titol:</label>
                <input type="text" id="titol" name="titol" value="<?php echo isset($_SESSION['titol']) ? htmlspecialchars($_SESSION['titol']) : ''; ?>" required>
            </div>

            <div class="contenedor-input">
                <label for="cos">Cos:</label>
                <textarea name="cos" rows="8" cols="38" required><?php echo isset($_SESSION['cos']) ? htmlspecialchars($_SESSION['cos']) : ''; ?></textarea>
            </div>

            <input type="submit" value="Actualitzar" class="button" onclick="return confirm('Estàs segur que vols actualitzar?');">
        </form>
        
        <button class="button" onclick="window.location.href='./inici';">Tornar al menú</button>

        <?php
        // Si s'ha enviat el formulari, cridem a la funció comprovactualitzarLlibre
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            require('../../Controlador/modificarLlibre.php');
            $missatge = comprovactualitzarLlibre($_POST['isbn'], $_POST['titol'], $_POST['cos'], $_SESSION['correu']);
        }
        ?>
    </div>
</body>
</html>
