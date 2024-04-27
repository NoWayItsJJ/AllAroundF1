<?php
// Connessione al database
require_once('db.php');

if (isset($_POST['action'])) {
    $action = $_POST['action'];

    switch ($action) {
        case 'retrieveEvents':
            retrieveEvents($_POST['data'], $conn);
            break;
        default:
            echo json_encode(array('error' => 'Invalid action'));
            break;
    }
} else {
    echo json_encode(array('error' => 'No action specified'));
}

function retrieveEvents($data, $conn) {
    if (!isset($_POST['data'])) {
        echo json_encode(array('error' => 'No date provided'));
        exit;
    }

    $date = new DateTime($data);
    $date->setTime(0, 0, 0);
    $data = $date->format('Y-m-d H:i:s');

    $stmt = $conn->prepare("SELECT * FROM calendario WHERE DATE(data_evento) = DATE(?)");
    $stmt->bind_param('s', $data);

    $stmt->execute();

    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $date = new DateTime($row['data_evento']);
        $orario = $date->format('H:i');
        $events[] = array(
            'tipologia' => $row['tipologia'],
            'orario' => $orario
        );
    }

    if($result->num_rows > 0){
        echo json_encode(array('retrieveEvents' => true, 'events' => $events));
    } else {
        echo json_encode(array('retrieveEvents' => false));
    }
}
?>