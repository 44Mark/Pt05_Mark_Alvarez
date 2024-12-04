<?php
// Controlador per poder modificar un Llibre, primerament amb comprovmodificarLlibre.php hem imprimir les dades, ara les podem editar i al donar-li
// a modificar farem les comprovacions necessaries per poder fer l'Update
require('../../Model/llibres.php');

// Comprovem que els camps no estiguin buits i cridem a la funció insertLlibre
function comprovactualitzarLlibre($isbn, $titol, $cos, $correu) {

    $titol = trim(htmlspecialchars($titol));
    $cos = trim(htmlspecialchars($cos));
    $correu = trim(htmlspecialchars($correu));
    
    // Comprovem si el camp isbn esta buit
    if (empty($isbn)) {
        $_SESSION['message'] = 'El isbn no pot estar buit';
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
        actualitzarLlibre($isbn, $titol, $cos, $correu);
        $_SESSION['message'] = 'Llibre actualitzat correctament';
        header('Location: /inici');
        exit();
    }
    }
?>
