$(document).ready(function() {
    $('#confirmFirstStep').click(function(e) {
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
                    $('#email').css('border-color', 'red');
                    $('#password').val('');
                    $('#confirmFirstStep').prop('disabled', true);
                }
                else {
                    $('#firstSigninForm').css('display', 'none');
                    $('#secondSigninForm').css('display', 'block');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error:', textStatus, errorThrown);
                console.error('Response:', jqXHR.responseText);
            }
        });
    });

    $('#email').blur(function() {
        var email = $('#email').val();

        if (email != '') {
            $('#confirmFirstStep').prop('disabled', false);
            $('#email').css('border-color', '');
        }
    });

    $('#confirmSignin').click(function (e) {
        e.preventDefault();
        var email = $('#email').val();
        var password = $('#password').val();
        var name = $('#name').val();
        var surname = $('#surname').val();
        var address = $('#address').val();
        var city = $('#city').val();
        var cap = $('#cap').val();
        var state = $('#state').val();

        $.ajax({
            type: 'POST',
            url: '../php/signin-function.php',
            data: { 
                email: email, 
                password: password, 
                name: name,
                surname: surname,
                address: address,
                city: city,
                cap: cap,
                state: state,
                action: 'registerUser' 
            },
            dataType: 'json',
            success: function(response) {
                if (response.SignedIn) {
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