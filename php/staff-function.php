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

    $stmt = $conn->prepare("SELECT * FROM utenti WHERE id_utente = ?");
    $stmt->bind_param('i', $id);

    $stmt->execute();

    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $details[] = $row;
    }

    if($result->num_rows > 0){
        echo json_encode(array('getDetails' => true, 'details' => $details));
    } else {
        echo json_encode(array('getDetails' => false));
    }
}
?>