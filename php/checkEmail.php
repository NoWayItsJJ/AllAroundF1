<?php
// Connessione al database
require_once('db.php');

// Preparazione della query
$stmt = $conn->prepare("SELECT * FROM utenti WHERE email = :email");
$stmt->bind_param(':email', $_POST['email']);

// Esecuzione della query
$stmt->execute();

// Controllo se l'email esiste nel database
if($stmt->num_rows > 0){
    echo "exists";
} else {
    echo "not exists";
}
?>