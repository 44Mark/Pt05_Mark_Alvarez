<!-- Vista la qual tenim el navbar i totes les verificaciones per que sortin unes pestanyes o altres per a l'usari -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Llibreria</title>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-left">
            <!-- Si ha iniciar sessió tindra la pestanya per insertar un nou llibre -->
            <?php if (isset($_SESSION['usuari_autenticat']) && $_SESSION['usuari_autenticat'] == true): ?> 
                <a href="inici">Inici</a>
                <a href="insert">Insertar nou llibre</a>
            <?php else: ?>
            <!-- Sino nomes tindra l'inici -->
                <a href="inici">Inici</a>  
            <?php endif; ?>
        </div>
        <div class="navbar-center">
            <span class="fixed-title">MÓN DE LLIBRES</span>
        </div>
        <div class="navbar-right">
            <div class="dropdown">
                <!-- Si l'usuari a posat una foto de perfil la mostrarem -->
                <?php if (isset($_SESSION['usuari_autenticat']) && $_SESSION['usuari_autenticat'] == true && !empty($_SESSION['foto'])): ?>
                    <img src="<?php echo $_SESSION['foto']; ?>" alt="Foto de perfil" style="height: 45px;">
                <?php else: ?>
                    <!-- Sino mostrarem la foto per defecte -->
                    <img src="Vista/assets/images-work/logo.png" style="height: 45px;">
                <?php endif; ?>
                <div class="dropdown-content">
                    <!-- Si ha iniciat sessió tindra la pestanya per modificar el compte -->
                    <?php if (isset($_SESSION['usuari_autenticat']) && $_SESSION['usuari_autenticat'] == true): ?> 
                        <a href="modificarCompte">Modificar compte</a>
                        <!-- Si es admin tindra la pestanya per anar a la vista de admin -->
                        <?php if (isset($_SESSION['correuAdmin']) && $_SESSION['correuAdmin'] == true): ?>
                            <a href="vistaAdmin">Admin</a>
                        <?php endif; ?>
                        <a href="logout">Sortir</a>
                    <?php else: ?>
                        <!-- Sino ha iniciat sessió tindra les pestanyes de login i signup -->
                        <a href="login">Login</a>
                        <a href="signup">Sign up</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
</body>
</html>