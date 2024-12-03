<?php
//Vista per controlar la ordenació dels articles

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Guardem el valor en una Sessioj
if (isset($_POST['orden'])) {
    $_SESSION['orden'] = $_POST['orden'];
}

require('./Controlador/ordenarArticles.php');
?>

<div class="form-ordenacio">
    <form method="post" action="">
        <label for="orden">Ordenació:</label>
        <select name="orden" id="orden" onchange="this.form.submit()">
            <option value="asc" <?php if (isset($_SESSION['orden']) && $_SESSION['orden'] == 'asc') echo 'selected'; ?>>A a Z</option>
            <option value="desc" <?php if (isset($_SESSION['orden']) && $_SESSION['orden'] == 'desc') echo 'selected'; ?>>Z a A</option>
        </select>
    </form>
</div>