<?php
include __DIR__ . '/../security.php';
include __DIR__ . '/../db.php';

$searchTerm = isset($_POST['search']) ? $_POST['search'] : '';
$itemType = isset($_POST['item_type']) ? $_POST['item_type'] : '';

$firstSql = "SELECT * FROM logistica";
$firstResult = $conn->query($firstSql);
while($firstRow = $firstResult->fetch_assoc()) {
    $itemDetails = '';
    switch($firstRow['mezzo_trasporto']){
        case 'airplane':
            $icon = 'bi-airplane';
            break;
        case 'car':
            $icon = 'bi-car-front-fill';//da rivedere
            break;
        case 'ship':
            $icon = 'bi-rocket-takeoff';//da cambiare
            break;
        case 'bus':
            $icon = 'bi-bus-front';//da rivedere
            break;
        default:
            $icon = 'bi-truck';
    }
    switch($firstRow["tipo"])
    {
        case "dipendente":
            $secondSql = "SELECT * FROM utenti 
                          JOIN ruoli ON utenti.fk_id_ruolo = ruoli.id_ruolo
                          WHERE id_utente = " . $firstRow["fk_id_item"];
            $secondResult = $conn->query($secondSql);
            $secondRow = $secondResult->fetch_assoc();
            $itemDetails = ucfirst($secondRow['nome']) . " " . ucfirst($secondRow['cognome']) . " (" . $secondRow['nome_ruolo'] . ")";
        break;
        case "componente":
            $secondSql = "SELECT * FROM componenti WHERE id_componente = " . $firstRow["fk_id_item"];
            $secondResult = $conn->query($secondSql);
            $secondRow = $secondResult->fetch_assoc();
            $itemDetails = ucfirst($secondRow['tipologia']) . " v" . $secondRow['versione'];
        break;
        case "articolo":
            $secondSql = "SELECT * FROM articoli WHERE id_articolo = " . $firstRow["fk_id_item"];
            $secondResult = $conn->query($secondSql);
            $secondRow = $secondResult->fetch_assoc();
            $itemDetails = ucfirst($secondRow['tipologia']) . " - " . $secondRow['quantita'] . " pcs";
    }
    $data_partenza = new DateTime($firstRow['data_partenza']);
    $data_arrivo = new DateTime($firstRow['data_arrivo']);

    echo '<div class="staff-list-row">
                <span data-id="' . $firstRow["id_spostamento"] . '"><i class="'. $icon .'"></i></span>
                <span><p>' . $itemDetails . '</p></span>
                <span><p>' . ucfirst($firstRow['partenza']) . '</p></span>
                <span><p>' . ucfirst($firstRow['destinazione']) . '</p></span>
                <span><p>' . $data_partenza->format("d-m-Y G:i") . '</p></span>
                <span><p>' . $data_arrivo->format("d-m-Y G:i") . '</p></span>
              </div>';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $roleId != '') {

    if ($roleId == 'all') {
        $sql .= " AND u.fk_id_ruolo != 5";
    } else if ($roleId == '2') {
        $sql .= " AND u.fk_id_ruolo IN (2, 3)";
    } else {
        $sql .= " AND u.fk_id_ruolo = $roleId";
    }
}

if ($searchTerm != '') {
    $searchTerm = $conn->real_escape_string($searchTerm);
    $sql .= " AND (nome LIKE '{$searchTerm}%' OR cognome LIKE '{$searchTerm}%' OR nome_ruolo LIKE '%{$searchTerm}%')";
}

$conn->close();
?>