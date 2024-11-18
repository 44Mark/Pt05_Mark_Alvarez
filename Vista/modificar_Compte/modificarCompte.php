<?php
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
    <title>Modificar Compte</title>
</head>
<body>
    <div class="contenedor-central-modificar">
        <h1>Modificar Compte</h1>
        <div class="contenedor-flex">
            <?php if (!empty($_SESSION['foto'])): ?>
                <div class="contenedor-foto">
                    <img src="<?php echo $_SESSION['foto']; ?>" alt="Foto de perfil" style="max-width: 300px; max-height: 300px;">
                    <form action="modificarCompte" method="POST">
                        <button type="submit" name="action" value="borrar_foto" class="button">Borrar foto</button>
                    </form>
                </div>
            <?php endif; ?>
            <div class="contenedor-formulario">
                <form action="modificarCompte" method="POST" enctype="multipart/form-data">
                    <!-- Campo para la foto de perfil -->
                    <div class="form-group">
                        <label for="foto">Foto de perfil:</label>
                        <input type="file" id="foto" name="foto" accept="image/*">
                    </div>

                    <!-- Campo para el nombre -->
                    <div class="form-group">
                        <label for="nom">Nom:</label>
                        <input type="text" id="nom" name="nom" required value="<?php echo $_SESSION['nom']; ?>">
                    </div>

                    <!-- Botón para cambiar contraseña -->
                    <div class="form-group">
                    <label for="canvi-contrasenya">Canviar Contrasenya:</label>
                        <button type="button" onclick="window.location.href='canviContrasenya'" class="boton">Canviar contraseña</button>
                    </div>
                    <!-- Botón de envío -->
                    <button type="submit" name="action" value="actualizar" class="button">Guardar canvis</button>
                </form>
                <button class="button" onclick="window.location.href='inici'">Tornar al menú</button>
            </div>
        </div>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            require '../../Controlador/verificarUsuari.php';
            if ($_POST['action'] == 'actualizar') {
                if(!empty($_POST['nom']) && !empty($_FILES['foto']['name'])) {
                    actualitzarTot($_POST['nom'], $_FILES['foto']);
                } else
                if (!empty($_POST['nom'])) {
                    actualitzarNom($_POST['nom']);
                }
                if (!empty($_FILES['foto']['name'])) {
                    actualitzarFoto($_FILES['foto']);
                }
            } elseif ($_POST['action'] == 'borrar_foto') {
                borrarFoto();
            }
        }
        ?>
    </div>
</body>
</html>