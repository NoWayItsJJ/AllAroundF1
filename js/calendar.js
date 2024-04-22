var date = new Date();
var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
var dayNames = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"];

function calendar() {
	var today = new Date();
	var currentDay = today.getDate();
	var month = date.getMonth();
	var year = date.getFullYear();
	var firstDay = new Date(year, month, 1);
	var startingDay = firstDay.getDay();
	var monthLength = daysInMonth(month, year);
	var monthName = months[month];
	document.getElementById("month").innerHTML = monthName + " " + year;
	var html = "<table class='calendar-content'>";
	html += "<tr>";
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
				if (day === currentDay && month === today.getMonth() && year === today.getFullYear()) {
					html += "<span class='current-day'>";
				}
				html += day;
				if (day === currentDay && month === today.getMonth() && year === today.getFullYear()) {
					html += "</span>";
				}
				day++;
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

function displayToday() {
	var today = new Date();
	var m = today.getMonth();
	var y = today.getFullYear();
	date.setMonth(m);
	date.setFullYear(y);
	document.getElementById("month").innerHTML = months[m] + " " + y;
	calendar();
}

function daysInMonth(month, year) {
	return new Date(year, month + 1, 0).getDate();
}
