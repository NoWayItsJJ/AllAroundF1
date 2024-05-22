<?php
include __DIR__ . '/../security.php';
include __DIR__ . '/../db.php';

$searchTerm = isset($_POST['search']) ? $_POST['search'] : '';
$roleId = isset($_POST['fk_id_ruolo']) ? $_POST['fk_id_ruolo'] : '';

$sql = "SELECT id_utente, nome, cognome, email, img, nome_ruolo, stipendio, data_fine, specializzazione, occupato
        FROM utenti u
        JOIN ruoli r ON u.fk_id_ruolo = r.id_ruolo
        JOIN contratti c ON c.fk_id_utente = u.id_utente
        WHERE id_utente IS NOT NULL AND id_utente != ".$_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $roleId != '') {

    if ($roleId == 'all') {
        $sql .= " AND u.fk_id_ruolo != 5";
    } else if ($roleId == '2') {
        $sql .= " AND u.fk_id_ruolo IN (2, 3)";
    } else {
        $sql .= " AND u.fk_id_ruolo = $roleId";
    }
} else {
    $sql .= " AND u.fk_id_ruolo != 5";
}

if ($searchTerm != '') {
    $searchTerm = $conn->real_escape_string($searchTerm);
    $sql .= " AND (nome LIKE '{$searchTerm}%' OR cognome LIKE '{$searchTerm}%' OR email LIKE '{$searchTerm}%' OR nome_ruolo LIKE '%{$searchTerm}%')";
}

if($roleId == '2')
{
    $sql .= " ORDER BY u.fk_id_ruolo";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data_fine = new DateTime($row['data_fine']);
        $status = ($row['occupato'] == 0)? "Available" : "Busy";

        echo '<div class="staff-list-row">
                <span class="img-name" data-id="' . $row["id_utente"] . '">
                    <img src="../img/utenti/' . $row['img'] . '" alt="">
                    <p><strong>' . ucfirst($row['nome']) . ' ' . ucfirst($row['cognome']) . '</strong></p>
                </span>
                <span><p>' . $row['email'] . '</p></span>
                <span><p>' . ucfirst($row['nome_ruolo']) . '</p></span>
                <span><p>' . $row['specializzazione'] . '</p></span>
                <span><p>' . $status .'</p></span>
                <span><p>' . $row['stipendio'] . '</p></span>
                <span><p>' . $data_fine->format('d-m-Y') . '</p></span>
              </div>';
    }
} else {
    echo "<div class='no-result'>
            <p>No results found</p>
          </div>";
}

$conn->close();
?>