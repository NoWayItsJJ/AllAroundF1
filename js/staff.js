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

    $('.statistic').click(function() {
        var roleId = $(this).data('role-id');

        $('.statistic-icon').each(function() {
            this.style.setProperty('background-color', '');
            this.style.setProperty('color', '');
        });

        $(this).find('.statistic-icon').each(function() {
            this.style.setProperty('background-color', 'var(--tertiary-color)');
            this.style.setProperty('color', 'var(--primary-color)');
        });

        $.ajax({
            url: 'staff-list.php',
            type: 'POST',
            data: { 'fk_id_ruolo': roleId },
            success: function(response) {
                $('#list-result').html(response);
            }
        });
    });

    $('#search').keyup(function() {
        var search = $(this).val();

        $.ajax({
            url: 'staff-list.php',
            type: 'POST',
            data: { 'search': search },
            success: function (response) {
                console.log(response);
                $('#list-result').html(response);
            }
        });
    });
});