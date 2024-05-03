<?php 
    include 'security.php';
    include_once 'db.php';

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
    else if(isset($_POST['image']))
    {
        $image = $_POST['image'];
        $id = $_SESSION['user_id'];

        $sql = "UPDATE utenti SET img = '$image' WHERE id_utente = $id";
        $conn->query($sql);
    }

    header('Location: account-backend.php');
?>