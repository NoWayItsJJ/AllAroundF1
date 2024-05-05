$(document).ready(function () {
	$(".staff-list-row").click(function (e) {
		e.preventDefault();
		var staffId = $(this).children().first().data("id");

		$.ajax({
			type: "POST",
			url: "../php/staff-function.php",
			data: {
				id: staffId,
				action: "getDetails",
			},
			dataType: "json",
			success: function (response) {
				if (response.getDetails) {
					console.log(response.details.img);
					$("#userImage").attr("src", "../img/utenti/" + response.details.img);
					$("#userName").empty().append(" <strong>" + ucfirst(response.details.nome) + " " + ucfirst(response.details.cognome) + "</strong>");
					$("#userRole").empty().append(" <strong>" + response.details.nome_ruolo + "</strong>");
					$("#displayAge").empty().append(" <strong>" + response.details.eta + "</strong>");
					$("#displayNationality").empty().append(
						" <strong>" + response.details.nome_nazionalita + "</strong>"
					);
					$("#displayEmail").empty().append(
						" <strong>" + response.details.email + "</strong>"
					);
					$("#displaySpecialization").empty().append(
						" <strong>" + response.details.specializzazione + "</strong>"
					);
					$("#displaySalary").empty().append(" <strong>" + response.contract.stipendio + "</strong>");
					$("#displayEnd").empty().append(" <strong>" + response.contract.data_fine + "</strong>");
					$("#displayBonus").empty().append(" <strong>" + response.contract.bonus + "</strong>");
				} else {
					console.log("Error");
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
				console.error("Error:", textStatus, errorThrown);
				console.error("Response:", jqXHR.responseText);
			},
		});
	});

	$(".statistic").first().find(".statistic-icon").addClass("active");

	$(".statistic").click(function () {
		var search = $("#search").val();
		var roleId = $(this).data("role-id");

		$(".statistic-icon").each(function () {
			$(this).removeClass("active");
		});

		$(this)
			.find(".statistic-icon")
			.each(function () {
				$(this).addClass("active");
			});

		$.ajax({
			url: "staff-list.php",
			type: "POST",
			data: { search: search, fk_id_ruolo: roleId },
			success: function (response) {
				$("#list-result").html(response);
			},
		});
	});

	$("#search").keyup(function () {
		var search = $(this).val();
		var roleId = $(".statistic-icon.active").parent().data("role-id");

		$.ajax({
			url: "staff-list.php",
			type: "POST",
			data: { search: search, fk_id_ruolo: roleId },
			success: function (response) {
				console.log(response);
				$("#list-result").html(response);
			},
		});
	});
});

function ucfirst(string) {
	return string.charAt(0).toUpperCase() + string.slice(1);
}