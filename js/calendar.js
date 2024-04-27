var date = new Date();
var months = [
	"January",
	"February",
	"March",
	"April",
	"May",
	"June",
	"July",
	"August",
	"September",
	"October",
	"November",
	"December",
];
var dayNames = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"];
var dayLongNames = [
	"Monday",
	"Tuesday",
	"Wednesday",
	"Thursday",
	"Friday",
	"Saturday",
	"Sunday",
];

window.onload = function () {
	calendar();
	updateDateInfo(new Date());
};

function calendar() {
	var today = new Date();
	var currentDay = today.getDate();
	var daydate = date.getDate();
	var month = date.getMonth();
	var year = date.getFullYear();
	var firstDay = new Date(year, month, 1);
	var startingDay = firstDay.getDay();
	var monthLength = daysInMonth(month, year);
	var monthName = months[month];
	document.getElementById("month").innerHTML = monthName + " " + year;
	var html = "<table class='calendar-content'>";
	html += "<tr class='header-row'>";
	for (var i = 0; i <= 6; i++) {
		html += "<th>";
		html += dayNames[i];
		html += "</th>";
	}
	html += "</tr><tr>";
	var day = 1;
	startingDay = startingDay === 0 ? 7 : startingDay;
	for (var i = 0; i < 9; i++) {
		for (var j = 1; j <= 7; j++) {
			html += "<td>";
			if (day <= monthLength && (i > 0 || j >= startingDay)) {
				var currentDate = new Date(year, month, day);

				if (
					day === currentDay &&
					month === today.getMonth() &&
					year === today.getFullYear()
				) {
					html +=
						"<div class='selected-day' data-date='" +
						currentDate.toISOString() +
						"'>";
				} else if (
					day === daydate &&
					month === date.getMonth() &&
					year === date.getFullYear()
				) {
					html +=
						"<div class='selected-day' data-date='" +
						currentDate.toISOString() +
						"'>";
				} else {
					html += "<div data-date='" + currentDate.toISOString() + "'>";
				}
				html += day;
				day++;
				html += "</div>";
			}
			html += "</td>";
		}
		if (day > monthLength) {
			break;
		} else {
			html += "</tr><tr>";
		}
	}
	html += "</tr></table>";
	document.getElementById("calendar").innerHTML = html;

	setTimeout(function () {
		var dates = document.querySelectorAll(".calendar #calendar td div");

		dates.forEach(function (date) {
			date.addEventListener("click", function () {
				dates.forEach(function (date) {
					date.classList.remove("selected-day");
				});

				this.classList.add("selected-day");
				updateDateInfo(new Date(this.getAttribute("data-date")));
			});
		});
	}, 0);
}

function updateDateInfo(date) {
	var dayName = dayLongNames[date.getDay()];
	var dayNumber = date.getDate();
	var month = months[date.getMonth()];
	var year = date.getFullYear();

	document.getElementById("day").innerHTML = dayName;
	document.getElementById("day-number").innerHTML = dayNumber;
	document.getElementById("day-month").innerHTML = month;
	document.getElementById("day-year").innerHTML = year;

	retrieveEvents(date.toISOString());
}

function prevMonth() {
	var m = date.getMonth();
	var y = date.getFullYear();
	if (m == 0) {
		m = 11;
		y = y - 1;
	} else {
		m = m - 1;
	}
	date.setMonth(m);
	date.setFullYear(y);
	document.getElementById("month").innerHTML = months[m] + " " + y;
	calendar();
}

function nextMonth() {
	var m = date.getMonth();
	var y = date.getFullYear();
	if (m == 11) {
		m = 0;
		y = y + 1;
	} else {
		m = m + 1;
	}
	date.setMonth(m);
	date.setFullYear(y);
	document.getElementById("month").innerHTML = months[m] + " " + y;
	calendar();
}

function nextDay() {
	var d = date.getDate();
	var m = date.getMonth();
	var y = date.getFullYear();
	var mlength = daysInMonth(m, y);
	if (d == mlength) {
		d = 1;
		if (m == 11) {
			m = 0;
			y = y + 1;
		} else {
			m = m + 1;
		}
	} else {
		d = d + 1;
	}
	date.setFullYear(y);
	date.setMonth(m);
	date.setDate(d);
	updateDateInfo(date);

	var currentDay = document.querySelector(".selected-day");

	if (currentDay) {
		currentDay.classList.remove("selected-day");
	}

	var nextTd;

	if (currentDay) {
		var currentTd = currentDay.parentNode;
		nextTd = currentTd.nextElementSibling;

		if (!nextTd) {
			var currentTr = currentTd.parentNode;
			var nextTr = currentTr.nextElementSibling;

			if (nextTr) {
				nextTd = nextTr.firstElementChild;
			} else {
				calendar();
			}
		}

		if (nextTd) {
			var nextDiv = nextTd.querySelector("div");
			if (nextDiv) {
				nextDiv.classList.add("selected-day");
			}
		}
	}
}

function prevDay() {
	var d = date.getDate();
	var m = date.getMonth();
	var y = date.getFullYear();
	if (d == 1) {
		if (m == 0) {
			m = 11;
			y = y - 1;
		} else {
			m = m - 1;
		}
		d = daysInMonth(m, y);
	} else {
		d = d - 1;
	}
	date.setFullYear(y);
	date.setMonth(m);
	date.setDate(d);
	updateDateInfo(date);
	var currentDay = document.querySelector(".selected-day");

	if (currentDay) {
		currentDay.classList.remove("selected-day");
	}

	var prevTd;

	if (currentDay) {
		var currentTd = currentDay.parentNode;
		prevTd = currentTd.previousElementSibling;

		if (!prevTd) {
			var currentTr = currentTd.parentNode;
			var prevTr = currentTr.previousElementSibling;

			if (prevTr && !prevTr.classList.contains("header-row")) {
				prevTd = prevTr.lastElementChild;
			} else {
				calendar();
			}
		}

		if (prevTd) {
			var prevDiv = prevTd.querySelector("div");
			if (prevDiv) {
				prevDiv.classList.add("selected-day");
			}
		}
	}
}

function displayToday() {
	var today = new Date();
	var m = today.getMonth();
	var y = today.getFullYear();
	date.setMonth(m);
	date.setFullYear(y);
	document.getElementById("month").innerHTML = months[m] + " " + y;
	updateDateInfo(new Date());
	calendar();
}

function daysInMonth(month, year) {
	return new Date(year, month + 1, 0).getDate();
}

function retrieveEvents(data) {
	$.ajax({
		type: "POST",
		url: "../php/calendar-function.php",
		data: {
			data: data,
			action: "retrieveEvents",
		},
		dataType: "json",
		success: function (response) {
			console.log(response);
			if (response.retrieveEvents) {
				var eventi = response.events;
				$(".date-hours").empty();
				eventi.forEach((element) => {
					console.log(element);
					$(".date-hours").append(
						"<h5>" + element.orario + " " + element.tipologia + "</h5>"
					);
				});
			} else {
				$(".date-hours").empty().append("<h1>No events</h1>");
			}
		},
		error: function (jqXHR, textStatus, errorThrown) {
			console.error("Error:", textStatus, errorThrown);
			console.error("Response:", jqXHR.responseText);
		},
	});
}
