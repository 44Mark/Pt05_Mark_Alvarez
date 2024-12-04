<?php
// Model per gestionar totes les funcions relacionades amb els usuaris

require_once __DIR__ . '/../env.php';
require(__DIR__ . '/../Model/connexio.php');

// Funció per verificar si el correu ja existeix a la BD
function correuExisteix($correu) {
    global $connexio;
    
    $sql = "SELECT COUNT(*) FROM usuaris WHERE correu = :correu";
    $stmt = $connexio->prepare($sql);
    $stmt->bindParam(':correu', $correu);
    $stmt->execute();
    
    return $stmt->fetchColumn() > 0;
}

// Funció per obtenir el correu de l'usuari
function obtenirUsuari($correu) {
    global $connexio;
    
    $sql = "SELECT * FROM usuaris WHERE correu = :correu";
    $stmt = $connexio->prepare($sql);
    $stmt->bindParam(':correu', $correu);
    $stmt->execute();
    
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Funció per afegir un nou usuari a la base de dades
function afegirUsuari($nom, $correu, $contrasenya_hashed) {
    global $connexio;

    $sql = "INSERT INTO usuaris (nom, correu, contrasenya) VALUES (:nom, :correu, :contrasenya)";
    $stmt = $connexio->prepare($sql);
    
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':correu', $correu);
    $stmt->bindParam(':contrasenya', $contrasenya_hashed);
   
    $stmt->execute();
}

// Funció per actualitzar la contrasenya d'un usuari a la base de dades
function actualitzarContrasenya($correu, $nova_hashed) {
    global $connexio;

    $sql = "UPDATE usuaris SET contrasenya = :nova_contrasenya WHERE correu = :correu";
    $stmt = $connexio->prepare($sql);
    
    $stmt->bindParam(':nova_contrasenya', $nova_hashed);
    $stmt->bindParam(':correu', $correu);

    return $stmt->execute();
}

// Funció per actualitzar el nom d'un usuari a la base de dades
function actualitzarNomUsuari($correu, $nouNom) {
    global $connexio;

    $sql = "UPDATE usuaris SET nom = :nou_nom WHERE correu = :correu";
    $stmt = $connexio->prepare($sql);
    
    $stmt->bindParam(':nou_nom', $nouNom);
    $stmt->bindParam(':correu', $correu);

    return $stmt->execute();
}

// Funció per actualitzar la foto d'un usuari a la base de dades
function actualitzarFotoUsuari($correu, $rutaFoto) {
    global $connexio;

    $sql = "UPDATE usuaris SET foto = :ruta_foto WHERE correu = :correu";
    $stmt = $connexio->prepare($sql);
    
    $stmt->bindParam(':ruta_foto', $rutaFoto);
    $stmt->bindParam(':correu', $correu);

    return $stmt->execute();
}

// Funció per obtenir tots els usuaris de la base de dades agafant el correu com a clau i el nom
function obtenirUsuaris() {
    global $connexio;
    
    $sql = "SELECT correu, nom FROM usuaris";
    $stmt = $connexio->prepare($sql);
    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Funció per eliminar un usuari de la base de dades
function eliminarUsuari($correu) {
    global $connexio;
    
    $sql = "DELETE FROM usuaris WHERE correu = :correu";
    $stmt = $connexio->prepare($sql);
    $stmt->bindParam(':correu', $correu);
    
    return $stmt->execute();
}

// Funció per guardar el token de recuperació de contrasenya en la base de dades
function guardarToken($correu, $token) {
    global $connexio;

    $sql = "UPDATE usuaris SET tokenPassword = :token WHERE correu = :correu";
    $stmt = $connexio->prepare($sql);
    
    $stmt->bindParam(':correu', $correu);
    $stmt->bindParam(':token', $token);
   
    $stmt->execute();
}

//Enviar correu
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../lib/PHPMailer-master/src/PHPMailer.php';
require_once __DIR__ . '/../lib/PHPMailer-master/src/SMTP.php';
require_once __DIR__ . '/../lib/PHPMailer-master/src/Exception.php';

function enviarCorreuRecuperacio($correu, $token) {
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host = SMTP_HOST;
        $mail->SMTPAuth = true;
        $mail->Username = SMTP_USER; 
        $mail->Password = SMTP_PASS; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = SMTP_PORT;

        // Configuració del correu
        $mail->setFrom(SMTP_USER, 'Nom del projecte');
        $mail->addAddress($correu); // Direcció del destinatari

        // Contingut del correu
        $mail->isHTML(true);
        $mail->Subject = 'Recuperació de contrasenya';
        $body = file_get_contents(__DIR__ . '/../Vista/login_Token/vistaCorreu.html');
        $body = str_replace('$token', $token, $body);
        $mail->Body = $body;
        $mail->AltBody = "Has sol·licitat recuperar la teva contrasenya. Utilitza aquest enllaç: http://markalvarez.cat/inici?token=$token";

        $mail->send(); // Enviar el correu
        return true;
    } catch (Exception $e) {
        error_log("Error al enviar el correu: {$mail->ErrorInfo}");
        return false;
    }
}

// Funció per trobar l'usuari segons el token
function verificarToken($token) {
    global $connexio;
    
    $sql = "SELECT correu FROM usuaris WHERE tokenPassword = :token";
    $stmt = $connexio->prepare($sql);
    $stmt->bindParam(':token', $token);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    return $result ? $result['correu'] : false;
}

// Funció per eliminar el token de l'usuari
function eliminarToken($correu, $token) {
    global $connexio;
    
    $sql = "UPDATE usuaris SET tokenPassword = NULL, tokenPasswordTime = NULL WHERE correu = :correu AND tokenPassword = :token";
    $stmt = $connexio->prepare($sql);
    $stmt->bindParam(':correu', $correu);
    $stmt->bindParam(':token', $token);
    $stmt->execute();
}

// Funció per agafar el temps de creació del token
function obtenirTempsToken($token) {
    global $connexio;
    
    $sql = "SELECT tokenPasswordTime FROM usuaris WHERE tokenPassword = :token";
    $stmt = $connexio->prepare($sql);
    $stmt->bindParam(':token', $token);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    return $result ? $result['tokenPasswordTime'] : false;
}

// Funció per fer insert desde HybridAuth
function insertUsuariHybrid($nom, $correu, $foto, $provider) {
    global $connexio;
    
        $sql = 'INSERT INTO usuaris (nom, correu, foto, hybridAuth) VALUES (:nom, :correu, :foto, :hybridAuth)';
        $stmt = $connexio->prepare($sql);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':correu', $correu);
        $stmt->bindParam(':foto', $foto);
        $stmt->bindParam(':hybridAuth', $provider);
        $stmt->execute();
    } 
?>
