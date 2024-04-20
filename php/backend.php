<html>
<head>
    <title>Ferrari Backend</title>
    <link rel="icon" href="../img/logo/white-horse.svg" type="image/x-icon">

    <link rel="stylesheet" type="text/css" href="../css/AllAroundF1.css">
    <link rel="stylesheet" type="text/css" href="../css/backend.css">

    <script src="../js/calendar.js"></script>
</head>
<body>
    <nav>
        <div class="logo">
            <a href="backend.php"><img src="../img/logo/white-horse.svg" alt=""></a>
        </div>
        <div class="links">
            <ul>
                <li>
                    <a href="#" class="red-text">
                        <i class="bi bi-house"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi bi-gear"></i>
                        <span class="nav-text">Factory</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi bi-box"></i>
                        <span class="nav-text">Logistics</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi bi-people"></i>
                        <span class="nav-text">Staff</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi bi-currency-exchange"></i>
                        <span class="nav-text">Finances</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi bi-megaphone"></i>
                        <span class="nav-text">Marketing</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi bi-calendar-week"></i>
                        <span class="nav-text">Calendar</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="account">
            <ul>
                <li>
                    <a href="#">
                        <i class="bi bi-person"></i>
                        <span class="nav-text">Account</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <section id="dashboard" class="scrollable-section">
        <div class="dashboard-grid">
            <div class="dashboard-card grid-col-span-2">
                <div class="card-header">
                    <i class="bi bi-calendar-week"></i>
                    <h3>Calendar</h3>
                </div>
                <div class="card-content">
                    <div class="calendar" onload="startTime()">
                        <div class="calendar-header">
                            <div class="calendar-header-month">
                                <h4 id="month"></h4>
                            </div>
                            <div class="calendar-header-nav">
                                <button class="button-invisible-background" onclick="prevMonth()"><i class="bi bi-arrow-left"></i></button>
                                <button class="button-invisible-background" onclick="today()">today</button>
                                <button class="button-invisible-background" onclick="nextMonth()"><i class="bi bi-arrow-right"></i></button>
                            </div>
                        </div>
                        <div class="calendar-content"></div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="card-link">
                        <i class="bi bi-arrow-down-right"></i>
                    </div>
                </div>
            </div>
            <div class="dashboard-card">
                <div class="card-header">
                    <i class="bi bi-currency-exchange"></i>
                    <h3>Finances</h3>
                </div>
                <div class="card-content">
                </div>
                <div class="card-footer">
                    <div class="card-link">
                        <i class="bi bi-arrow-down-right"></i>
                    </div>
                </div>
            </div>
            <div class="dashboard-card grid-row-span-2">
                <div class="card-header">
                    <i class="bi bi-people"></i>
                    <h3>Staff</h3>
                </div>
                <div class="card-content">
                </div>
                <div class="card-footer">
                    <div class="card-link">
                        <i class="bi bi-arrow-down-right"></i>
                    </div>
                </div>
            </div>
            <div class="dashboard-card grid-row-span-2">
                <div class="card-header">
                    <i class="bi bi-box"></i>
                    <h3>Logistics</h3>
                </div>
                <div class="card-content">
                </div>
                <div class="card-footer">
                    <div class="card-link">
                        <i class="bi bi-arrow-down-right"></i>
                    </div>
                </div>
            </div>
            <div class="dashboard-card grid-col-span-2">
                <div class="card-header">
                    <i class="bi bi-gear"></i>
                    <h3>Factory</h3>
                </div>
                <div class="card-content">
                </div>
                <div class="card-footer">
                    <div class="card-link">
                        <i class="bi bi-arrow-down-right"></i>
                    </div>
                </div>
            </div>
            <div class="dashboard-card">
                <div class="card-header">
                    <i class="bi bi-megaphone"></i>
                    <h3>Marketing</h3>
                </div>
                <div class="card-content">
                </div>
                <div class="card-footer">
                    <div class="card-link">
                        <i class="bi bi-arrow-down-right"></i>
                    </div>
                </div>
            </div>
            <div class="dashboard-card grid-col-span-2">
                <div class="card-header">
                    <h3>Drivers</h3>
                </div>
                <div class="card-content">
                </div>
                <div class="card-footer">
                    <div class="card-link">
                        <i class="bi bi-arrow-down-right"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>    
</body>
<script>
    function startTime() {
	var weekday = new Array();
	weekday[0] = "Sunday";
	weekday[1] = "Monday";
	weekday[2] = "Tuesday";
	weekday[3] = "Wednesday";
	weekday[4] = "Thursday";
	weekday[5] = "Friday";
	weekday[6] = "Saturday";
	var month = new Array();
	month[0] = "January";
	month[1] = "February";
	month[2] = "March";
	month[3] = "April";
	month[4] = "May";
	month[5] = "June";
	month[6] = "July";
	month[7] = "August";
	month[8] = "September";
	month[9] = "October";
	month[10] = "November";
	month[11] = "December";
	var today = new Date();
	var h = today.getHours();
	var m = today.getMinutes();
	var s = today.getSeconds();
	var d = today.getDate();
	var y = today.getFullYear();
	var wd = weekday[today.getDay()];
	var mt = month[today.getMonth()];

	m = checkTime(m);
	s = checkTime(s);
	document.getElementById("date").innerHTML = d;
	document.getElementById("day").innerHTML = wd;
	document.getElementById("month").innerHTML = mt + "/" + y;

	var t = setTimeout(startTime, 500);
}

function prevMonth() {
	var today = new Date();
	var m = today.getMonth();
	var y = today.getFullYear();
	if (m == 0) {
		m = 11;
		y = y - 1;
	} else {
		m = m - 1;
	}
	var mt = month[m];
	document.getElementById("month").innerHTML = mt + "/" + y;
}

function nextMonth() {
	var today = new Date();
	var m = today.getMonth();
	var y = today.getFullYear();
	if (m == 11) {
		m = 0;
		y = y + 1;
	} else {
		m = m + 1;
	}
	var mt = month[m];
	document.getElementById("month").innerHTML = mt + " " + y;
}

function today() {
	var today = new Date();
	var m = today.getMonth();
	var y = today.getFullYear();
	var mt = month[m];
	document.getElementById("month").innerHTML = mt + " " + y;
}

function checkTime(i) {
	if (i < 10) {
		i = "0" + i;
	}
	return i;
}

</script>
</html>