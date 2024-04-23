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
                    <a href="./backend.php" class="red-text">
                        <i class="bi bi-house"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="./factory.php">
                        <i class="bi bi-gear"></i>
                        <span class="nav-text">Factory</span>
                    </a>
                </li>
                <li>
                    <a href="./logistics.php">
                        <i class="bi bi-box"></i>
                        <span class="nav-text">Logistics</span>
                    </a>
                </li>
                <li>
                    <a href="./staff.php">
                        <i class="bi bi-people"></i>
                        <span class="nav-text">Staff</span>
                    </a>
                </li>
                <li>
                    <a href="./finances.php">
                        <i class="bi bi-currency-exchange"></i>
                        <span class="nav-text">Finances</span>
                    </a>
                </li>
                <li>
                    <a href="./marketing.php">
                        <i class="bi bi-megaphone"></i>
                        <span class="nav-text">Marketing</span>
                    </a>
                </li>
                <li>
                    <a href="./calendar.php">
                        <i class="bi bi-calendar-week"></i>
                        <span class="nav-text">Calendar</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="account">
            <ul>
                <li>
                    <a href="./account.php">
                        <i class="bi bi-person"></i>
                        <span class="nav-text">Account</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
<section id="dashboard" class="scrollable-section">
    <div class="dashboard-grid">
        <div class="dashboard-card red grid-col-span-2">
            <div class="card-header">
                <i class="bi bi-calendar-week"></i>
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
                    <div class="date-hours"></div>
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
                <h4>Finances</h4>
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
                <h4>Staff</h4>
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
                <h4>Logistics</h4>
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
                <h4>Factory</h4>
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
                <h4>Marketing</h4>
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
                <h4>Drivers</h4>
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
</html>