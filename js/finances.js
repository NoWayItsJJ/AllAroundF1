$(document).ready(function () {
	var toUpdate = false;

	$(document).on("click", ".staff-list-row", function (e) {
		e.preventDefault();
		var transactionId = $(this).children().first().data("id");

		$.ajax({
			type: "POST",
			url: "../php/finances/finances-function.php",
			data: {
				id: transactionId,
				action: "getDetails",
			},
			dataType: "json",
			success: function (response) {
				var itemDetailsKey = [];
				var itemDetails = [];
				for(var key in response.item){
					itemDetailsKey.push(key);
					itemDetails.push(response.item[key]);
				}
				if (response.getDetails) {
					$("#no-result").css("display", "none");
					$("#detailsBlock").css("display", "");
					$("#transactionId").val(transactionId);

					$("#icon-transaction").removeClass("fa-regular fa-arrow-trend-down fa-arrow-trend-up");
					if(response.details.tipo === "uscita"){
						$("#icon-transaction").addClass("fa-regular fa-arrow-trend-down");
						$("#value-transaction").empty().append(response.details.importo+" &euro;");
					} else {
						$("#icon-transaction").addClass("fa-regular fa-arrow-trend-up");
						$("#value-transaction").empty().append(response.details.importo+" &euro;");
					}
					$("#itemId").val(response.details.fk_id_item);
					$("#reason")
						.empty()
						.append(ucfirst(response.details.causale));
					$("#displayType")
						.empty()
						.append(ucfirst(response.details.tipo));
					$("#displayAmount")
						.empty()
						.append(response.details.importo+" &euro;");
					$("#displayDescription")
						.empty()
						.append(ucfirst(response.details.descrizione));
					$("#contract-info").empty();
					for (let i = 0; i < itemDetails.length; i++) {
						console.log(typeof itemDetails[i]);
						$("#contract-info").append(`
							<div class="contract-info-row">
								<p id="itemName${i}"><strong>${itemDetailsKey[i]}</strong></p>
								<p id="displayItemName${i}">${(typeof itemDetails[i] === 'string') ? ucfirst(itemDetails[i]) : itemDetails[i]}</p>
							</div>
						`);
					}
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

	$(".statistic").first().addClass("active");

	$(document).on("click", ".statistic", function () {
		var search = $("#search").val();
		var transaction = $(this).data("transaction-name");

		$(".statistic").each(function () {
			$(this).removeClass("active");
		});

		$(this).addClass("active");

		$.ajax({
			url: "../php/finances/finances-list.php",
			type: "POST",
			data: { search: search, tipo: transaction },
			success: function (response) {
				$("#list-result").html(response);
			},
			error: function (jqXHR, textStatus, errorThrown) {
				console.error("Error:", textStatus, errorThrown);
				console.error("Response:", jqXHR.responseText);
			},
		});
	});

	$(document).on("keyup", "#search", function () {
		var search = $(this).val();
		var transaction = $(".statistic.active").parent().data("transaction-name");

		$.ajax({
			url: "../php/finances/finances-list.php",
			type: "POST",
			data: { search: search, tipo: transaction },
			success: function (response) {
				$("#list-result").html(response);
			},
			error: function (jqXHR, textStatus, errorThrown) {
				console.error("Error:", textStatus, errorThrown);
				console.error("Response:", jqXHR.responseText);
			},
		});
	});
});

function displayUserDetails(id_received) {
	toUpdate = false;

	$.ajax({
		type: "POST",
		url: "../php/staff-function.php",
		data: { id: id_received, action: "getUserDetails" },
		dataType: "json",
		success: function (response) {
			console.log(response);
			$("#currentName").append("<strong>" + ucfirst(response.user.nome) + "</strong>");
			$("#currentSurname").append(
				"<strong>" + ucfirst(response.user.cognome) + "</strong>"
			);
			$("#current-date-birth").append(
				"<strong>" + response.user.data_nascita + "</strong>"
			);
			$("#currentNationality").append(
				"<strong>" + ucfirst(response.user.nome_nazionalita) + "</strong>"
			);
			$("#currentEmail").append("<strong>" + response.user.email + "</strong>");
			$("#currentSpecialization").append(
				"<strong>" + ucfirst(response.user.specializzazione) + "</strong>"
			);
			$("#currentRole").append(
				"<strong>" + ucfirst(response.user.nome_ruolo) + "</strong>"
			);
			$("#currentSalary").append(
				"<strong>" + response.user.stipendio + "</strong>"
			);
			$("#current-contract-end").append(
				"<strong>" + response.user.data_fine + "</strong>"
			);
			$("#currentBonus").append("<strong>" + response.user.bonus + "</strong>");
		},
		error: function (jqXHR, textStatus, errorThrown) {
			console.error("Error:", textStatus, errorThrown);
			console.error("Response:", jqXHR.responseText);
		},
	});
}

function ucfirst(string) {
	return string.charAt(0).toUpperCase() + string.slice(1);
}