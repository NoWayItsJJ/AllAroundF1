<?php
// Connessione al database
require_once('db.php');

if (isset($_POST['action'])) {
    $action = $_POST['action'];

    switch ($action) {
        case 'getDetails':
            getDetails($_POST['id'], $conn);
            break;
        default:
            echo json_encode(array('error' => 'Invalid action'));
            break;
    }
} else {
    echo json_encode(array('error' => 'No action specified'));
}

function getDetails($id, $conn) {
    if (!isset($_POST['id'])) {
        echo json_encode(array('error' => 'No id provided'));
        exit;
    }

    $userStmt = $conn->prepare("SELECT * FROM utenti WHERE id_utente = ?");
    $userStmt->bind_param('i', $id);

    $userStmt->execute();

    $userResult = $userStmt->get_result();

    while ($row = $userResult->fetch_assoc()) {
        foreach ($row as $key => $value) {
            $details[$key] = $value;
        }
    }

    $contractStmt = $conn->prepare("SELECT * FROM contratti WHERE fk_id_utente = ?");
    $contractStmt->bind_param('i', $id);

    $contractStmt->execute();

    $result = $contractStmt->get_result();

    while ($row = $result->fetch_assoc()) {
        foreach ($row as $key => $value) {
            $contract[$key] = $value;
        }
    }

    if($result->num_rows > 0){
        echo json_encode(array('getDetails' => true, 'details' => $details, 'contract' => $contract));
    } else {
        echo json_encode(array('getDetails' => false));
    }
}
?>