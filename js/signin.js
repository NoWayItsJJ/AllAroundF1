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
                    $('#email').addClass("invalid");
                    $('#password').val('');
                    $('#confirmFirstStep').prop('disabled', true);
                }
                else {
                    $('#card-email-password').css('display', 'none');
                    $('#card-more-info').css('display', 'block');
                    document.querySelector('#user-img').src = "../img/utenti/user-default.jpg";
                    document.querySelector('#user-email').innerHTML = email;
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

    document.getElementById('fileInput').addEventListener('change', function(e) {
        var file = e.target.files[0];
        var reader = new FileReader();
        reader.onloadend = function() {
            document.getElementById('user-img').src = reader.result;
        }
        if (file) {
            reader.readAsDataURL(file);
        } else {
            document.getElementById('user-img').src = "";
        }
    });

    $('#confirmSignin').click(function (e) {
        e.preventDefault();
        /*var img = $('#user-img').attr('src');
        console.log(img);*/
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