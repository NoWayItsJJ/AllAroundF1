<?php
include 'security.php';
include 'db.php';

// Query SQL per ottenere i dati dello staff
$sql = "SELECT id_utente, nome, cognome, img FROM utenti WHERE fk_id_ruolo != 5";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<tr>
                <td>' . $row['first_name'] . '</td>
                <td>' . $row['last_name'] . '</td>
                <td>' . $row['position'] . '</td>
                <td>' . $row['salary'] . '</td>
                <td>' . $row['contract_end'] . '</td>
              </tr>';
    }
} else {
    echo "0 results";
}

$mysqli->close();
?>