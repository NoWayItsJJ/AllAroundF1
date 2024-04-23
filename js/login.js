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
                if (response.emailExists) {
                    $('#email').prop('readonly', true);
                    $('#password').css('display', 'block');
                    $('#confirmEmail').css('display', 'none');
                    $('#confirmPassword').css('display', 'block');
                } else {
                    $('#email').css('border-color', 'red');
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
                    if (response.userType != 5) {
                        window.location.href = './backend.php';
                    } else {
                        window.location.href = '../index.php';
                    }
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