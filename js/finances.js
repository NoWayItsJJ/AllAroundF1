$(document).ready(function () {
	var toUpdate = false;

	$(document).on("click", ".staff-list-row", function (e) {
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
					var birthDate = new Date(response.details.data_nascita);
					var currentDate = new Date();
					var age = currentDate.getFullYear() - birthDate.getFullYear();
					var m = currentDate.getMonth() - birthDate.getMonth();
					if (
						m < 0 ||
						(m === 0 && currentDate.getDate() < birthDate.getDate())
					) {
						age--;
					}

					$("#detailsBlock").css("display", "");
					$("#userId").val(staffId);
					$("#roleId").val(response.details.fk_id_ruolo);
					$("#userImage").attr("src", "../img/utenti/" + response.details.img);
					$("#userName")
						.empty()
						.append(
							" <strong>" +
								ucfirst(response.details.nome) +
								" " +
								ucfirst(response.details.cognome) +
								"</strong>"
						);
					$("#userRole")
						.empty()
						.append(" <strong>" + ucfirst(response.details.nome_ruolo) + "</strong>");
					$("#displayAge")
						.empty()
						.append(" <strong>" + age + "</strong>");
					$("#displayNationality")
						.empty()
						.append(
							" <strong>" + ucfirst(response.details.nome_nazionalita) + "</strong>"
						);
					$("#displayEmail")
						.empty()
						.append(" <strong>" + response.details.email + "</strong>");
					$("#displaySpecialization")
						.empty()
						.append(
							" <strong>" + ucfirst(response.details.specializzazione) + "</strong>"
						);
					$("#displaySalary")
						.empty()
						.append(" <strong>" + response.contract.stipendio + "</strong>");
					$("#displayEnd")
						.empty()
						.append(" <strong>" + response.contract.data_fine + "</strong>");
					$("#displayBonus")
						.empty()
						.append(" <strong>" + response.contract.bonus + "</strong>");
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

	$(document).on("click", ".statistic", function () {
		var search = $("#search").val();
		var transaction = $(this).data("transaction-name");

		$(".statistic-icon").each(function () {
			$(this).removeClass("active");
		});

		$(this)
			.find(".statistic-icon")
			.each(function () {
				$(this).addClass("active");
			});

		$.ajax({
			url: "finances-list.php",
			type: "POST",
			data: { search: search, tipo: transaction },
			success: function (response) {
				$("#list-result").html(response);
			},
		});
	});

	$(document).on("keyup", "#search", function () {
		var search = $(this).val();
		var transaction = $(".statistic-icon.active").parent().data("transaction-name");

		$.ajax({
			url: "finances-list.php",
			type: "POST",
			data: { search: search, tipo: transaction },
			success: function (response) {
				$("#list-result").html(response);
			},
		});
	});

	$(".popup-open").click(function () {
		var id = $("#userId").val();
		var header = $(this).data("header");
		var formType = $(this).data("form-type");
		var formContent;
		switch (formType) {
			case "newForm":
				formContent = `
					<form id="newForm" style="display: none;">
						<div class="form-row">
							<div class="form-col">
								<h3>Employee Info</h3>
								<div>
									<input id="newUserImage" type="file" name="image" placeholder="Image">
									<input id="newUserName" type="text" name="name" placeholder="First Name">
									<input id="newUserSurname" type="text" name="surname" placeholder="Last Name">
								</div>
								<input id="newUserDateOfBirth" type="date" name="date-birth" placeholder="Date of birth">
								<select id="newUserNationality" name="nationality" placeholder="Nationality">
									<option value="" disabled selected>Nationality</option>
								</select>
								<input id="newUserEmail" type="text" name="email" placeholder="Email">
								<input id="newUserSpec" type="text" name="specialization" placeholder="Specialization">
							</div>
							<div class="form-col">
								<h3>Employee Contract</h3>
								<select id="newUserRole" type="text" name="role" placeholder="Position">
									<option value="" disabled selected>Position</option>
								</select>
								<input id="newUserSalary" type="text" name="salary" placeholder="Salary">
								<input id="newUserContractEnd" type="date" name="contract-end" placeholder="Contract end">
								<input id="newUserBonus" type="text" name="bonus" placeholder="Bonus">
							</div>
						</div>
						<div class="form-buttons">
							<input type="reset" value="Reset">
							<input id="newUserSubmit" type="button" value="Invia">
						</div>
					</form>
				`;
				break;
			case "fireForm":
				formContent = `
					<form id="fireForm" style="display: none;">
						<div class="form-row">
							<div class="form-col">
								<h3>Employee Info</h3>
								<div>
									<img src="" alt="">
									<p id="currentName"></p>
									<p id="currentSurname"></p>
								</div>
								<div class="form-row"><p id="current-date-birth"></p></div>
								<div class="form-row"><p id="currentNationality"></p></div>
								<div class="form-row"><p id="currentEmail"></p></div>
								<div class="form-row"><p id="currentSpecialization"></p></div>
							</div>
							<div class="form-col">
								<h3>Employee Contract</h3>
								<div class="form-info"><p id="currentRole"></p></div>
								<div class="form-info"><p id="currentSalary"></p></div>
								<div class="form-info"><p id="current-contract-end"></p></div>
								<div class="form-info"><p id="currentBonus"></p></div>
							</div>
						</div>
						<div class="form-buttons">
							<button class="button-primary red-button button-max-width">Cancel</button>
							<input id="fireFormSubmit" class="button-primary green-button button-max-width" type="submit" value="Fire">
						</div>
					</form>
				`;
				break;
			case "renewForm":
				formContent = `
					<form id="renewForm" style="display: none;">
						<div class="form-row">
							<div class="form-col">
								<h3>Employee Info</h3>
								<div>
									<img src="" alt="">
									<p id="currentName"></p>
									<p id="currentSurname"></p>
								</div>
								<div class="form-row"><p id="current-date-birth"></p></div>
								<div class="form-row"><p id="currentNationality"></p></div>
								<div class="form-row"><p id="currentEmail"></p></div>
								<div class="form-row"><p id="currentSpecialization"></p></div>
							</div>
							<div class="form-col">
								<h3>Employee Contract</h3>
								<div class="form-info"><p id="currentRole"></p></div>
								<div class="form-info"><p id="currentSalary"></p></div>
								<div class="form-info"><p id="current-contract-end"></p></div>
								<div class="form-info"><p id="currentBonus"></p></div>
							</div>
						</div>
						<div id="form-more-info" style="display: none;">
							<div class="form-col">
								<h3>New contract</h3>
								<select id="newUserRole" type="text" name="currentRole" placeholder="Position">
								<input id="updatedSalary" type="text" name="salary" placeholder="Salary">
								<input id="updatedEnd" type="date" name="contract-end" placeholder="Contract end">
								<input id="updatedBonus" type="text" name="bonus" placeholder="Bonus">
							</div>
						</div>
						<div class="form-buttons">
							<button class="button-primary red-button button-max-width">Cancel</button>
							<button class="button-outline button-max-width" onclick="showMoreInfo(event)">Change</button>
							<input id="renewFormSubmit" class="button-primary green-button button-max-width" type="submit" value="Renew">
						</div>
					</form>
				`;
				break;
		}

		$(".popup-title").text(header);
		$(".popup-content").html(formContent);

		switch (formType) {
			case "newForm":
				$("#newUserSubmit").click(function (e) {
					e.preventDefault();
					newUser();
				});
				getNationalities();
				getRoles();
				break;
			case "fireForm":
				displayUserDetails(id);
				$("#fireFormSubmit").click(function (e) {
					e.preventDefault();
					fireEmployee(id);
				});
				break;
			case "renewForm":
				getRoles($("#roleId").val());
				displayUserDetails(id);
				$("#renewFormSubmit").click(function (e) {
					e.preventDefault();
					updateContract(toUpdate);
				});
				break;
		}
		$("#" + formType).css("display", "block");

		$("#screen-overlay").addClass("open-overlay");
	});

	$(".bi-x").click(function () {
		$("#screen-overlay").removeClass("open-overlay");
	});
});

function newUser() {
	var image = $("#newUserImage").val();
	var name = $("#newUserName").val();
	var surname = $("#newUserSurname").val();
	var dateOfBirth = $("#newUserDateOfBirth").val();
	var nationality = $("#newUserNationality").val();
	var email = $("#newUserEmail").val();
	var specialization = $("#newUserSpec").val();
	var role = $("#newUserRole").val();
	var salary = $("#newUserSalary").val();
	var contractEnd = $("#newUserContractEnd").val();
	var bonus = $("#newUserBonus").val();

	$.ajax({
		type: "POST",
		url: "../php/staff-function.php",
		data: {
			image: image,
			name: name,
			surname: surname,
			dateOfBirth: dateOfBirth,
			nationality: nationality,
			email: email,
			specialization: specialization,
			role: role,
			salary: salary,
			contractEnd: contractEnd,
			bonus: bonus,
			action: "newUser",
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

function showMoreInfo(event) {
	event.preventDefault();
	toUpdate = true;
	document.querySelector("#form-more-info").style.display = "block";
}

function closePopup() {
	$("#screen-overlay").removeClass("open-overlay");
}

function getNationalities() {
	$.ajax({
		type: "POST",
		url: "../php/staff-function.php",
		data: { action: "getNationalities" },
		dataType: "json",
		success: function (response) {
			response.nationalities.forEach(function (nationality) {
				$("#newUserNationality").append(
					'<option value="' +
						nationality.id_nazionalita +
						'">' +
						ucfirst(nationality.nome_nazionalita) +
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

function getRoles(id_role) {
	$.ajax({
		type: "POST",
		url: "../php/staff-function.php",
		data: { action: "getRoles" },
		dataType: "json",
		success: function (response) {
			response.roles.forEach(function (role) {
				if(role.id_ruolo == id_role){
					$("#newUserRole").append(
						'<option value="' +
							role.id_ruolo +
							'" selected>' +
							ucfirst(role.nome_ruolo) +
							"</option>"
					);
				} else {
					$("#newUserRole").append(
						'<option value="' +
							role.id_ruolo +
							'">' +
							ucfirst(role.nome_ruolo) +
							"</option>"
					);
				}
			});
		},
		error: function (jqXHR, textStatus, errorThrown) {
			console.error("Error:", textStatus, errorThrown);
			console.error("Response:", jqXHR.responseText);
		},
	});
}

function updateContract() {
	var id = $("#userId").val();
	var role = $("select[name='currentRole'").val();
	var salary = $("#updatedSalary").val();
	var oldEnd = $("#current-contract-end").text();
	var contractEnd = $("#updatedEnd").val();
	var bonus = $("#updatedBonus").val();

	var renewEnd = new Date(oldEnd);
	renewEnd.setMonth(renewEnd.getMonth() + 3);

	var dd = String(renewEnd.getDate()).padStart(2, '0');
	var mm = String(renewEnd.getMonth() + 1).padStart(2, '0'); //January is 0!
	var yyyy = renewEnd.getFullYear();

	renewEnd = yyyy + '-' + mm + '-' + dd;

	if(toUpdate)
	{
		$.ajax({
			type: "POST",
			url: "../php/staff-function.php",
			data: {
				id: id,
				role: role,
				salary: salary,
				contractEnd: contractEnd,
				bonus: bonus,
				action: "updateContract",
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
	} else {
		$.ajax({
			type: "POST",
			url: "../php/staff-function.php",
			data: {
				id: id,
				contractEnd: renewEnd,
				action: "renewContract",
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
}

function fireEmployee(id) {
	$.ajax({
		type: "POST",
		url: "../php/staff-function.php",
		data: {
			id: id,
			action: "fireEmployee",
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