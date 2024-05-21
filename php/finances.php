<?php include 'security.php'; ?>
<html>
<head>
    <title>Ferrari Finances</title>
    <link rel="icon" href="../img/logo/white-horse.svg" type="image/x-icon">

    <link rel="stylesheet" type="text/css" href="../css/AllAroundF1.css">
    <link rel="stylesheet" type="text/css" href="../css/backend.css">
    <link rel="stylesheet" type="text/css" href="../css/dynamic-dashboard.css">
    <link rel="stylesheet" type="text/css" href="../css/finances.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="../js/finances.js"></script>
</head>
<body>
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
    <div id="screen-overlay" class="screen-overlay">
        <div id="popup" class="popup">
            <div class="popup-header">
                <h3 class="popup-title"></h3>
                <i class="bi bi-x" onclick="closePopup()"></i>
            </div>
            <div id="popup-content" class="popup-content">
            </div>
        </div>
    </div>
    <section id="dynamic-dashboard">
        <div class="dynamic-dashboard-grid"> 
            <div class="dynamic-dashboard-card grid-col-span-4 grid-row-span-8">
                <div class="list">
                    <div class="list-header">
                        <div class="title">
                            <div class="title-text">
                                <i class="fa-regular fa-chart-mixed-up-circle-dollar"></i>
                                <h2>Finances</h2>
                            </div>
                            <p>Manage the finances of the Scuderia Ferrari</p>
                        </div>
                    </div>
                    <div class="list-card">
                        <div class="big-card">
                            <?php include('./finances/finances_total.php'); ?>
                        </div>
                        <div class="filter-card">
                            <div class="card-row">
                                <?php include('./finances/finances_count.php'); ?>
                            </div>
                            <div class="search">
                                <input type="text" id="search" placeholder="Search">                            
                                <i class="fa-regular fa-magnifying-glass"></i>
                            </div>
                        </div>
                    </div>
                    <div class="list-content scrollable-section">
                        <div class="table-header">
                            <p>Transaction</p>
                            <p>Amount</p>
                            <p>Reason</p>
                            <p>Description</p>
                        </div>
                        <div id="list-result" class="table-body">
                            <?php include './finances/finances-list.php'; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dynamic-dashboard-card">
                <div class="time">
                    <img src="../img/logo/logo-scuderia.png" alt="">
                    <div class="clock">
                        <h3 id="time"></h3>
                        <p></p>
                    </div>
                </div>
            </div>
            <div class="dynamic-dashboard-card grid-row-span-7">
                <div id="tab-details" class="tab-details">
                    <div class="tab-details-title">
                        <i class="fa-regular fa-landmark-magnifying-glass"></i>
                        <h3>Transaction details</h3>
                    </div>
                    <div id="no-result" class="zero-result" style="display: flex;">
                        <p>Select a transaction to see more details</p>
                    </div>
                    <div class="details" id="detailsBlock" style="display: none;">
                        <div class="details-header">
                            <div class="item-img">
                                <i class=""></i><!-- mettere l icona del senso della tranzazione con colore e amount in grande-->
                            </div>
                        </div>
                        <div class="details-content scrollable-section">
                            <h4>Transaction Info</h4>
                            <div id="personal-info">
                                <div class="personal-info-row">
                                    <p id="transactionId" hidden></p>
                                    <p id="itemId" hidden></p>
                                    <p id="type"><strong>Type</strong></p>
                                    <p id="displayType"></p>
                                </div>
                                <div class="personal-info-row">
                                    <p id="amount"><strong>Amount</strong></p>
                                    <p id="displayAmount"></p>
                                </div>
                                <div class="personal-info-row">
                                    <p id="description"><strong>Description</strong></p>
                                    <p id="displayDescription"></p>
                                </div>
                            </div>
                            <h4>More Info</h4>
                            <div id="contract-info"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
<script>
    function updateTime() {
        var now = new Date();
        var hours = now.getHours();
        var minutes = now.getMinutes();
        var seconds = now.getSeconds();
        var day = now.toLocaleString('it-IT', { weekday: 'long' });
        var date = now.getDate();
        var month = now.toLocaleString('it-IT', { month: 'long' });
        var year = now.getFullYear();

        hours = hours < 10 ? '0' + hours : hours;
        minutes = minutes < 10 ? '0' + minutes : minutes;
        seconds = seconds < 10 ? '0' + seconds : seconds;

        document.getElementById('time').textContent = hours + ' : ' + minutes + ' : ' + seconds;
        document.querySelector('.clock p').textContent = day.charAt(0).toUpperCase() + day.slice(1) + ' ' + date + ' ' + month + ' ' + year;
    }

    setInterval(updateTime, 1000);
</script>
</html>