<?php 
    include __DIR__ . '/../security.php';
    include __DIR__ . '/../db.php';

    if(isset($_POST['name']))
    {
        $name = $_POST['name'];
        $id = $_SESSION['user_id'];

        $sql = "UPDATE utenti SET nome = '$name' WHERE id_utente = $id";
        $conn->query($sql);
    }
    else if(isset($_POST['surname']))
    {
        $surname = $_POST['surname'];
        $id = $_SESSION['user_id'];

        $sql = "UPDATE utenti SET cognome = '$surname' WHERE id_utente = $id";
        $conn->query($sql);
    }
    else if(isset($_POST['email']))
    {
        $email = $_POST['email'];
        $id = $_SESSION['user_id'];

        $sql = "UPDATE utenti SET email = '$email' WHERE id_utente = $id";
        $conn->query($sql);
    }
    else if(isset($_POST['address']))
    {
        $address = $_POST['address'];
        $id = $_SESSION['user_id'];

        $sql = "UPDATE utenti SET indirizzo = '$address' WHERE id_utente = $id";
        $conn->query($sql);
    }
    else if(isset($_POST['password']))
    {
        $password = $_POST['password'];
        $confrimPassword = $_POST['confirm'];
        $id = $_SESSION['user_id'];
        if($password == $confrimPassword)
        {
            $hashedPassword = md5($password);

            $sql = "UPDATE utenti SET password = '$hashedPassword' WHERE id_utente = $id";
            $conn->query($sql);
        }
    }
    else if(isset($_FILES['image']))
    {
        $file = $_FILES['image'];

        $originalFileName = $file['name'];
        $userID = $_SESSION['user_id']; 

        $newFileName = $userID . '_' . $originalFileName;

        $uploadDir = '../img/utenti/';

        $sql = "SELECT img FROM utenti WHERE id_utente = $userID";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $currentImage = $row['img'];

            if (file_exists($uploadDir . $currentImage)) {
                unlink($uploadDir . $currentImage);
            }
        }

        if (move_uploaded_file($file['tmp_name'], $uploadDir . $newFileName)) {
            $sql = "UPDATE utenti SET img = '$newFileName' WHERE id_utente = $userID";
            if ($conn->query($sql) === TRUE) {
                header('Location: ../account-backend.php');
            } else {
                echo "Error updating profile image: " . $conn->error;
            }
        } else {
            echo "Si è verificato un errore durante il caricamento del file.";
        }
    }

    header('Location: ../account-backend.php');
?>