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
					$("#detailsBlock").css("display", "");
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

	$('.popup-open').click(function() {
		var header = $(this).data('header');
		var formType = $(this).data('form-type');
		var formContent;
		switch(formType) {
			case 'newForm':
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
								<select id="newUserNationality" name="nationality" placeholder="Nationality"></select>
								<input id="newUserEmail" type="text" name="email" placeholder="Email">
								<input id="newUserSpec" type="text" name="specialization" placeholder="Specialization">
							</div>
							<div class="form-col">
								<h3>Employee Contract</h3>
								<select id="newUserRole" type="text" name="role" placeholder="Position"></select>
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
			case 'fireForm':
				formContent = `
					<form id="fireForm" style="display: none;">
						<input type="text" name="name" placeholder="fire">
						<input type="email" name="email" placeholder="Email">
						<input type="submit" value="Invia">
					</form>
				`;
				break;
			case 'renewForm':
				formContent = `
					<form id="renewForm" style="display: none;">
						<div class="form-row">
							<div class="form-col">
								<h3>Employee Info</h3>
								<div>
									<img src="" alt="">
									<p name="name">First Name</p>
									<p name="surname">Last Name</p>
								</div>
								<div class="form-row"><p name="date-birth">Date of birth</p></div>
								<div class="form-row"><p name="nationality">Nationality</p></div>
								<div class="form-row"><p name="email">Email</p></div>
								<div class="form-row"><p name="specialization">Specialization</p></div>
							</div>
							<div class="form-col">
								<h3>Emploeey Contract</h3>
								<div class="form-info"><p name="role">Position</p></div>
								<div class="form-info"><p name="salary">Salary</p></div>
								<div class="form-info"><p name="contract-end">Contract end</p></div>
								<div class="form-info"><p name="bonus">Bonus</p></div>
							</div>
						</div>
						<div id="form-more-info" style="display: none;">
							<div class="form-col">
								<h3>New contract</h3>
								<input type="text" name="role" placeholder="Position">
								<input type="text" name="salary" placeholder="Salary">
								<input type="text" name="contract-end" placeholder="Contract end">
								<input type="text" name="bonus" placeholder="Bonus">
							</div>
						</div>
						<div class="form-buttons">
							<button class="button-primary red-button button-max-width">Cancel</button>
							<button class="button-outline button-max-width" onclick="showMoreInfo(event)">Change</button>
							<input class="button-primary green-button button-max-width" type="submit" value="Renew">
						</div>
					</form>
				`;
				break;
		}

		$('.popup-title').text(header);
		$('.popup-content').html(formContent);
		$('#newUserSubmit').click(function(e) {
			e.preventDefault();
			newUser();
		});

		var nationalities = getNationalities();
		$.each(nationalities, function(index, nationality) {
			console.log(nationalities[index]);
			$('#newUserNationality').append('<option value="' + nationality.id_nazionalita + '">' + nationality.nome_nazionalita + '</option>');
		});

		$('#' +formType).css('display', 'block');
		
		$('#screen-overlay').addClass('open-overlay');
	});

    $('.bi-x').click(function() {
        $('#screen-overlay').removeClass('open-overlay');
    });
});

function newUser() {
	var image = $('#newUserImage').val();
    var name = $('#newUserName').val();
    var surname = $('#newUserSurname').val();
    var dateOfBirth = $('#newUserDateOfBirth').val();
    var nationality = $('#newUserNationality').val();
    var email = $('#newUserEmail').val();
    var specialization = $('#newUserSpec').val();
    var role = $('#newUserRole').val();
	var salary = $('#newUserSalary').val();
	var contractEnd = $('#newUserContractEnd').val();
	var bonus = $('#newUserBonus').val();

    $.ajax({
        type: 'POST',
        url: '../php/staff-function.php',
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
			action: 'newUser' 
		},
		dataType: 'json',
		success: function() {
			closePopup();
		},
		error: function(jqXHR, textStatus, errorThrown) {
			console.error('Error:', textStatus, errorThrown);
			console.error('Response:', jqXHR.responseText);
		}
	});
}

function ucfirst(string) {
	return string.charAt(0).toUpperCase() + string.slice(1);
}

function showMoreInfo(event) {
    event.preventDefault();
    document.querySelector('#form-more-info').style.display = 'block';
}

function closePopup() {
    $('#screen-overlay').removeClass('open-overlay');
}

function getNationalities() {
	$.ajax({
		type: 'POST',
		url: '../php/staff-function.php',
		data: { action: 'getNationalities' },
		dataType: 'json',
		success: function(response) {
			return response.nationalities;
		},
		error: function(jqXHR, textStatus, errorThrown) {
			console.error('Error:', textStatus, errorThrown);
			console.error('Response:', jqXHR.responseText);
		}
	});
}