function toggleForm(formId, iconId) {
	// Seleziona il form e l'icona specifici
	var form = document.getElementById(formId);
	var icon = document.getElementById(iconId);

	// Se il form specifico è già aperto...
	if (form.classList.contains("active")) {
		// Chiudi il form specifico e ruota l'icona specifica nella posizione originale
		form.classList.remove("active");
		icon.classList.remove("rotate");
	} else {
		// Chiudi tutti i form
		var forms = document.querySelectorAll("form");
		forms.forEach(function (form) {
			if (form.classList.contains("active")) {
				form.classList.remove("active");
			}
		});

		// Ruota tutte le icone nella posizione originale
		var icons = document.querySelectorAll(".bi-chevron-right");
		icons.forEach(function (icon) {
			if (icon.classList.contains("rotate")) {
				icon.classList.remove("rotate");
			}
		});

		// Apri il form specifico e ruota l'icona specifica
		form.classList.add("active");
		icon.classList.add("rotate");
	}
}

function clearInput(id) {
	var input = document.getElementById(id);
	input.value = "";
}

function openPopup() {
	var popup = document.getElementById("screen-overlay");
	popup.classList.add("open-overlay");
}

function closePopup() {
	document.getElementById("screen-overlay").classList.remove("open-overlay");
	document.getElementById("file").value = "";
	var preview = document.getElementById("preview");
	var filenameElement = document.getElementById("filename");

	preview.src = "";
	filenameElement.textContent = "";

	preview.style.display = "none";
	filenameElement.style.display = "none";
}

$(document).ready(function () {
	$("#confirmPassword").on("input", function () {
		if ($("#confirmPassword").val() == "") {
			$("#confirmPassword").removeClass("valid invalid");
		} else if ($("#inputPassword").val() != $("#confirmPassword").val()) {
			$("#confirmPassword").removeClass("valid");
			$("#confirmPassword").addClass("invalid");
		} else {
			$("#confirmPassword").removeClass("invalid");
			$("#confirmPassword").addClass("valid");
		}
	});
});

document.getElementById("file").addEventListener("change", function (e) {
	var fileName = e.target.files[0].name;
	var reader = new FileReader();
	reader.onload = function (e) {
		var preview = document.getElementById("preview");
		var filenameElement = document.getElementById("filename");

		preview.src = e.target.result;
		filenameElement.textContent = fileName;

		// Mostra gli elementi
		preview.style.display = "block";
		filenameElement.style.display = "block";
	};
	reader.readAsDataURL(e.target.files[0]);
});
