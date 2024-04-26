<?php
// Connessione al database
require_once('db.php');

if (isset($_POST['action'])) {
    $action = $_POST['action'];

    switch ($action) {
        case 'registerUser':
            registerUser($_POST['email'],
                         $_POST['password'],
                         $_POST['name'],
                         $_POST['surname'],
                         $_POST['address'],
                         $_POST['city'],
                         $_POST['cap'],
                         $_POST['state'],
                         $conn);
            break;
        default:
            echo json_encode(array('error' => 'Invalid action'));
            break;
    }
} else {
    echo json_encode(array('error' => 'No action specified'));
}

function registerUser($email, $password, $name, $surname, $address, $city, $cap, $state, $conn) {
    if (!isset($_POST['email'])) {
        echo json_encode(array('error' => 'No email provided'));
        exit;
    }
    if (!isset($_POST['password'])) {
        echo json_encode(array('error' => 'No password provided'));
        exit;
    }
    if (!isset($_POST['name'])) {
        echo json_encode(array('error' => 'No first name provided'));
        exit;
    }
    if (!isset($_POST['surname'])) {
        echo json_encode(array('error' => 'No last name provided'));
        exit;
    }
    if (!isset($_POST['address'])) {
        echo json_encode(array('error' => 'No address provided'));
        exit;
    }
    if (!isset($_POST['city'])) {
        echo json_encode(array('error' => 'No city provided'));
        exit;
    }
    if (!isset($_POST['cap'])) {
        echo json_encode(array('error' => 'No CAP provided'));
        exit;
    }
    if (!isset($_POST['state'])) {
        echo json_encode(array('error' => 'No state provided'));
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO utenti (nome, cognome, indirizzo, citta, CAP, stato, img, email, password, archiviato, fk_id_ruolo)
     VALUES (?, ?, ?, ?, ?, ?, 'default.jpg', ?, ?, 0, 5)");
    $hashed_password = md5($password);
    $stmt->bind_param('ssssisss', $name, $surname, $address, $city, $cap, $state, $email, $hashed_password);

    $stmt->execute();

    $stmt = $conn->prepare("SELECT id_utente, fk_id_ruolo FROM utenti WHERE email = ? AND password = ?");
    $stmt->bind_param('ss', $email, $hashed_password);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        session_start();
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['id_utente'];
        $_SESSION['user_type'] = $row['fk_id_ruolo'];
        echo json_encode(array('SignedIn' => true, 'userType' => $row['fk_id_ruolo']));
    } else {
        echo json_encode(array('SignedIn' => false));
    }
}
?>