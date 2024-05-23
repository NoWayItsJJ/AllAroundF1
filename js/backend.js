function ucfirst(string) {
	return string.charAt(0).toUpperCase() + string.slice(1);
}

function currentSlide(slideId) {
    // Nascondi tutte le slide
    var slides = document.getElementsByClassName('slide');
    for (var i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";  
    }

    // Rimuovi la classe "active" da tutti i puntini
    var dots = document.getElementsByClassName("dot");
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }

    // Mostra la slide corrente e rendi il puntino corrispondente attivo
    document.getElementById(slideId).style.display = "flex";  
    event.target.className += " active";
}

$(document).ready(function() {
    $.ajax({
        type: 'POST',
        url: "../php/backend-function.php",
        data: { action: 'getBalance' },
        dataType: 'json',
        success: function(response) {
            $('#balance').text(response.balance + ' €');
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error("Error:", textStatus, errorThrown);
            console.error("Response:", jqXHR.responseText);
        },
    });

    $.ajax({
        type: 'POST',
        url: "../php/backend-function.php",
        data: { action: 'getIncome' },
        dataType: 'json',
        success: function(response) {
            $('#income').text(response.income-70000000 + ' €');
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error("Error:", textStatus, errorThrown);
            console.error("Response:", jqXHR.responseText);
        },
    });

    $.ajax({
        type: 'POST',
        url: "../php/backend-function.php",
        data: { action: 'getLastTransaction' },
        dataType: 'json',
        success: function(response) {
            $('#lastTransaction').text(response.lastTransaction + ' €');
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error("Error:", textStatus, errorThrown);
            console.error("Response:", jqXHR.responseText);
        },
    });

    $.ajax({
        type: 'POST',
        url: "../php/backend-function.php",
        data: { action: 'getStaffNumbers' },
        dataType: 'json',
        success: function(response) {
            $('#nstaff-ingegneri').text(response.engineers);
            $('#nstaff-marketing').text(response.marketing);
            $('#nstaff-admin').text(response.admins);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error("Error:", textStatus, errorThrown);
            console.error("Response:", jqXHR.responseText);
        },
    });

    $.ajax({
        type: 'POST',
        url: "../php/backend-function.php",
        data: { idRuolo : 2, action: 'getStaffList' },
        dataType: 'json',
        success: function(response) {
            $("#staffList").empty();
            console.log(response.staff.length);
            for (let i = 0; i < response.staff.length; i++) {
                $("#staffList").append(`<div class="line"></div>
                                <div class="table-row">
                                    <i class="fa-regular fa-user-helmet-safety"></i>
                                    <p>` + ucfirst(response.staff[i].nome) + " " + ucfirst(response.staff[i].cognome) + `</p>
                                    <p>` + ucfirst(response.staff[i].nome_ruolo) + `</p>
                                </div>`);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error("Error:", textStatus, errorThrown);
            console.error("Response:", jqXHR.responseText);
        },
    });

    $('.filter').on("click", function() {
        $('.filter').removeClass('active');
        $(this).addClass('active');
        var idRuolo = $(this).data('id');
        $.ajax({
            type: 'POST',
            url: "../php/backend-function.php",
            data: { idRuolo : idRuolo, action: 'getStaffList' },
            dataType: 'json',
            success: function(response) {
                $("#staffList").empty();
                console.log(response);
                for (let i = 0; i < response.staff.length; i++) {
                    var icon;
                    switch (idRuolo) {
                        case 2:
                        case 3:
                            icon = 'fa-user-helmet-safety';
                            break;
                        case 7:
                            icon = 'fa-bullhorn';
                            break;
                        case 4:
                            icon = 'fa-user-tie-hair';
                            break;
                    }
                    $("#staffList").append(`<div class="line"></div>
                                    <div class="table-row">
                                        <i class="fa-regular ` + icon + `"></i>
                                        <p>` + ucfirst(response.staff[i].nome) + " " + ucfirst(response.staff[i].cognome) + `</p>
                                        <p>` + ucfirst(response.staff[i].nome_ruolo) + `</p>
                                    </div>`);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error("Error:", textStatus, errorThrown);
                console.error("Response:", jqXHR.responseText);
            },
        }); 
    });
});
