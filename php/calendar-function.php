<?php
// Connessione al database
require_once('db.php');

if (isset($_POST['action'])) {
    $action = $_POST['action'];

    switch ($action) {
        case 'retrieveEvents':
            retrieveEvents($_POST['day'], $_POST['month'], $_POST['year'], $conn);
            break;
        default:
            echo json_encode(array('error' => 'Invalid action'));
            break;
    }
} else {
    echo json_encode(array('error' => 'No action specified'));
}

function retrieveEvents($day, $month, $year, $conn) {
    if (!isset($_POST['day'])) {
        echo json_encode(array('error' => 'No day provided'));
        exit;
    }
    if (!isset($_POST['month'])) {
        echo json_encode(array('error' => 'No month provided'));
        exit;
    }
    if (!isset($_POST['year'])) {
        echo json_encode(array('error' => 'No year provided'));
        exit;
    }

    $date = $year . '-' . $month . '-' . $day;

    $stmt = $conn->prepare("SELECT * FROM calendario WHERE data_evento = ?");
    $stmt->bind_param('s', $date);

    $stmt->execute();

    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $events[] = $row;
    }

    if($result->num_rows > 0){
        echo json_encode(array('retrieveEvents' => true, 'events' => $events));
    } else {
        echo json_encode(array('retrieveEvents' => false));
    }
}
?>