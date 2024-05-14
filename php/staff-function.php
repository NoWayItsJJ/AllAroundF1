<?php
// Connessione al database
require_once('db.php');

if (isset($_POST['action'])) {
    $action = $_POST['action'];

    switch ($action) {
        case 'getDetails':
            getDetails($_POST['id'], $conn);
            break;
        case 'newUser':
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
            
        case 'getNationalities':
            $nationalityStmt = $conn->prepare("SELECT * FROM nazionalita");
            $nationalityStmt->execute();

            $result = $nationalityStmt->get_result();

            while ($row = $result->fetch_assoc()) {
                $nationalities[] = $row;
            }

            echo json_encode(array('getNationality' => true, 'nationalities' => $nationalities));
            break;

        case 'getRoles':
            $roleStmt = $conn->prepare("SELECT * FROM ruoli");
            $roleStmt->execute();

            $result = $roleStmt->get_result();

            while ($row = $result->fetch_assoc()) {
                $roles[] = $row;
            }

            echo json_encode(array('getRoles' => true, 'roles' => $roles));
            break;

        case 'getUserDetails':
            $userStmt = $conn->prepare("SELECT * FROM utenti 
                                        JOIN ruoli ON utenti.fk_id_ruolo = ruoli.id_ruolo
                                        JOIN nazionalita ON utenti.fk_id_nazionalita = nazionalita.id_nazionalita
                                        JOIN contratti ON utenti.id_utente = contratti.fk_id_utente
                                        WHERE id_utente = ?");
            $userStmt->bind_param('i', $_POST['id']);
            $userStmt->execute();
            $result = $userStmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $user = $row;
            }

            echo json_encode(array('getUserDetails' => true, 'user' => $user));
            break;

        case 'updateContract':
            $contractStmt = $conn->prepare("UPDATE contratti SET stipendio = ?, bonus = ?, data_fine = ? WHERE fk_id_utente = ?");
            $contractStmt->bind_param('iisi', $_POST['salary'], $_POST['bonus'], $_POST['contractEnd'], $_POST['id']);
            $contractStmt->execute();

            $roleStmt = $conn->prepare("UPDATE utenti SET fk_id_ruolo = ? WHERE id_utente = ?");
            $roleStmt->bind_param('ii', $_POST['role'], $_POST['id']);
            $roleStmt->execute();

            $getUserName = $conn->prepare("SELECT nome, cognome FROM contratti
                                           JOIN utenti ON contratti.fk_id_utente = utenti.id_utente
                                           WHERE contratti.fk_id_utente = ?");
            $getUserName->bind_param('i', $_POST['id']);
            $getUserName->execute();
            $result = $getUserName->get_result()->fetch_assoc();
            $userName = $result['nome'].' '.$result['cognome'];

            $getContractId = $conn->prepare("SELECT id_contratto FROM contratti WHERE fk_id_utente = ?");
            $getContractId->bind_param('i', $_POST['id']);
            $getContractId->execute();
            $itemId = $getContractId->get_result()->fetch_assoc()['id_contratto'];

            $type = 'uscita';
            $reason = 'contratto';
            $transactionStmt = $conn->prepare("INSERT INTO finanze (tipo, importo, causale, descrizione, fk_id_item) VALUES (?, ?, ?, ?, ?)");
            $transactionStmt->bind_param('sissi', $type, $_POST['salary'], $reason, $userName, $itemId);
            $transactionStmt->execute();

            echo json_encode(array('updateContract' => true));
            break;
        
        case 'renewContract':
            $contractStmt = $conn->prepare("UPDATE contratti SET data_fine = ? WHERE fk_id_utente = ?");
            $contractStmt->bind_param('si', $_POST['contractEnd'], $_POST['id']);
            $contractStmt->execute();

            echo json_encode(array('renewContract' => true));
            break;

        case 'fireEmployee':
            $deleteUser = $conn->prepare("DELETE FROM utenti WHERE id_utente = ?");
            $deleteUser->bind_param('i', $_POST['id']);
            $deleteUser->execute();

            echo json_encode(array('fireEmployee' => true));
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

    $userStmt = $conn->prepare("SELECT * FROM utenti 
                                JOIN ruoli ON utenti.fk_id_ruolo = ruoli.id_ruolo 
                                JOIN nazionalita ON utenti.fk_id_nazionalita = nazionalita.id_nazionalita
                                WHERE id_utente = ?");
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