<?php
$servername = "localhost";
$username = "root"; // Sostituisci con il tuo nome utente del database
$password = ""; // Sostituisci con la tua password del database
$dbname = "all_around_f1"; // Sostituisci con il nome del tuo database
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

/*SESSION VARIABLES*/
// user_id: id utente
// user_type: tipologia utente

?>