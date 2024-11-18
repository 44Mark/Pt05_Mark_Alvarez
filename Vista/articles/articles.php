<div class="articulos">
    <?php foreach ($articlesToShow as $art): ?>
        <div class="articulo">
            <p><strong>ISBN:</strong> <?php echo htmlspecialchars($art['isbn']); ?></p>
            <p><strong>Títol:</strong> <?php echo htmlspecialchars($art['titol']); ?></p>
            <p><strong>Contingut:</strong> <?php echo htmlspecialchars($art['cos']); ?></p>
            <?php if ($_SESSION['usuari_autenticat']): ?>
                <a href="Controlador/comprovmodificarLlibre.php?isbn=<?php echo $art['isbn']; ?>" class="botonindex">Modificar</a>
                <a href="Controlador/eliminarLlibre.php?isbn=<?php echo $art['isbn']; ?>" class="botonindex" onclick="return confirm('Estàs segur que vols eliminar aquest llibre?');">Eliminar</a>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>