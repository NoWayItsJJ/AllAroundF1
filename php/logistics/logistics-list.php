<?php
include __DIR__ . '/../security.php';
include __DIR__ . '/../db.php';

$searchTerm = isset($_POST['search']) ? $_POST['search'] : '';
$itemType = isset($_POST['tipo']) ? $_POST['tipo'] : '';

$firstSql = "SELECT * FROM logistica WHERE id_spostamento IS NOT NULL";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $itemType != '') {

    if ($itemType == 'componente') {
        $firstSql .= " AND tipo = 'componente'";
    } else if ($itemType == 'dipendente') {
        $firstSql .= " AND tipo = 'dipendente'";
    } else if($itemType == 'articolo'){
        $firstSql .= " AND tipo = 'articolo'";
    }
}

if ($searchTerm != '') {
    $searchTerm = $conn->real_escape_string($searchTerm);
    $firstSql .= " AND (partenza LIKE '{$searchTerm}%' OR destinazione LIKE '{$searchTerm}%')";
}

$firstResult = $conn->query($firstSql);
if ($firstResult->num_rows > 0) {
while($firstRow = $firstResult->fetch_assoc()) {
    $itemDetails = '';
    switch($firstRow['mezzo_trasporto']){
        case 'airplane':
            $icon = '<i class="fa-regular fa-plane fa-rotate-by" style="--fa-rotate-angle: -45deg;""></i>';
            break;
        case 'truck':
            $icon = '<i class="fa-regular fa-truck-container"></i>';
            break;
        case 'car':
            $icon = '<i class="fa-regular fa-car-side"></i>';//da rivedere
            break;
        case 'ship':
            $icon = '<i class="fa-regular fa-ship"></i>';//da cambiare
            break;
        case 'bus':
            $icon = '<i class="fa-regular fa-bus-simple"></i>';//da rivedere
            break;
        default:
            $icon = '<i class="fa-regular fa-car-side"></i>';
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
    if($data_partenza > new DateTime())
        $status = "Pending";
    else if($data_arrivo > new DateTime())
        $status = "In progress";
    else
        $status = "Completed";

    echo '<div class="staff-list-row">
                <span data-id="' . $firstRow["id_spostamento"] . '">'. $icon .'</i></span>
                <span><p>' . $itemDetails . '</p></span>
                <span><p>' . ucfirst($firstRow['partenza']) . '</p></span>
                <span><p>' . ucfirst($firstRow['destinazione']) . '</p></span>
                <span><p>' . $data_partenza->format("d-m-Y G:i") . '</p></span>
                <span><p>' . $data_arrivo->format("d-m-Y G:i") . '</p></span>
                <span><p>' . $status . '</p></span>
              </div>';
}
} else {
    echo "<div class='no-result'>
            <p>No results found</p>
          </div>";
}

$conn->close();
?>