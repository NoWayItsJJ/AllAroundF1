<?php
// Connessione al database
include __DIR__ . '/../db.php';

if (isset($_POST['action'])) {
    $action = $_POST['action'];

    switch ($action) {
        case 'registerUser':
            registerUser(
                         $_POST['email'],
                         $_POST['password'],
                         $_POST['birthdate'],
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

function registerUser($email, $password, $birthdate, $name, $surname, $address, $city, $cap, $state, $conn) {
    $img = 'default.jpg';
    $target_dir = "../img/utenti/";
    $target_file = basename($_FILES["img"]["name"]);

    // Select file type
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Valid file extensions
    $extensions_arr = array("jpg","jpeg","png","gif");

    // Check extension
    if( in_array($imageFileType,$extensions_arr) ){
        // Upload file
        $changedLocation = move_uploaded_file($_FILES['img']['tmp_name'],$target_dir.$target_file);
        if($changedLocation){
            $target_file = $target_dir . basename($_FILES["img"]["name"]);  // update $target_file with the new location
        }
    }

    $archiviato = 0;
    $fk_id_ruolo = 5;
    $stmt = $conn->prepare("INSERT INTO utenti (nome, cognome, data_nascita, indirizzo, citta, CAP, stato, img, email, password, archiviato, fk_id_ruolo)
     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $hashed_password = md5($password);
    $stmt->bind_param('ssssssssssii', $name, $surname, $birthdate, $address, $city, $cap, $state, $img, $email, $hashed_password, $archiviato, $fk_id_ruolo);

    $stmt->execute();

    // Get the last inserted ID
    $last_id = $conn->insert_id;

    // Rename the uploaded file
    if (isset($_FILES['img'])) {
        $newfilename = $last_id . '_' . $_FILES['img']['name'];
        rename($target_file, $target_dir . $newfilename);
    
        // Aggiorna l'img nel database
        $stmt = $conn->prepare("UPDATE utenti SET img = ? WHERE id_utente = ?");
        $stmt->bind_param('si', $newfilename, $last_id);
        $stmt->execute();
    }

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