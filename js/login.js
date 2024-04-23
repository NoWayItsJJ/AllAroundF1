$(document).ready(function() {
    $('#confirmEmail').click(function(e) {
        e.preventDefault();
        var email = $('#email').val();

        $.ajax({
            type: 'POST',
            url: '../php/login-function.php',
            data: { 
                email: email, 
                action: 'checkEmail' 
            },
            dataType: 'json',
            success: function (response) {
                try {
                    if (response.emailExists) {
                        $('#email').prop('readonly', true);
                        $('#password').css('display', 'block');
                        $('#confirmEmail').css('display', 'none');
                        $('#confirmPassword').css('display', 'block');
                    } else {
                        $('#email').css('border-color', 'red');
                    }
                } catch (e) {
                    console.error('Invalid JSON:', response);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error:', textStatus, errorThrown);
                console.error('Response:', jqXHR.responseText);
            }
        });
    });

    $('#confirmPassword').click(function (e) {
        e.preventDefault();
        var email = $('#email').val();
        var password = $('#password').val();

        $.ajax({
            type: 'POST',
            url: '../php/login-function.php',
            data: { 
                email: email, 
                password: password, 
                action: 'checkPassword' 
            },
            dataType: 'json',
            success: function(response) {
                if (response.passwordCorrect) {
                    // Redirect in base alla tipologia di utente
                    window.location.href = 'home.html';
                } else {
                    $('#password').css('border-color', 'red');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error:', textStatus, errorThrown);
                console.error('Response:', jqXHR.responseText);
            }
        });
    });
});