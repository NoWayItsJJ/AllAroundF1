$(document).ready(function() {
    $('#confirmEmail').click(function(e) {
        e.preventDefault();
        var email = $('#email').val();

        $.ajax({
            type: 'POST',
            url: '../php/access/login-function.php',
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
                    $('label[for="email"]').addClass("invalid");
                    $('#emailError').text("We don't have an account with that email address.");
                    $('#emailErrorIcon').show();
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error:', textStatus, errorThrown);
                console.error('Response:', jqXHR.responseText);
            }
        });
    });

    document.querySelector('#email').addEventListener('keyup', function(e) {
        if (e.key !== 'Enter' && this.value.trim() !== '') {
            this.classList.remove('invalid');
            $('label[for="email"]').removeClass("invalid");
            $('#emailError').text("");
            $('#emailErrorIcon').hide();
        }
    });

    $('#confirmPassword').click(function (e) {
        e.preventDefault();
        var email = $('#email').val();
        var password = $('#password').val();

        $.ajax({
            type: 'POST',
            url: '../php/access/login-function.php',
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
                    $('#password').addClass("invalid");
                    $('label[for="password"]').addClass("invalid");
                    $('#passwordError').text("Password not correct.");
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error:', textStatus, errorThrown);
                console.error('Response:', jqXHR.responseText);
            }
        });
    });

    document.querySelector('#password').addEventListener('keyup', function(e) {
        if (e.key !== 'Enter' && this.value.trim() !== '') {
            this.classList.remove('invalid');
            $('label[for="password"]').removeClass("invalid");
            $('#passwordError').text("");
        }
    });

    $('.bi-eye-slash').click(function() {
        var passwordInput = $('#password');
        var passwordType = passwordInput.attr('type');

        if (passwordType === 'password') {
            passwordInput.attr('type', 'text');
            $(this).removeClass('bi-eye-slash').addClass('bi-eye');
        } else {
            passwordInput.attr('type', 'password');
            $(this).removeClass('bi-eye').addClass('bi-eye-slash');
        }
    });
});