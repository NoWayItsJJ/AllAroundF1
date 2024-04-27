<?php

include 'security.php';
include_once 'db.php';

$userID = $_SESSION['user_id'];
$userRole = $_SESSION['user_type'];

$sql = "SELECT * FROM utenti WHERE id_utente = $userID";
$result = $conn->query($sql);

if($result->num_rows > 0) {

    $row = $result->fetch_assoc();
    $userName = $row['nome'];
    $userSurame = $row['cognome'];
    $userEmail = $row['email'];
    $userImage = empty($row['img']) ? 'user-default.jpg' : $row['idutente'].$row['img'];
    $userAddress = $row['indirizzo'];

    $sql2 = "SELECT * FROM ruoli WHERE id_ruolo = $userRole";
    $result = $conn->query($sql2);

    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userRole = $row['nome_ruolo'];
    }
}
