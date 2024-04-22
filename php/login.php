<?php 
    session_start();
    include_once 'db.php';
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM utenti WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $_SESSION['user'] = $row;
        header('Location: ../index.php');
    }else{
        header('Location: ../login.php');
    }
    $conn->close();
?>

<html>
    <head>
        <title>Login</title>
    </head>
    <body>
        <form action="php/login.php" method="post">
            <input type="email" id="email" name="email" placeholder="Email">
            <button type="submit">Login</button>
        </form>
        <script>
        
            var timeout = null;
            document.getElementById('email').addEventListener('input', function() {
            clearTimeout(timeout);

            var email = this.value;

                timeout = setTimeout(function() {
                    fetch('php/checkEmail.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: 'email=' + encodeURIComponent(email),
                    })
                    .then(response => response.text())
                    .then(data => {
                        if(data === 'exists') {
                            // Se l'email esiste, mostra il campo password
                            var passwordField = document.createElement('input');
                            passwordField.type = 'password';
                            passwordField.name = 'password';
                            passwordField.placeholder = 'Password';
                            document.getElementById('emailForm').appendChild(passwordField);
                        } else {
                            // Altrimenti, mostra un messaggio di errore
                            alert('Email non registrata.');
                        }
                });
                }, 500); // Ritardo di 500 millisecondi
        });
        </script>
    </body>
</html>