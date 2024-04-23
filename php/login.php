<html>
    <head>
        <title>Login</title>
    </head>
    <body>
        <form id="emailForm" action="login.php" method="post">
            <input type="email" id="email" name="email" placeholder="Email">
            <button id="confirmEmail">Avanti</button>
        </form>
        <script>
            document.getElementById("confirmEmail").addEventListener("click", function() {
                echo ("Funziona");
                var email = document.getElementById("email").value;
                if (email == "") {
                    alert("Inserisci un'email valida");
                    return;
                }
                fetch('checkEmail.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'email=' + encodeURIComponent(email),
                })
                .then(response => response.text())
                .then(data => {
                    if(data === 'exists') {
                        document.getElementById('confirmEmail').hidden = true;
                        // Se l'email esiste, mostra il campo password
                        var passwordField = document.createElement('input');
                        passwordField.type = 'password';
                        passwordField.name = 'password';
                        passwordField.placeholder = 'Password';
                        document.getElementById('emailForm').appendChild(passwordField);
                        // Mostra il pulsante di login
                        var loginButton = document.createElement('button');
                        loginButton.type = 'submit';
                        document.getElementById('emailForm').appendChild(loginButton);
                    } else {
                        // Altrimenti, mostra un messaggio di errore
                        alert("Email non registrata");
                    }
                });
            });
        </script>
    </body>
</html>