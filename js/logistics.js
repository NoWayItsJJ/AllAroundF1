$(document).ready(function () {
	var toUpdate = false;

	$(document).on("click", ".staff-list-row", function (e) {
		e.preventDefault();
		var movedId = $(this).children().first().data("id");

		$.ajax({
			type: "POST",
			url: "../php/logistics/logistics-function.php",
			data: {
				id: movedId,
				action: "getDetails",
			},
			dataType: "json",
			success: function (response) {
                switch(response.details.mezzo_trasporto){
                    case "car":
                        $("#movingIcon").removeClass().addClass("bi-car-front-fill"); //da rivedere
                        break;
					case 'train':
						$("#movingIcon").removeClass().addClass("bi-train");
						break;
                    case "airplane":
                        $("#movingIcon").removeClass().addClass("bi-airplane");
                        break;
                    case "ship":
                        $("#movingIcon").removeClass().addClass("bi-rocket-takeoff"); //da cambiare
                        break;
                    case "truck":
                        $("#movingIcon").removeClass().addClass("bi-truck");
                        break;
                    case "bus":
                        $("#movingIcon").removeClass().addClass("bi-bus-front"); //da rivedere
                        break;
                }

				var itemDetailsKey = [];
				var itemDetails = [];
				for(var key in response.item){
					itemDetailsKey.push(key);
					itemDetails.push(response.item[key]);
				}
				if (response.getDetails) {
					$("#no-result").css("display", "none");
					$("#detailsBlock").css("display", "");
					$("#movingId").val(movedId);
					$("#itemId").val(response.details.fk_id_item);
					$("#displayFrom")
						.empty()
						.append(
							" <strong>" +
								ucfirst(response.details.partenza) +
								"</strong>"
						);
					$("#displayTo")
						.empty()
						.append(" <strong>" + ucfirst(response.details.destinazione) + "</strong>");
					$("#displayDeparture")
						.empty()
						.append(" <strong>" + formatDateTime(response.details.data_partenza) + "</strong>");
					$("#displayArrival")
						.empty()
						.append(
							" <strong>" + formatDateTime(response.details.data_arrivo) + "</strong>"
						);
					$("#contract-info").empty();
					for (let i = 0; i < itemDetails.length; i++) {
						$("#contract-info").append(`
							<div class="contract-info-row">
								<p id="itemName${i}"><strong>${itemDetailsKey[i]}</strong></p>
								<p id="displayItemName${i}">${(typeof itemDetails[i] === 'string') ? ucevery(itemDetails[i]) : itemDetails[i]}</p>
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
		var category = $(this).data("item-type");

		$(".statistic").each(function () {
			$(this).removeClass("active");
		});

		$(this).addClass("active");

		$.ajax({
			url: "../php/logistics/logistics-list.php",
			type: "POST",
			data: { search: search, tipo: category },
			success: function (response) {
				$("#list-result").html(response);
			},
		});
	});

	$(document).on("keyup", "#search", function () {
		var search = $(this).val();
		var transaction = $(".statistic-icon.active").parent().data("transaction-name");

		$.ajax({
			url: "../php/logistics/logistics-list.php",
			type: "POST",
			data: { search: search, tipo: transaction },
			success: function (response) {
				$("#list-result").html(response);
			},
		});
	});

	$(".popup-open").click(function () {
		var id = $("#movingId").val();
		var formContent = `
			<form id="newForm" style="display: none;">
				<div class="form-row">
					<div class="form-col">
						<h3>Shift Info</h3>
						<div>
							<input id="newFromLocation" type="text" placeholder="From">
							<input id="newToLocation" type="text" placeholder="To">
						</div>
						<input id="newDepartureDate" type="date" placeholder="Departure date">
						<input id="newDepartureTime" type="time" placeholder="Departure time">
						<input id="newArrivalDate" type="date" placeholder="Arrival date">
						<input id="newArrivalTime" type="time" placeholder="Arrival date">
						<select id="newTransportMean" type="text" name="transport" placeholder="Transport">
							<option value="" disabled selected>Transport</option>
						</select>
					</div>
					<div class="form-col">
						<h3>Shift subject</h3>
						<select id="newItemCategory" type="text" name="category" placeholder="Category">
							<option value="" disabled selected>Category</option>
						</select>
						<select id="newItem" type="text" name="item" placeholder="Subject">
							<option value="" disabled selected>Subject</option>
						</select>
					</div>
				</div>
				<div class="form-buttons">
					<input type="reset" value="Reset">
					<input id="newShiftSubmit" type="button" value="Invia">
				</div>
			</form>
		`;

		$(".popup-content").html(formContent);
		$("#newShiftSubmit").click(function (e) {
			e.preventDefault();
			newShift();
		});
		getTransportMeans();
		getCategories();
		$("#newItemCategory").change(function () {
			var selectedOption = $(this).val();
			if (selectedOption) {
				getItems(selectedOption);
			}
		});
		
		$("#newForm").css("display", "block");

		$("#screen-overlay").addClass("open-overlay");
	});

	$(".bi-x").click(function () {
		$("#screen-overlay").removeClass("open-overlay");
	});
});

function getTransportMeans() {
	$.ajax({
		type: "POST",
		url: "../php/logistics/logistics-function.php",
		data: { action: "getTransportMeans" },
		dataType: "json",
		success: function (response) {
			response.transportMeans.forEach(function (transport) {
				$("#newTransportMean").append(
					'<option value="' +
						transport +
						'">' +
						ucfirst(transport) +
						"</option>"
				);
			});
		},
		error: function (jqXHR, textStatus, errorThrown) {
			console.error("Error:", textStatus, errorThrown);
			console.error("Response:", jqXHR.responseText);
		},
	});
}

function getCategories() {
	$.ajax({
		type: "POST",
		url: "../php/logistics/logistics-function.php",
		data: { action: "getCategories" },
		dataType: "json",
		success: function (response) {
			response.categories.forEach(function (category) {
				$("#newItemCategory").append(
					'<option value="' +
						category +
						'">' +
						ucfirst(category) +
						"</option>"
				);
			});
		},
		error: function (jqXHR, textStatus, errorThrown) {
			console.error("Error:", textStatus, errorThrown);
			console.error("Response:", jqXHR.responseText);
		},
	});
}

function getItems(category) {
	$.ajax({
		type: "POST",
		url: "../php/logistics/logistics-function.php",
		data: { action: "getItems", category: category },
		dataType: "json",
		success: function (response) {
			$("#newItem").empty();
			response.items.forEach(function (item) {
				$("#newItem").append(
					'<option value="' + item.id + '">' + ucevery(item.name) + "</option>"
				);
			});
		},
		error: function (jqXHR, textStatus, errorThrown) {
			console.error("Error:", textStatus, errorThrown);
			console.error("Response:", jqXHR.responseText);
		},
	});
}

function newShift() {
	var from = $("#newFromLocation").val();
	var to = $("#newToLocation").val();
	var departure = $("#newDepartureDate").val();
	departure += " " + $("#newDepartureTime").val();
	var arrival = $("#newArrivalDate").val();
	arrival += " " + $("#newArrivalTime").val();
	var transport = $("#newTransportMean").val();
	var itemCategory = $("#newItemCategory").val();
	var item = $("#newItem").val();

	$.ajax({
		type: "POST",
		url: "../php/logistics/logistics-function.php",
		data: {
			from: from,
			to: to,
			departure: departure,
			arrival: arrival,
			transport: transport,
			itemCategory: itemCategory,
			item: item,
			action: "newShift",
		},
		dataType: "json",
		success: function () {
			closePopup();
			location.reload();
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

function ucevery(string) {
    return string.replace(/\b\w/g, function (char) {
        return char.toUpperCase();
    }
    );
}
function formatDateTime(datetimeString) {
    const parts = datetimeString.split(/[- :]/);
    const date = new Date(parts[0], parts[1] - 1, parts[2], parts[3], parts[4], parts[5]);

    const day = String(date.getDate()).padStart(2, '0');
    const month = String(date.getMonth() + 1).padStart(2, '0'); //January is 0!
    const year = date.getFullYear();
    const hours = String(date.getHours()).padStart(2, '0');
    const minutes = String(date.getMinutes()).padStart(2, '0');

    return day + '/' + month + '/' + year + ' ' + hours + ':' + minutes;
}

function showMoreInfo(event) {
	event.preventDefault();
	toUpdate = true;
	document.querySelector("#form-more-info").style.display = "block";
}

function closePopup() {
	$("#screen-overlay").removeClass("open-overlay");
}