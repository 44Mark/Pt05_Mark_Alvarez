<?php
// Guardar el valor del desplegable en la sesión
if (isset($_POST['num_escollit'])) {
    $_SESSION['num_escollit'] = $_POST['num_escollit'];
}

require('./Controlador/controlPaginacio.php');
?>

<div class="form-desplegable">
        <form method="post" action="">
            <label for="num_escollit">Numero d'articles:</label>
            <select name="num_escollit" id="num_escollit" onchange="this.form.submit()">
                <option value="3" <?php if (isset($_SESSION['num_escollit']) && $_SESSION['num_escollit'] == 3) echo 'selected'; ?>>3</option>
                <option value="6" <?php if (isset($_SESSION['num_escollit']) && $_SESSION['num_escollit'] == 6) echo 'selected'; ?>>6</option>
                <option value="9" <?php if (isset($_SESSION['num_escollit']) && $_SESSION['num_escollit'] == 9) echo 'selected'; ?>>9</option>
                <option value="12" <?php if (isset($_SESSION['num_escollit']) && $_SESSION['num_escollit'] == 12) echo 'selected'; ?>>12</option>
                <option value="15" <?php if (isset($_SESSION['num_escollit']) && $_SESSION['num_escollit'] == 15) echo 'selected'; ?>>15</option>
                <option value="18" <?php if (isset($_SESSION['num_escollit']) && $_SESSION['num_escollit'] == 18) echo 'selected'; ?>>18</option>
            </select>
        </form>
    </div>
