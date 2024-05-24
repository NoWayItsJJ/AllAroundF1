<?php include 'security.php'; ?>
<html>
<head>
    <title>Ferrari Backend</title>
    <link rel="icon" href="../img/logo/white-horse.svg" type="image/x-icon">

    <link rel="stylesheet" type="text/css" href="../css/AllAroundF1.css">
    <link rel="stylesheet" type="text/css" href="../css/backend.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>
    <script src="../js/calendar.js"></script>
    <script src="../js/finances.js"></script>
    <script src="../js/backend.js"></script>

</head>
<body>
    <div class="se-pre-con">
        <div class="logo-load">
            <img src="../img/logo/white-horse.svg" alt="">
        </div>
    </div>
    <nav>
        <div class="logo">
            <a href="backend.php"><img src="../img/logo/white-horse.svg" alt=""></a>
        </div>
        <div class="links">
            <ul>
                <?php include 'navbar-backend.php'; ?>
            </ul>
        </div>
        <div class="account">
            <ul>
                <li>
                    <a href="./logout.php">
                        <i class="fa-regular fa-arrow-right-from-bracket"></i>
                        <span class="nav-text">Logout</span>
                    </a>
                </li>
                <li>
                    <a href="./account-backend.php">
                        <i class="fa-regular fa-user"></i>
                        <span class="nav-text">Account</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <section id="dashboard" class="scrollable-section">
        <div class="dashboard-grid">
            <div class="dashboard-card red grid-col-span-2 no-hover">
                <div class="card-header">
                    <i class="fa-regular fa-calendar-lines"></i>
                    <h4>Calendar</h4>
                </div>
                <div class="card-content cal">
                    <div class="calendar">
                        <div class="calendar-header">
                            <div class="calendar-header-month">
                                <h5 id="month"></h5>
                            </div>
                            <div class="calendar-header-nav">
                                <button class="button-invisible-background" onclick="prevMonth()"><i class="fa-regular fa-chevron-left"></i></button>
                                <button class="button-invisible-background" onclick="displayToday()">today</button>
                                <button class="button-invisible-background" onclick="nextMonth()"><i class="fa-regular fa-chevron-right"></i></button>
                            </div>
                        </div>
                        <div id="calendar"></div>
                    </div>
                    <div class="date">
                        <div class="date-day">
                            <button class="button-invisible-background" onclick="nextDay()"><i class="bi bi-chevron-up"></i></button>
                            <h5 class="big-date" id="day"></h5>
                            <h1 class="big-date" id="day-number"></h1>
                            <h5 class="big-date" id="day-month"></h5>
                            <h5 class="big-date" id="day-year"></h5>
                            <button class="button-invisible-background" onclick="prevDay()"><i class="bi bi-chevron-down"></i></button>
                        </div>
                        <div class="date-hours">
                            <div id="event"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dashboard-card">
                <div class="card-header" onclick="window.location.href='finances.php';">
                    <i class="fa-regular fa-chart-mixed-up-circle-dollar"></i>
                    <h4>Finances</h4>
                </div>
                <div class="card-content">
                    <div class="finances">
                        <div class="slider">
                            <div class="slide" id="slide1">
                                <div class="slide-row">
                                    <i class="fa-regular fa-landmark"></i>
                                    <div class="slide-col">
                                        <h3 id="balance"></h3>
                                        <p>Balance</p>
                                    </div>
                                </div>
                                <div class="slide-row">
                                    <i class="fa-regular fa-money-bill-transfer"></i>
                                    <div class="slide-col">
                                        <h3 id="income"></h3>
                                        <p>Income</p>
                                    </div>
                                </div>
                            </div>
                            <div class="slide" id="slide2">
                                <div class="slide-row">
                                    <i class="fa-regular fa-money-bill-transfer"></i>
                                    <div class="slide-col">
                                        <h3 id="lastTransaction"></h3>
                                        <p>Last transaction</p>
                                    </div>
                                </div>
                            </div>
                            <div class="slide" id="slide3">
                                <div class="slide-row">
                                    <i class="fa-regular fa-money-bill-transfer"></i>
                                    <div class="slide-col">
                                        <h3 id="income">70000000 €</h3>
                                        <p>Budget Cap</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="dots">
                            <span class="dot" onclick="currentSlide('slide1', this)"></span>
                            <span class="dot" onclick="currentSlide('slide2', this)"></span>
                            <span class="dot" onclick="currentSlide('slide3', this)"></span>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="card-link" onclick="window.location.href='finances.php';">
                        <i class="fa-regular fa-arrow-down-right"></i>
                    </div>
                </div>
            </div>
            <div class="dashboard-card grid-row-span-2">
                <div class="card-header" onclick="window.location.href='staff.php';">
                    <i class="fa-regular fa-user-group"></i>
                    <h4>Staff</h4>
                </div>
                <div class="card-content">
                    <div class="list">
                        <div class="list-filters">
                            <div id="filter1" class="filter box1 active" data-id="2">
                                <div class="icon">
                                    <i class="fa-regular fa-user-helmet-safety"></i>
                                </div>
                                <span id="nstaff-ingegneri"></span>
                                <p>Engineers</p>
                            </div>
                            <div id="filter1" class="filter box1" data-id="7">
                                <div class="icon">
                                    <i class="fa-regular fa-bullhorn"></i>
                                </div>
                                <span id="nstaff-marketing"></span>
                                <p>Marketing</p>
                            </div>
                            <div id="filter1" class="filter box1" data-id="4">
                                <div class="icon">
                                    <i class="fa-regular fa-user-tie-hair"></i>
                                </div>
                                <span id="nstaff-admin"></span>
                                <p>Administration</p>
                            </div>
                        </div>
                        <div id="staffList" class="table">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="card-link" onclick="window.location.href='staff.php';">
                        <i class="fa-regular fa-arrow-down-right"></i>
                    </div>
                </div>
            </div>
            <div class="dashboard-card grid-row-span-2">
                <div class="card-header"  onclick="window.location.href='logistics.php';">
                    <i class="fa-regular fa-truck-fast"></i>
                    <h4>Logistics</h4>
                </div>
                <div class="card-content">
                    <div class="list">
                        <div class="list-filters">
                            <div class="filter box2 active-log" data-transport="truck">
                                <div class="icon">
                                    <i class="fa-regular fa-truck-container"></i>
                                </div>
                                <span id="nstaff-trucks">4</span>
                                <p>Trucks</p>
                            </div>
                            <div class="filter box2" data-transport="ship">
                                <div class="icon">
                                    <i class="fa-regular fa-ship"></i>
                                </div>
                                <span id="nstaff-ships">0</span>
                                <p>Ships</p>
                            </div>
                            <div class="filter box2" data-transport="airplane">
                                <div class="icon">
                                    <i class="fa-regular fa-plane fa-rotate-by" style="--fa-rotate-angle: -45deg;"></i>
                                </div>
                                <span id="nstaff-planes">0</span>
                                <p>Planes</p>
                            </div>
                            <div class="filter box2" data-transport="train">
                                <div class="icon">
                                    <i class="fa-regular fa-train"></i>
                                </div>
                                <span id="nstaff-trains">0</span>
                                <p>Trains</p>
                            </div>
                            <div class="filter box2" data-transport="bus">
                                <div class="icon">
                                    <i class="fa-regular fa-bus-simple"></i>
                                </div>
                                <span id="nstaff-bus">0</span>
                                <p>Bus</p>
                            </div>
                            <div class="filter box2" data-transport="car">
                                <div class="icon">
                                    <i class="fa-regular fa-car-side"></i>
                                </div>
                                <span id="nstaff-cars">0</span>
                                <p>Cars</p>
                            </div>
                        </div>
                        <div id="transportList" class="table">
                            <div class="line"></div>
                            <div class="table-row log-row">
                                <i class="fa-regular fa-truck-container log"></i>
                                <p>Rear wing</p>
                                <div class="dep-arr">
                                    <p>Maranello</p>
                                    <i class="fa-regular fa-plane-departure log"></i>
                                    <p>Monaco</p>
                                </div>
                            </div>
                            <div class="line"></div>
                            <div class="table-row log-row">
                                <i class="fa-regular fa-truck-container log"></i>
                                <p>Front wing</p>
                                <div class="dep-arr">
                                    <p>Maranello</p>
                                    <i class="fa-regular fa-plane-departure log"></i>
                                    <p>Monaco</p>
                                </div>
                            </div>
                            <div class="line"></div>
                            <div class="table-row log-row">
                                <i class="fa-regular fa-truck-container log"></i>
                                <p>Riccardo Saro</p>
                                <div class="dep-arr">
                                    <p>Maranello</p>
                                    <i class="fa-regular fa-plane-departure log"></i>
                                    <p>Monaco</p>
                                </div>
                            </div>
                            <div class="line"></div>
                            <div class="table-row log-row">
                                <i class="fa-regular fa-truck-container log"></i>
                                <p>Floor V1</p>
                                <div class="dep-arr">
                                    <p>Miami</p>
                                    <i class="fa-regular fa-plane-departure log"></i>
                                    <p>Imola</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="card-link"  onclick="window.location.href='logistics.php';">
                        <i class="fa-regular fa-arrow-down-right"></i>
                    </div>
                </div>
            </div>
            <div class="dashboard-card grid-col-span-2">
                <div class="card-header"  onclick="window.location.href='factory.php';">
                    <i class="fa-regular fa-industry"></i>
                    <h4>Factory</h4>
                </div>
                <div class="card-content">
                    <div class="factory">
                        <div class="factory-col">
                            <p>SF-24</p>
                        </div>
                        <div class="factory-col">
                            <h5>Components</h5>
                            <div class="component-stats">
                                <div class="icon">
                                    <i class="fa-regular fa-warehouse-full"></i>
                                </div>
                                <p><span>44</span>Warehouse</p>
                            </div>
                            <div class="component-stats">
                                <div class="icon">
                                    <i class="fa-regular fa-conveyor-belt-arm"></i>
                                </div>
                                <p><span>3</span>in Production</p>
                            </div>
                            <div class="component-stats">
                                <div class="icon">
                                    <i class="fa-regular fa-screwdriver-wrench"></i>
                                </div>
                                <p><span>3</span>Busy engineer</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="card-link" onclick="window.location.href='factory.php';">
                        <i class="fa-regular fa-arrow-down-right"></i>
                    </div>
                </div>
                <img class="img-absolute half-car" src="../img/car/half-car.png" alt="">
                <div class="sfumatura"></div>
            </div>
            <div class="dashboard-card">
                <div class="card-header" onclick="window.location.href='marketing.php';">
                    <i class="fa-regular fa-bullhorn"></i>
                    <h4>Marketing</h4>
                </div>
                <div class="card-content">
                    <div class="grid">
                        <div class="grid-card">
                            <i class="fa-regular fa-boxes-stacked"></i>
                            <div class="data">
                                <span>25</span>
                                <p>Merchandising</p>
                            </div>
                        </div>
                        <div class="grid-card">
                            <i class="fa-regular fa-bags-shopping"></i>
                            <div class="data">
                                <span>0</span>
                                <p>Orders</p>
                            </div>
                        </div>
                        <div class="grid-card">
                            <i class="fa-regular fa-comments"></i>
                            <div class="data">
                                <span>2</span>
                                <p>Interview</p>
                            </div>
                        </div>
                        <div class="grid-card">
                            <i class="fa-regular fa-file-invoice-dollar"></i>
                            <div class="data">
                                <span>3</span>
                                <p>Sponsor</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="card-link" onclick="window.location.href='marketing.php';">
                        <i class="fa-regular fa-arrow-down-right"></i>
                    </div>
                </div>
            </div>
            <div class="dashboard-card grid-col-span-2 no-hover">
                <div class="card-header">
                    <i class="fa-kit fa-driver-helmet"></i>
                    <h4>Drivers</h4>
                </div>
                <div class="card-content">
                    <div class="drivers">
                        <div class="driver">
                            <h5 class="lec">Charles Leclerc</h5>
                            <div class="data">
                                <div class="v-line red"></div>
                                <div class="info">
                                    <div class="info-title">
                                        <i class="fa-regular fa-memo-circle-info"></i>
                                        <span>Personal info</span>
                                    </div>
                                    <div class="info-line">
                                        <span>Age</span>
                                        <p>26</p>
                                    </div>
                                    <div class="info-line">
                                        <span>Weight</span>
                                        <p>69kg</p>
                                    </div>
                                    <div class="info-line">
                                        <span>Height</span>
                                        <p>1,80m</p>
                                    </div>
                                    <div class="info-title">
                                        <i class="fa-regular fa-file-contract"></i>
                                        <span>Contract info</span>
                                    </div>
                                    <div class="info-line">
                                        <span>Salary</span>
                                        <p>25mln&euro;</p>
                                    </div>
                                    <div class="info-line">
                                        <span>Contract end</span>
                                        <p>2028</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="driver">
                            <h5 class="sai">Carlos Sainz</h5>
                            <div class="data">
                                <div class="v-line yellow"></div>
                                <div class="info">
                                    <div class="info-title">
                                        <i class="fa-regular fa-memo-circle-info"></i>
                                        <span>Personal info</span>
                                    </div>
                                    <div class="info-line">
                                        <span>Age</span>
                                        <p>28</p>
                                    </div>
                                    <div class="info-line">
                                        <span>Weight</span>
                                        <p>66kg</p>
                                    </div>
                                    <div class="info-line">
                                        <span>Height</span>
                                        <p>1,78m</p>
                                    </div>
                                    <div class="info-title">
                                        <i class="fa-regular fa-file-contract"></i>
                                        <span>Contract info</span>
                                    </div>
                                    <div class="info-line">
                                        <span>Salary</span>
                                        <p>15mln&euro;</p>
                                    </div>
                                    <div class="info-line">
                                        <span>Contract end</span>
                                        <p>2028</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <img class="img-absolute lec" src="../img/drivers/leclerc.png" alt="">
                <img class="img-absolute sai" src="../img/drivers/sainz.png" alt="">
            </div>
        </div>
    </section>
</body>
<script>
    $(window).load(function() {
		// Animate loader off screen
		$(".se-pre-con").fadeOut(1000);
        currentSlide('slide1', document.getElementsByClassName('dot')[0]);
	});

    function currentSlide(slideId, dotElement) {
        // Nascondi tutte le slide
        var slides = document.getElementsByClassName('slide');
        for (var i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";  
        }
    
        // Rimuovi la classe "active" da tutti i puntini
        var dots = document.getElementsByClassName("dot");
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
    
        // Mostra la slide corrente e rendi il puntino corrispondente attivo
        document.getElementById(slideId).style.display = "flex";  
        dotElement.className += " active";
    }
</script>
</html>