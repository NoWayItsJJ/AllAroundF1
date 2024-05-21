$(document).ready(function() {
    $('#email').focusout(function() {
        var email = $(this).val();
    
        $.ajax({
            type: 'POST',
            url: '../php/access/login-function.php',
            data: { 
                email: email, 
                action: 'checkEmail' 
            },
            dataType: 'json',
            success: function (response) {
                if (response.emailExists || email == '' || !isEmail(email)) {
                    $('#email').addClass("invalid");
                    $('label[for="email"]').addClass("invalid");
                    if (email == '') {
                        $('#emailError').html("Please enter an email.");
                    } else if (!isEmail(email)) {
                        $('#emailError').html("That's an invalid email.");
                    } else {
                        $('#emailError').html("An account with this email address already exists. <a class=\"link\" href=\"./login.php\">Sign in</a>");
                    }
                    $('#emailErrorIcon').show();
                    $('#emailCorrectIcon').hide();
                } else {
                    $('#email').removeClass("invalid");
                    $('label[for="email"]').removeClass("invalid");
                    $('#emailCorrectIcon').show();
                    $('#emailErrorIcon').hide();
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
            $('#emailCorrectIcon').hide();
        }
    });

    document.querySelector('#password').addEventListener('keyup', function(e) {
        var password = $(this).val();
        var email = $('#email').val();
    
        var hasEightCharacters = password.length >= 8;
        var hasLowerAndUpperCase = /[a-z]/.test(password) && /[A-Z]/.test(password);
        var hasNumberOrSymbol = /\d/.test(password) || /\W/.test(password);
        var doesNotContainEmail = !password.includes(email);

        if (e.key !== 'Enter' && this.value.trim() !== '') {
            this.classList.remove('invalid');
            $('#passwordCriteria').show();
            $('#passwordError').text("");
        }else{
            $('#passwordCriteria').hide();
        }

        $('#passwordCriteria').html(
            'Create a password that:<br>' +
            (hasEightCharacters ? '<span class="text-green"><i class="bi bi-check"></i> contains at least 8 characters</span><br>' : '<span class="text-red"><i class="bi bi-x"></i> contains at least 8 characters</span><br>') +
            (hasLowerAndUpperCase ? '<span class="text-green"><i class="bi bi-check"></i> contains both lower (a-z) and upper case letters (A-Z)</span><br>' : '<span class="text-red"><i class="bi bi-x"></i> contains both lower (a-z) and upper case letters (A-Z)</span><br>') +
            (hasNumberOrSymbol ? '<span class="text-green"><i class="bi bi-check"></i> contains at least one number (0-9) or a symbol</span><br>' : '<span class="text-red"><i class="bi bi-x"></i> contains at least one number (0-9) or a symbol</span><br>') +
            (doesNotContainEmail ? '<span class="text-green"><i class="bi bi-check"></i> does not contain your email address</span><br>' : '<span class="text-red"><i class="bi bi-x"></i> does not contain your email address</span><br>')
        );
    });
    
    $('#confirmFirstStep').click(function(e) {
        e.preventDefault();
        var email = $('#email').val();
        var password = $('#password').val();

        var hasEightCharacters = password.length >= 8;
        var hasLowerAndUpperCase = /[a-z]/.test(password) && /[A-Z]/.test(password);
        var hasNumberOrSymbol = /\d/.test(password) || /\W/.test(password);
        var doesNotContainEmail = !password.includes(email);

        if (!isEmail(email)) {
            $('#email').addClass("invalid");
            $('#emailError').text("Please enter an email.");
            $('#emailErrorIcon').show();
            return;
        }

        if (password === '') {
            $('#password').addClass("invalid");
            $('#passwordError').text("Please enter a password.");
            $('#passwordCriteria').hide();
            return;
        }

        if (!hasEightCharacters || !hasLowerAndUpperCase || !hasNumberOrSymbol || !doesNotContainEmail) {
            $('#password').addClass("invalid");
            $('#passwordError').text("Your password does not meet the criteria.");
            $('#passwordCriteria').show();
            return;
        }

        $('#card-email-password').css('display', 'none');
        $('#card-more-info').css('display', 'block');
        document.querySelector('#user-img').src = "../img/utenti/user-default.jpg";
        document.querySelector('#user-email').innerHTML = email;
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
            document.getElementById('user-img').src = "../img/utenti/user-default.jpg";
        }
    });

    var fields = ['email', 'password', 'name', 'surname', 'address', 'city', 'cap', 'state', 'birthdate'];

    fields.forEach(function(field) {
        $('#' + field).on('input', function() {
            var value = $(this).val();
            if (value !== '') {
                $(this).removeClass('invalid');
                $('label[for=' + field + ']').removeClass('invalid');
            }
        });
    });

    function isCap(value) {
        var capRegex = /^[0-9]{5}$/;
        return capRegex.test(value);
    }

    function isEmail(email) {
        var emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        return emailRegex.test(email);
    }

    function isBirthdate(value) {
        var dateRegex = /^\d{4}-\d{2}-\d{2}$/;
        if (!dateRegex.test(value)) {
            return false;
        }

        var birthdate = new Date(value);
        var today = new Date();

        if (birthdate > today) {
            return false;
        }

        return true;
    }

    $('#confirmSignin').click(function (e) {
        e.preventDefault();
        var fields = ['email', 'password', 'name', 'surname', 'address', 'city', 'cap', 'state', 'birthdate'];
        var allFieldsFilled = true;
        var data = new FormData();

        fields.forEach(function(field) {
            var value = $('#' + field).val();
            if (value === '') {
                $('#' + field).addClass('invalid');
                $('label[for=' + field + ']').addClass('invalid');
                allFieldsFilled = false;
            } else {
                $('#' + field).removeClass('invalid');
                $('label[for=' + field + ']').removeClass('invalid');
            }
            data.append(field, value);
        });

        var fileInput = $('#fileInput')[0];
        if (fileInput.files.length > 0) {
            data.append('img', fileInput.files[0]);
        }

        if (!allFieldsFilled) {
            return;
        }

        data.append('action', 'registerUser');

        $.ajax({
            type: 'POST',
            url: '../php/access/signin-function.php',
            data: data,
            dataType: 'json',
            processData: false,
            contentType: false,
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