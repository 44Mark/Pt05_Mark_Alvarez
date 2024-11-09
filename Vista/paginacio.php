<?php
include(__DIR__ . '/../Controlador/controlPaginacio.php');
?>
        <section class="paginacio">
    <ul>
        <!-- Botón "Anterior" -->
        <li class="<?php echo ($page <= 1) ? 'disabled' : ''; ?>">
            <a href="?page=<?php echo max(1, $page - 1); ?>">&laquo;</a>
        </li>
        <!-- Botones de página -->
        <?php if ($totalPages > 0): ?>
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="<?php echo ($i == $page) ? 'active' : ''; ?>">
                    <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>
        <?php else: ?>
            <li class="active">
                <a href="?page=1">1</a>
            </li>
        <?php endif; ?>
        <!-- Botón "Siguiente" -->
        <li class="<?php echo ($page >= $totalPages) ? 'disabled' : ''; ?>">
            <a href="?page=<?php echo min($totalPages, $page + 1); ?>">&raquo;</a>
        </li>
    </ul>
</section>