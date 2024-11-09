<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require('../Model/usuari.php');

// Funció per verificar si te tot lo necessari per  fer l'insert
function signup($nom, $correu, $contrasenya, $confirmacio_contrasenya) {
    $nom = trim(htmlspecialchars($nom));
    $correu = trim(htmlspecialchars($correu));
    $contrasenya = trim(htmlspecialchars($contrasenya));
    $confirmacio_contrasenya = trim(htmlspecialchars($confirmacio_contrasenya));
    // Comprovem si els camps estan buits
    if (empty($nom) || empty($correu) || empty($contrasenya) || empty($confirmacio_contrasenya)) {
        $_SESSION['message'] = "Els camps no poden estar buits.";
        return;
    // Comprovem si el correu te el format correcte
    } else if (!filter_var($correu, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['message'] = "El correu no te el format correcte. Exemple: nom@domini.com";
        return;
    // Comprovem que la contrasenya tingui minim 8 caracters amb majuscules, minuscules, numeros i simbols
    } else if (!preg_match('/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[^\w\d\s:])([^\s]){8,16}$/', $contrasenya)) {
        $_SESSION['message'] = "La contrasenya ha de tenir entre 8 i 16 caracters, una majuscula, una minuscula, un numero i un simbol.";
        return;
    // Comprovem si les contrasenyes son iguals
    } else if ($contrasenya !== $confirmacio_contrasenya) {
        $_SESSION['message'] = "Els camps contrasenya no son igual.";
        return;
    // Comprovem si el correu ja existeix
    } else if (correuExisteix($correu)) {
        $_SESSION['message'] = "El correu ja existeix.";
        return;
    // Si tot esta correcte, fem el hash de la contrasenya i cridem a afegirUsari per fer l'insert
    } else {
        $contrasenya_hashed = password_hash($contrasenya, PASSWORD_DEFAULT);
        
        afegirUsuari($nom, $correu, $contrasenya_hashed);
        
        $_SESSION['message'] = "Usuari registrat correctament.";
        
        header('Location: ../index.php');
        exit();
    }
}

// Funció per verificar si te tot lo necessari per fer el login
function login($correu, $contrasenya, $recordar) {
    
    $correu = trim(htmlspecialchars($correu));
    $contrasenya = trim(htmlspecialchars($contrasenya));

    // Comprovem si els camp correu esta buit
    if (empty($correu)) {
        $_SESSION['message'] = "El camp correu esta buit.";
        return;
        // Comprovem si els camp contraseya esta buit
    }else if (empty($contrasenya)) {
        $_SESSION['message'] = "El camp contraseya esta buit.";
        return;
    // Comprovem si el correu existeix
    }else if (!correuExisteix($correu)) {
        $_SESSION['message'] = "El correu no existeix.";
        return;
    }

    // Si tot esta correcte, cridem a obtenirUsuari per obtenir el correu de l'usuari
    $usuari = obtenirUsuari($correu);
    
    // Comprovem si la contrasenya es correcta
    if (!password_verify($contrasenya, $usuari['contrasenya'])) {
        $_SESSION['message'] = "Contrasenya incorrecta.";
        return;
    }

    if ($recordar) {
        setcookie('correu', $correu, time() + (86400 * 30), "/");
        setcookie('contrasenya', $contrasenya, time() + (86400 * 30), "/");
    }
    

    $_SESSION['message'] = "Sessió iniciada correctament.";
    
    // Guardem el correu i el nom de l'usuari a la session per poder modificar els botons  de index.php(benvinguda) i header.php(navbar)
    $_SESSION['correu'] = $usuari['correu'];
    $_SESSION['nom'] = $usuari['nom'];
    $_SESSION['foto'] = $usuari['foto'];
    $_SESSION['timeout'] = time();
    

    header('Location: ../index.php');
    exit();
}

// Funció per canviar la contrasenya
function canviarContrasenya($antiga, $nova, $repetir) {
    // Sanititzar inputs
    $antiga = trim(htmlspecialchars($antiga));
    $nova = trim(htmlspecialchars($nova));
    $repetir = trim(htmlspecialchars($repetir));

    // Comprovar si els camps estan buits
    if (empty($antiga) || empty($nova) || empty($repetir)) {
        $_SESSION['message'] = "Els camps no poden estar buits.";
        return;
    }

    // Comprovar si la nova contrasenya compleix els requisits de seguretat
    if (!preg_match('/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[^\w\d\s:])([^\s]){8,16}$/', $nova)) {
        $_SESSION['message'] = "La contrasenya ha de tenir entre 8 i 16 caràcters, una majúscula, una minúscula, un número i un símbol.";
        return;
    }

    // Comprovar si les noves contrasenyes coincideixen
    if ($nova !== $repetir) {
        $_SESSION['message'] = "Els camps de nova contrasenya no coincideixen.";
        return;
    }
    
    $usuari = obtenirUsuari($_SESSION['correu']);

    // Comprovar si la contrasenya antiga és correcta
    if (!password_verify($antiga, $usuari['contrasenya'])) {
        $_SESSION['message'] = "La contrasenya antiga no és correcta.";
        return;
    }

    // Hash de la nova contrasenya
    $nova_hasheada = password_hash($nova, PASSWORD_DEFAULT);

    // Actualitzar la contrasenya a la base de dades
    if (actualitzarContrasenya($_SESSION['correu'], $nova_hasheada)) {
        $_SESSION['message'] = "Contrasenya canviada correctament.";
        header('Location: ../index.php');
        exit();
    } else {
        $_SESSION['message'] = "Hi ha hagut un problema al canviar la contrasenya.";
    }
}


function actualitzarNom($nouNom) {
    $nouNom = trim(htmlspecialchars($nouNom));

    // Comprovar si el camp està buit
    if (empty($nouNom)) {
        $_SESSION['message'] = "El camp nom no pot estar buit.";
        return;
    }

    // Comprovar si el nou nom és el mateix que l'antic
    if ($nouNom === $_SESSION['nom']) {
        $_SESSION['message'] = "El nou nom no pot ser el mateix que l'antic.";
        return;
    }

    // Actualitzar el nom a la base de dades
    $correu = $_SESSION['correu']; // Usar el correo almacenado en la sesión
    if (actualitzarNomUsuari($correu, $nouNom)) {
        $_SESSION['nom'] = $nouNom;
        $_SESSION['message'] = "Nom actualitzat correctament.";
        header('Location: ../index.php');
        exit();
    } else {
        $_SESSION['message'] = "Error en actualitzar el nom.";
    }
}

function actualitzarFoto($foto) {
    // Comprovar si hi ha un error en la pujada de la foto
    if ($foto['error'] !== UPLOAD_ERR_OK) {
        $_SESSION['message'] = "Error en pujar la foto.";
        return;
    }

    // Comprovar el tipus de fitxer
    $allowedTypes = ['image/jpeg', 'image/png'];
    if (!in_array($foto['type'], $allowedTypes)) {
        $_SESSION['message'] = "Només es permeten fitxers JPEG i PNG.";
        return;
    }

    // Moure la foto a la carpeta de destinació
    $destinacio = '../Vista/fotosUsuaris/' . basename($foto['name']);
    if (!move_uploaded_file($foto['tmp_name'], $destinacio)) {
        $_SESSION['message'] = "Error en moure la foto.";
        return;
    }

    // Ajustar la ruta para la base de datos
    $rutaBD = './Vista/fotosUsuaris/' . basename($foto['name']);

    // Actualitzar la ruta de la foto a la base de dades
    $correu = $_SESSION['correu']; // Usar el correo almacenado en la sesión
    if (actualitzarFotoUsuari($correu, $rutaBD)) {
        $_SESSION['foto'] = $rutaBD;
        $_SESSION['message'] = "Foto actualitzada correctament.";
        header('Location: ../index.php');
        exit();
    } else {
        $_SESSION['message'] = "Error en actualitzar la foto.";
    }
}

function actualitzarTot($nouNom, $foto) {
    $nouNom = trim(htmlspecialchars($nouNom));

    // Comprovar si el camp està buit
    if (empty($nouNom)) {
        $_SESSION['message'] = "El camp nom no pot estar buit.";
        return;
    }

    // Comprovar si el nou nom és el mateix que l'antic
    if ($nouNom === $_SESSION['nom']) {
        $_SESSION['message'] = "El nou nom no pot ser el mateix que l'antic.";
        return;
    }

    // Actualitzar el nom a la base de dades
    $correu = $_SESSION['correu']; // Usar el correo almacenado en la sesión
    if (actualitzarNomUsuari($correu, $nouNom)) {
        $_SESSION['nom'] = $nouNom;
        $_SESSION['message'] = "Nom actualitzat correctament.";
    } else {
        $_SESSION['message'] = "Error en actualitzar el nom.";
        return;
    }

    // Comprovar si hi ha un error en la pujada de la foto
    if ($foto['error'] !== UPLOAD_ERR_OK) {
        $_SESSION['message'] = "Error en pujar la foto.";
        return;
    }

    // Comprovar el tipus de fitxer
    $allowedTypes = ['image/jpeg', 'image/png'];
    if (!in_array($foto['type'], $allowedTypes)) {
        $_SESSION['message'] = "Només es permeten fitxers JPEG i PNG.";
        return;
    }

    // Moure la foto a la carpeta de destinació
    $destinacio = '../Vista/fotosUsuaris/' . basename($foto['name']);
    if (!move_uploaded_file($foto['tmp_name'], $destinacio)) {
        $_SESSION['message'] = "Error en moure la foto.";
        return;
    }

    // Ajustar la ruta para la base de datos
    $rutaBD = './Vista/fotosUsuaris/' . basename($foto['name']);

    // Actualitzar la ruta de la foto a la base de dades
    if (actualitzarFotoUsuari($correu, $rutaBD)) {
        $_SESSION['foto'] = $rutaBD;
        $_SESSION['message'] = "Foto actualitzada correctament.";
    } else {
        $_SESSION['message'] = "Error en actualitzar la foto.";
        return;
    }

    // Si tot ha anat bé, redirigir a la pàgina principal
    $_SESSION['message'] = "Nom i foto actualitzats correctament.";
    header('Location: ../index.php');
    exit();
}
// Función para borrar la foto de perfil
function borrarFoto() {
    $correu = $_SESSION['correu']; // Usar el correo almacenado en la sesión
    if (actualitzarFotoUsuari($correu, null)) {
        // Eliminar la foto del servidor
        if (file_exists($_SESSION['foto'])) {
            unlink($_SESSION['foto']);
        }
        // Eliminar la ruta de la foto de la sesión
        unset($_SESSION['foto']);
        $_SESSION['message'] = "Foto borrada correctament.";
        header('Location: ../index.php');
        exit();
    } else {
        $_SESSION['message'] = "Error en borrar la foto.";
    }
}
?>