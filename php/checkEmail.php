<?php
// Connessione al database
require_once('db.php');

// Preparazione della query
$stmt = $db->prepare("SELECT * FROM utenti WHERE email = :email");
$stmt->bindParam(':email', $_POST['email']);

// Esecuzione della query
$stmt->execute();

// Controllo se l'email esiste nel database
if($stmt->rowCount() > 0){
    echo "exists";
} else {
    echo "not exists";
}
?>