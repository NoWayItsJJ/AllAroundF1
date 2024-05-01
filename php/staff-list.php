<?php
include 'security.php';
include 'db.php';

// Query SQL per ottenere i dati dello staff
$sql = "SELECT id_utente, nome, cognome, img, nome_ruolo, stipendio, data_fine
        FROM utenti u
        JOIN ruoli r ON u.fk_id_ruolo = r.id_ruolo
        JOIN contratti c ON c.fk_id_utente = u.id_utente
        WHERE fk_id_ruolo != 5";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<tr class="staff-list-row">
                <td data-id="' . $row["id_utente"] . '"><img src="../img/utenti/' . $row['img'] . '" alt=""></td>
                <td>' . ucfirst($row['nome']) . '</td>
                <td>' . ucfirst($row['cognome']) . '</td>
                <td>' . ucfirst($row['nome_ruolo']) . '</td>
                <td>' . $row['stipendio'] . '</td>
                <td>' . $row['data_fine'] . '</td>
              </tr>';
    }
} else {
    echo "0 results";
}

$conn->close();
?>