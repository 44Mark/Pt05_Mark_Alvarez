<?php 
// Vista creada per imprimir els articles guardats en la BD per la variable $articlesToShow que es passa des del controlador segons tots els articles
// o els de l'usuari quan fa login
?>
<div class="articulos">
    <?php foreach ($articlesToShow as $art): ?>
        <div class="articulo">
            <p><strong>ISBN:</strong> <?php echo htmlspecialchars($art['isbn']); ?></p>
            <p><strong>Títol:</strong> <?php echo htmlspecialchars($art['titol']); ?></p>
            <p><strong>Contingut:</strong> <?php echo htmlspecialchars($art['cos']); ?></p>
            <p class="hora"><?php echo (new DateTime($art['data_hora']))->format('d-m-Y'); ?></p>
            <?php if ($_SESSION['usuari_autenticat']): ?>
                <a href="Controlador/comprovmodificarLlibre.php?isbn=<?php echo $art['isbn']; ?>" class="botonmodificararticles">
                    <img src="../../Vista/assets/images-work/modificar.png" alt="Modificar" style="width: 20px; height: 20px;">
                </a>

                <a href="Controlador/eliminarLlibre.php?isbn=<?php echo $art['isbn']; ?>" class="botoneliminararticles" onclick="return confirm('Estàs segur que vols eliminar aquest llibre?');">
                    <img src="../../Vista/assets/images-work/eliminar.png" alt="Eliminar" style="width: 20px; height: 20px;">
                </a>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>
