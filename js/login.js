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
                    $('#card-password').css('display', 'block');
                    $('#card-email').css('display', 'none');
                    document.querySelector('#user-img').src = "../img/utenti/"+response.userImage;
                    document.querySelector('#user-email').innerHTML = response.userEmail;
                }else {
                    $('#email').addClass("invalid");
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error:', textStatus, errorThrown);
                console.error('Response:', jqXHR.responseText);
            }
        });
    });

    document.querySelector('#email').addEventListener('input', function() {
        if (this.value.trim() === '') {
            this.classList.remove('invalid');
        }
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