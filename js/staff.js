$(document).ready(function() {
    $('.staff-list-row').click(function(e) {
        e.preventDefault();
        var staffId = $(this).children().first().data('id');

        $.ajax({
            type: 'POST',
            url: '../php/staff-function.php',
            data: { 
                id: staffId, 
                action: 'getDetails' 
            },
            dataType: 'json',
            success: function (response) {
                if (response.getDetails) {
                    console.log(response.details);
                    $('#details-nome').val(response.details[0].nome);
                    $('#details-cognome').val(response.details[0].cognome);
                    $('#details-email').val(response.details[0].email);
                }
                else {
                    console.log('Error');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error:', textStatus, errorThrown);
                console.error('Response:', jqXHR.responseText);
            }
        });
        
    });
});