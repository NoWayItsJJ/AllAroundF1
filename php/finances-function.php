<?php
// Connessione al database
require_once('db.php');

if (isset($_POST['action'])) {
    $action = $_POST['action'];

    switch ($action) {
        case 'getDetails':
            getDetails($_POST['id'], $conn);
            break;
        case 'newTransaction':
            newUser($_POST['image'],
                    $_POST['name'],
                    $_POST['surname'],
                    $_POST['dateOfBirth'],
                    $_POST['nationality'],
                    $_POST['email'],
                    $_POST['specialization'],
                    $_POST['role'],
                    $_POST['salary'],
                    $_POST['contractEnd'],
                    $_POST['bonus'],
                    $conn);
            break;
            
        default:
            echo json_encode(array('error' => 'Invalid action'));
            break;
    }
} else {
    echo json_encode(array('error' => 'No action specified'));
}

function getDetails($transactionId, $conn) {
    if (!isset($_POST['id'])) {
        echo json_encode(array('error' => 'No id provided'));
        exit;
    }

    $transactionStmt = $conn->prepare("SELECT * FROM finanze
                                       WHERE id_transazione = ?");
    $transactionStmt->bind_param('i', $transactionId);

    $transactionStmt->execute();

    $transactionResult = $transactionStmt->get_result();

    while ($row = $transactionResult->fetch_assoc()) {
        foreach ($row as $key => $value) {
            $details[$key] = $value;
        }
    }

    switch ($details['causale']) {
        case 'contratto':
            $sql = 'SELECT nome as "Name", cognome as Surname, nome_ruolo as Position, stipendio as Salary, bonus as Bonus, data_inizio as "Contract start", data_fine as "Contract end"
                    FROM contratti 
                    JOIN utenti ON contratti.fk_id_utente = utenti.id_utente
                    JOIN ruoli ON utenti.fk_id_ruolo = ruoli.id_ruolo
                    WHERE id_contratto = ?';
            break;
        case 'nuovo componente':
            $sql = ' componenti WHERE id_componente = ?';
            break;
        case 'logistica':
            $sql = ' logistica WHERE id_spostamento = ?';
            break;
        case 'sponsor':
            $sql = 'SELECT tipologia as Category, importo as Prize, data_inizio as "Begin date", data_fine as "End date" FROM sponsor WHERE id_sponsor = ?';
            break;
        case 'ordini':
            $sql = ' ordinazioni WHERE id_ordine = ?';
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

    if($transactionResult->num_rows > 0){
        echo json_encode(array('getDetails' => true, 'details' => $details, 'item' => $itemDetails));
    } else {
        echo json_encode(array('getDetails' => false));
    }
}

function newUser($image, $name, $surname, $dateOfBirth, $nationality, $email, $specialization, $role, $salary, $contractEnd, $bonus, $conn) {
    if (!isset($_POST['image'])) {
        echo json_encode(array('error' => 'No image provided'));
        exit;
    }
    if (!isset($_POST['name'])) {
        echo json_encode(array('error' => 'No name provided'));
        exit;
    }
    if (!isset($_POST['surname'])) {
        echo json_encode(array('error' => 'No surname provided'));
        exit;
    }
    if (!isset($_POST['dateOfBirth'])) {
        echo json_encode(array('error' => 'No dateBirth provided'));
        exit;
    }
    if (!isset($_POST['nationality'])) {
        echo json_encode(array('error' => 'No nationality provided'));
        exit;
    }
    if (!isset($_POST['email'])) {
        echo json_encode(array('error' => 'No email provided'));
        exit;
    }
    if (!isset($_POST['specialization'])) {
        echo json_encode(array('error' => 'No spec provided'));
        exit;
    }
    if (!isset($_POST['role'])) {
        echo json_encode(array('error' => 'No role provided'));
        exit;
    }
    if (!isset($_POST['salary'])) {
        echo json_encode(array('error' => 'No salary provided'));
        exit;
    }
    if (!isset($_POST['contractEnd'])) {
        echo json_encode(array('error' => 'No dateContract provided'));
        exit;
    }
    if (!isset($_POST['bonus'])) {
        echo json_encode(array('error' => 'No bonus provided'));
        exit;
    }

    $defaultPassword = 'default';
    $defaultEncryptedPassword = md5($defaultPassword);
    $archived = 0;

    $userStmt = $conn->prepare("INSERT INTO utenti (nome, cognome, data_nascita, img, email, password, archiviato, specializzazione, fk_id_ruolo, fk_id_nazionalita) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $userStmt->bind_param('ssssssisii', $name, $surname, $dateOfBirth, $image, $email, $defaultEncryptedPassword, $archived, $specialization, $role, $nationality);

    $userStmt->execute();

    $getUserId = $conn->prepare("SELECT id_utente FROM utenti WHERE email = ? AND nome = ? AND cognome = ? AND data_nascita = ? AND img = ? AND specializzazione = ? AND fk_id_ruolo = ? AND fk_id_nazionalita = ?");
    $getUserId->bind_param('ssssssii', $email, $name, $surname, $dateOfBirth, $image, $specialization, $role, $nationality);
    $getUserId->execute();
    $checkUserResult = $getUserId->get_result();
    $userSuccess = $checkUserResult->num_rows;
    $userId = $checkUserResult->fetch_assoc()['id_utente'];
    $checkUserResult->free();  // Free the result set

    $contractStmt = $conn->prepare("INSERT INTO contratti (stipendio, bonus, data_fine, fk_id_utente) 
                                    VALUES (?, ?, ?, ?)");
    $contractStmt->bind_param('iisi', $salary, $bonus, $contractEnd, $userId);
    $contractStmt->execute();

    $getContractId = $conn->prepare("SELECT id_contratto FROM contratti WHERE stipendio = ? AND bonus = ? AND data_fine = ? AND fk_id_utente = ?");
    $getContractId->bind_param('iisi', $salary, $bonus, $contractEnd, $userId);
    $getContractId->execute();
    $checkContractResult = $getContractId->get_result();
    $contractSuccess = $checkContractResult->num_rows;
    $checkContractResult->free();  // Free the result set

    if($userSuccess > 0 && $contractSuccess > 0){
        echo json_encode(array('newUser' => true));
    } else {
        echo json_encode(array('newUser' => false));
    }
}
?>