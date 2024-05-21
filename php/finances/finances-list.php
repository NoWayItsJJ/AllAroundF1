<?php
include __DIR__ . '/../security.php';
include __DIR__ . '/../db.php';

$searchTerm = isset($_POST['search']) ? $_POST['search'] : '';
$transactionType = isset($_POST['tipo']) ? $_POST['tipo'] : '';

$sql = "SELECT *
        FROM finanze
        WHERE id_transazione IS NOT NULL";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $transactionType != '') {

    if ($transactionType == 'entrata') {
        $sql .= " AND tipo = 'entrata'";
    } else {
        $sql .= " AND tipo = 'uscita'";
    }
}

if ($searchTerm != '') {
    $searchTerm = $conn->real_escape_string($searchTerm);
    $sql .= " AND (causale LIKE '{$searchTerm}%' OR descrizione LIKE '{$searchTerm}%' OR tipo LIKE '{$searchTerm}%')";
}

$sql .= " ORDER BY id_transazione DESC";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $icon = $row['tipo'] == 'uscita' ? 'bi-arrow-up' : 'bi-arrow-down';
        echo '<div class="staff-list-row">
                <span data-id="' . $row["id_transazione"] . '"><i class="bi '. $icon .'"></i></span>
                <span><p>' . $row['importo'] . '</p></span>
                <span><p>' . $row['causale'] . '</p></span>
                <span><p>' . $row['descrizione'] . '</p></span>
              </div>';
    }
} else {
    echo "<div class='no-result'>
            <p>No results found</p>
          </div>";
}

$conn->close();
?>