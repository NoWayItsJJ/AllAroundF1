<?php

use LDAP\Result;

include __DIR__ . '/../security.php';
include __DIR__ . '/../db.php';

if (isset($_POST['action'])) {
    $action = $_POST['action'];

    switch ($action) {
        case 'getDetails':
            getDetails($_POST['id'], $conn);
            break;
        case 'getCategories':
            $sql = "SELECT COLUMN_TYPE 
            FROM INFORMATION_SCHEMA.COLUMNS 
            WHERE TABLE_NAME = 'logistica' 
            AND COLUMN_NAME = 'tipo'";
    
            $result = mysqli_query($conn, $sql);
    
            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $categories = explode(",", str_replace("'", "", substr($row['COLUMN_TYPE'], 5, (strlen($row['COLUMN_TYPE'])-6))));
            }
            echo json_encode(array('categories' => $categories));
            break;
        case 'getItems':
            $category = $_POST['category'];
            $sql = '';
            switch ($category) {
                case 'componente':
                    $sql = 'SELECT id_componente as id, CONCAT(tipologia, " v", versione) as name FROM componenti';
                    break;
                case 'dipendente':
                    $sql = 'SELECT id_utente as id, CONCAT(nome, " ", cognome) as name FROM utenti';
                    break;
                case 'articolo':
                    $sql = 'SELECT id_articolo as id, CONCAT(numero_inventario, " - " ,tipologia) as name FROM articoli';
                    break;
                default:
                    break;
            }
    
            $result = mysqli_query($conn, $sql);
    
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $items[] = $row;
                }
            }
            echo json_encode(array('items' => $items));
            break;

        case 'getTransportMeans':
            $sql = "SELECT COLUMN_TYPE 
            FROM INFORMATION_SCHEMA.COLUMNS 
            WHERE TABLE_NAME = 'logistica' 
            AND COLUMN_NAME = 'mezzo_trasporto'";
    
            $result = mysqli_query($conn, $sql);
    
            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $transportMeans = explode(",", str_replace("'", "", substr($row['COLUMN_TYPE'], 5, (strlen($row['COLUMN_TYPE'])-6))));
            }
            echo json_encode(array('transportMeans' => $transportMeans));
            break;

        case 'newShift':
            newShift($_POST['from'],
                    $_POST['to'],
                    $_POST['departure'],
                    $_POST['arrival'],
                    $_POST['transport'],
                    $_POST['itemCategory'],
                    $_POST['item'],
                    $conn);
            break;
            
        default:
            echo json_encode(array('error' => 'Invalid action'));
            break;
    }
} else {
    echo json_encode(array('error' => 'No action specified'));
}

function getDetails($movingId, $conn) {
    if (!isset($_POST['id'])) {
        echo json_encode(array('error' => 'No id provided'));
        exit;
    }

    $movingStmt = $conn->prepare("SELECT * FROM logistica
                                       WHERE id_spostamento = ?");
    $movingStmt->bind_param('i', $movingId);

    $movingStmt->execute();

    $movingResult = $movingStmt->get_result();

    while ($row = $movingResult->fetch_assoc()) {
        foreach ($row as $key => $value) {
            $details[$key] = $value;
        }
    }

    switch ($details['tipo']) {
        case 'componente':
            $sql = 'SELECT numero_inventario as "Inventory number", tipologia as "Component", versione as "Version", CONCAT(nome, " ", cognome) as "Builder"
                    FROM componenti c
                    JOIN utenti u ON c.fk_id_utente = u.id_utente
                    WHERE id_componente = ?';
            break;
        case 'dipendente':
            $sql = 'SELECT CONCAT(nome, " ", cognome) as "Employee", nome_ruolo as "Position", nome_nazionalita as "Nationality"
                    FROM utenti u
                    JOIN ruoli r ON u.fk_id_ruolo = r.id_ruolo
                    JOIN nazionalita n ON u.fk_id_nazionalita = n.id_nazionalita
                    WHERE id_utente = ?';
            break;
        case 'articolo':
            $sql = 'SELECT tipologia as "Article", numero_inventario as "Inventory number", quantita as "Quantity"
                    FROM articoli
                    WHERE id_articolo = ?';
            break;
        default:
            break;
    }

    $itemStmt = $conn->prepare($sql);
    $itemStmt->bind_param('i', $details['fk_id_item']);

    $itemStmt->execute();

    $itemResult = $itemStmt->get_result();

    while ($row = $itemResult->fetch_assoc()) {
        foreach ($row as $key => $value) {
            $itemDetails[$key] = $value;
        }
    }

    if($movingResult->num_rows > 0){
        echo json_encode(array('getDetails' => true, 'details' => $details, 'item' => $itemDetails));
    } else {
        echo json_encode(array('getDetails' => false));
    }
}

function newShift($from, $to, $departureDate, $arrivalDate, $transportMean, $itemCategory, $itemId, $conn) {
    if (!isset($_POST['from'])) {
        echo json_encode(array('error' => 'No from location provided'));
        exit;
    }
    if (!isset($_POST['to'])) {
        echo json_encode(array('error' => 'No to location provided'));
        exit;
    }
    if (!isset($_POST['departure'])) {
        echo json_encode(array('error' => 'No departure date provided'));
        exit;
    }
    if (!isset($_POST['arrival'])) {
        echo json_encode(array('error' => 'No arrival date provided'));
        exit;
    }
    if (!isset($_POST['transport'])) {
        echo json_encode(array('error' => 'No transport mean provided'));
        exit;
    }
    if (!isset($_POST['itemCategory'])) {
        echo json_encode(array('error' => 'No item category provided'));
        exit;
    }
    if (!isset($_POST['item'])) {
        echo json_encode(array('error' => 'No item provided'));
        exit;
    }

    $shiftStmt = $conn->prepare("INSERT INTO logistica (partenza, destinazione, mezzo_trasporto, data_partenza, data_arrivo, tipo, fk_id_item) 
                                VALUES (?, ?, ?, ?, ?, ?, ?)");
    $shiftStmt->bind_param('ssssssi', $from, $to, $transportMean, $departureDate, $arrivalDate, $itemCategory, $itemId);
    $shiftStmt->execute();
    
    $checkShift = $conn->prepare("SELECT * FROM logistica WHERE partenza = ? AND destinazione = ? AND mezzo_trasporto = ? AND data_partenza = ? AND data_arrivo = ? AND tipo = ? AND fk_id_item = ?");
    $checkShift->bind_param('ssssssi', $from, $to, $transportMean, $departureDate, $arrivalDate, $itemCategory, $itemId);
    $checkShift->execute();
    $checkShiftResult = $checkShift->get_result();
    $checkShiftRows = $checkShiftResult->num_rows;

    if($checkShiftRows > 0){
        echo json_encode(array('newShift' => true));
    } else {
        echo json_encode(array('newShift' => false));
    }
}
?>