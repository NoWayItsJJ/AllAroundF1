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
            <div class="dashboard-card red grid-col-span-2">
                <div class="card-header" onclick="window.location.href='calendar.php';">
                    <i class="fa-regular fa-calendar-lines"></i>
                    <h4>Calendar</h4>
                </div>
                <div class="card-content">
                    <div class="calendar">
                        <div class="calendar-header">
                            <div class="calendar-header-month">
                                <h5 id="month"></h5>
                            </div>
                            <div class="calendar-header-nav">
                                <button class="button-invisible-background" onclick="prevMonth()"><i class="bi bi-chevron-left"></i></button>
                                <button class="button-invisible-background" onclick="displayToday()">today</button>
                                <button class="button-invisible-background" onclick="nextMonth()"><i class="bi bi-chevron-right"></i></button>
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
                <div class="card-footer">
                    <div class="card-link" onclick="window.location.href='calendar.php';">
                        <i class="fa-regular fa-arrow-down-right"></i>
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
                                        <h3 id="balance">100000 €</h3>
                                        <p>Balance</p>
                                    </div>
                                </div>
                                <div class="slide-row">
                                    <i class="fa-regular fa-money-bill-transfer"></i>
                                    <div class="slide-col">
                                        <h3 id="income">100000 €</h3>
                                        <p>Income</p>
                                    </div>
                                </div>
                            </div>
                            <div class="slide" id="slide2">
                                <div class="slide-content">
                                    <h5>Expenses</h5>
                                    <h3 id="expenses">1000</h3>
                                </div>
                            </div>
                            <div class="slide" id="slide3">
                                <div class="slide-content">
                                    <h5>Profit</h5>
                                    <h1 id="profit">100000</h1>
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
                    <div class="card-link">
                        <i class="fa-regular fa-arrow-down-right"></i>
                    </div>
                </div>
            </div>
            <div class="dashboard-card grid-row-span-2" onclick="window.location.href='staff.php';">
                <div class="card-header">
                    <i class="fa-regular fa-user-group"></i>
                    <h4>Staff</h4>
                </div>
                <div class="card-content">
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
                </div>
                <div class="card-footer">
                    <div class="card-link" onclick="window.location.href='factory.php';">
                        <i class="fa-regular fa-arrow-down-right"></i>
                    </div>
                </div>
            </div>
            <div class="dashboard-card">
                <div class="card-header" onclick="window.location.href='marketing.php';">
                    <i class="fa-regular fa-bullhorn"></i>
                    <h4>Marketing</h4>
                </div>
                <div class="card-content">
                </div>
                <div class="card-footer">
                    <div class="card-link" onclick="window.location.href='marketing.php';">
                        <i class="fa-regular fa-arrow-down-right"></i>
                    </div>
                </div>
            </div>
            <div class="dashboard-card grid-col-span-2">
                <div class="card-header" onclick="window.location.href='drivers.php';">
                    <i class="fa-kit fa-driver-helmet"></i>
                    <h4>Drivers</h4>
                </div>
                <div class="card-content">
                </div>
                <div class="card-footer">
                    <div class="card-link" onclick="window.location.href='drivers.php';">
                        <i class="fa-regular fa-arrow-down-right"></i>
                    </div>
                </div>
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