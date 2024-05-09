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
								<h3>Emploeey Info</h3>
								<div>
									<input type="file" name="image" placeholder="Image">
									<input type="text" name="name" placeholder="First Name">
									<input type="text" name="surname" placeholder="Last Name">
								</div>
								<input type="text" name="date-birth" placeholder="Date of birth">
								<input type="text" name="nationality" placeholder="Nationality">
								<input type="text" name="email" placeholder="Email">
								<input type="text" name="specialization" placeholder="Specialization">
							</div>
							<div class="form-col">
								<h3>Emploeey Contract</h3>
								<input type="text" name="role" placeholder="Position">
								<input type="text" name="salary" placeholder="Salary">
								<input type="text" name="contract-end" placeholder="Contract end">
								<input type="text" name="bonus" placeholder="Bonus">
							</div>
						</div>
						<div class="form-buttons">
							<input type="reset" value="Reset">
							<input type="submit" value="Invia">
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
								<h3>Emploeey Info</h3>
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
		$('#' +formType).css('display', 'block');
		
		$('#screen-overlay').addClass('open-overlay');
	});

    $('.bi-x').click(function() {
        $('#screen-overlay').removeClass('open-overlay');
    });
});

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
