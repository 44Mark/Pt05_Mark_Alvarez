<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Llibreria</title>
    <link rel="stylesheet" href="/Vista/estils.css">
</head>
<body>
    <nav class="navbar">
        <div class="navbar-left">
            <?php if (isset($_SESSION['usuari_autenticat']) && $_SESSION['usuari_autenticat'] == true): ?> 
                <a href="inici">Inici</a>
                <a href="insert">Insertar nou llibre</a>
            <?php else: ?>
                <a href="inici">Inici</a>  
            <?php endif; ?>
        </div>
        <div class="navbar-center">
            <span class="fixed-title">MÓN DE LLIBRES</span>
        </div>
        <div class="navbar-right">
            <div class="dropdown">
                <?php if (isset($_SESSION['usuari_autenticat']) && $_SESSION['usuari_autenticat'] == true && !empty($_SESSION['foto'])): ?>
                    <img src="<?php echo $_SESSION['foto']; ?>" alt="Foto de perfil" style="height: 45px;">
                <?php else: ?>
                    <img src="/Images/logo.png" style="height: 45px;">
                <?php endif; ?>
                <div class="dropdown-content">
                    <?php if (isset($_SESSION['usuari_autenticat']) && $_SESSION['usuari_autenticat'] == true): ?> 
                        <a href="modificarCompte">Modificar compte</a>
                        <a href="logout">Sortir</a>
                    <?php else: ?>
                        <a href="login">Login</a>
                        <a href="signup">Sign up</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
</body>
</html>