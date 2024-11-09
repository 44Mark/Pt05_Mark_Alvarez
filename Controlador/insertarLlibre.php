<?php
require('../Model/llibres.php');

// Comprovem que els camps no estiguin buits i cridem a la funció insertLlibre
function comprovacioInsertarLlibre($isbn, $titol, $cos, $correu) {

    $isbn = trim(htmlspecialchars($isbn));
    $titol = trim(htmlspecialchars($titol));
    $cos = trim(htmlspecialchars($cos));
    $correu = trim(htmlspecialchars($correu));
    
    //Si la variable correu esta buit, redirigim a la pagina de login
    if (empty($correu)) {
        $_SESSION['message'] = 'Has d\'iniciar sessió per poder insertar un llibre';
        header('Location: ../index.php');
        exit();
    // Comprovem si el camp isbn esta buit
     }else if (empty($isbn)) {
        $_SESSION['message'] = 'El isbn no pot estar buit';
        return;
    // Comprovem si ja existeix un llibre amb aquest isbn
    } else if (comprovarLlibre($isbn)) {
        $_SESSION['message'] = 'Ja existeix un llibre amb aquest isbn';
        return;
    // Eliminem guions del isbn
    } else {
        $isbn = str_replace('-', '', $isbn);
    // Comprovem si el camp isbn te 13 digits
        if (!preg_match('/^\d{13}$/', $isbn)) {
            $_SESSION['message'] = 'El isbn ha de tenir 13 dígits';
            return;
        // Comprovem si el camp isbn comença amb 978 o 979
        } else if (!preg_match('/^(978|979)/', $isbn)) {
            $_SESSION['message'] = 'El isbn ha de començar amb 978 o 979. Exemple "978-8413143194"';
            return;
        // Comprovem si el camp titol esta buit
        } else if (empty($titol)) {
            $_SESSION['message'] = 'El titol no pot estar buit';
            return;
        // Comprovem si el camp cos esta buit
        } else if (empty($cos)) {
            $_SESSION['message'] = 'El cos no pot estar buit';
            return;
        // Si tot esta correcte, cridem a insertLlibre per fer l'insert
        } else {
            insertLlibre($isbn, $titol, $cos, $correu);
            $_SESSION['message'] = 'Llibre insertat correctament';
            header('Location: ../index.php');
            exit();
    }
        }
    }
?>
