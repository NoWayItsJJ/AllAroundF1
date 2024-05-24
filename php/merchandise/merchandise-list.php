<?php
include __DIR__ . '/../security.php';
include __DIR__ . '/../db.php';

$searchTerm = isset($_POST['search']) ? $_POST['search'] : '';
$articleType = isset($_POST['tipologia']) ? $_POST['tipologia'] : '';

$sql = "SELECT id_articolo, numero_inventario, tipologia, quantita
        FROM articoli
        WHERE id_articolo IS NOT NULL";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $articleType != '') {
    $sql .= " AND tipologia = '$articleType'";
}

if ($searchTerm != '') {
    $searchTerm = $conn->real_escape_string($searchTerm);
    $sql .= " AND (tipologia LIKE '{$searchTerm}%' OR numero_inventario LIKE '{$searchTerm}%' OR quantita LIKE '{$searchTerm}%')";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {

        echo '<div class="staff-list-row">
                <span class="img-name" data-id="' . $row["id_articolo"] . '"><p>' . $row['numero_inventario'] . '</p></span>
                <span><p>' . ucfirst($row['tipologia']) . '</p></span>
                <span><p>' . $row['quantita'] . '</p></span>
              </div>';
    }
} else {
    echo "<div class='no-result'>
            <p>No results found</p>
          </div>";
}

$conn->close();
?>