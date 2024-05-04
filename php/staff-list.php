<?php
include 'security.php';
include 'db.php';

$searchTerm = isset($_POST['search']) ? $_POST['search'] : '';
$roleId = isset($_POST['fk_id_ruolo']) ? $_POST['fk_id_ruolo'] : '';

$sql = "SELECT id_utente, nome, cognome, img, nome_ruolo, stipendio, data_fine
        FROM utenti u
        JOIN ruoli r ON u.fk_id_ruolo = r.id_ruolo
        JOIN contratti c ON c.fk_id_utente = u.id_utente
        WHERE id_utente IS NOT NULL";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $roleId != '') {

    if ($roleId == 'all') {
        $sql .= " AND u.fk_id_ruolo != 5";
    } else {
        $sql .= " AND u.fk_id_ruolo = $roleId";
    }
} else {
    $sql .= " AND u.fk_id_ruolo != 5";
}

if ($searchTerm != '') {
    $searchTerm = $conn->real_escape_string($searchTerm);
    $sql .= " AND (nome LIKE '{$searchTerm}%' OR cognome LIKE '{$searchTerm}%' OR nome_ruolo LIKE '%{$searchTerm}%')";
}

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