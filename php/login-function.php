<?php
// Connessione al database
require_once('db.php');

if (isset($_POST['action'])) {
    $action = $_POST['action'];

    switch ($action) {
        case 'checkEmail':
            checkEmail($_POST['email'], $conn);
            break;
        case 'checkPassword':
            checkPassword($_POST['email'], $_POST['password'], $conn);
            break;
        default:
            echo json_encode(array('error' => 'Invalid action'));
            break;
    }
} else {
    echo json_encode(array('error' => 'No action specified'));
}

function checkEmail($email, $conn) {
    if (!isset($_POST['email'])) {
        echo json_encode(array('error' => 'No email provided'));
        exit;
    }

    $stmt = $conn->prepare("SELECT * FROM utenti WHERE email = ?");
    $stmt->bind_param('s', $email);

    $stmt->execute();

    $result = $stmt->get_result();
    if($result->num_rows > 0){
        echo json_encode(array('emailExists' => true));
    } else {
        echo json_encode(array('emailExists' => false));
    }
}

function checkPassword($email, $password, $conn) {
    if (!isset($_POST['email'])) {
        echo json_encode(array('error' => 'No email provided'));
        exit;
    }
    if (!isset($_POST['password'])) {
        echo json_encode(array('error' => 'No password provided'));
        exit;
    }

    $stmt = $conn->prepare("SELECT * FROM utenti WHERE email = ? AND passmd5 = ?");
    $hashed_password = md5($password);
    $stmt->bind_param('ss', $email, $hashed_password);

    $stmt->execute();

    $result = $stmt->get_result();
    if($result->num_rows > 0){
        session_start();
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['id_utente'];
        $_SESSION['user_type'] = $row['tipologia_utente'];
        echo json_encode(array('passwordCorrect' => true));
    } else {
        echo json_encode(array('passwordCorrect' => false));
    }
}
?>