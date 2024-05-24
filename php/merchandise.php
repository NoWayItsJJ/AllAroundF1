<?php include 'security.php'; ?>
<html>
<head>
    <title>Ferrari Merchandise</title>
    <link rel="icon" href="../img/logo/white-horse.svg" type="image/x-icon">

    <link rel="stylesheet" type="text/css" href="../css/AllAroundF1.css">
    <link rel="stylesheet" type="text/css" href="../css/backend.css">
    <link rel="stylesheet" type="text/css" href="../css/dynamic-dashboard.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="../js/merchandise.js"></script>
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
                        <i class="bi bi-box-arrow-right"></i>
                        <span class="nav-text">Logout</span>
                    </a>
                </li>
                <li>
                    <a href="./account-backend.php">
                        <i class="bi bi-person"></i>
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
                                <i class="bi bi-people"></i>
                                <h2>Merchandise</h2>
                            </div>
                            <p>Manage the merchandise of the Scuderia Ferrari</p>
                        </div>
                        <button class="button-primary button-squadrato popup-open" data-form-type="newForm" data-header="New component"><i class="bi bi-plus"></i>New component</button>
                    </div>
                    <div class="list-card">
                        <div class="big-card">
                            <div class="card">
                                <div class="card-icon">
                                    <i class="bi bi-people"></i>
                                </div>
                                <div class="card-data">
                                    <p>Total employees</p>
                                    <span>8</span>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-icon">
                                    <i class="bi bi-people"></i>
                                </div>
                                <div class="card-data">
                                    <p>Available employees</p>
                                    <span>8</span>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-icon">
                                    <i class="bi bi-people"></i>
                                </div>
                                <div class="card-data">
                                    <p>Ending contracts</p>
                                    <span>8</span>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-icon">
                                    <i class="bi bi-people"></i>
                                </div>
                                <div class="card-data">
                                    <p>Total salaries</p>
                                    <span>8</span>
                                </div>
                            </div>
                        </div>
                        <div class="filter-card">
                            <div class="card-row">
                                <?php include('merchandise/merchandise_count.php'); ?>
                            </div>
                            <div class="search">
                                <input type="text" id="search" placeholder="Search">                            
                                <i class="bi bi-search"></i>
                            </div>
                        </div>
                    </div>
                    <div class="list-content">
                        <div class="table-header">
                            <p>Inventory Number</p>
                            <p>Article</p>
                            <p>Quantity</p>
                        </div>
                        <div id="list-result" class="table-body scrollable-section">
                            <?php include 'merchandise/merchandise-list.php'; ?>
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
                    <h3>Article Details</h3>
                    <div id="no-result" class="zero-result" style="display: flex;">
                        <p>Select an article to see more details</p>
                    </div>
                    <div class="details" id="detailsBlock" style="display: none;">
                        <div class="details-header">
                            <div class="item-img">
                                <img id="articleImage" src="" alt="">
                            </div>
                            <div class="item-header-info">
                                <h3 id="articleId"></h3>
                                <p id="userRole"></p>
                            </div>
                        </div>
                        <div class="details-content scrollable-section">
                            <h4>Article Info</h4>
                            <div id="personal-info">
                                <div class="personal-info-row">
                                    <p id="articleId" hidden></p>
                                    <p id="inventoryNumber"><strong>Inventory Number</strong></p>
                                    <p id="displayInventoryNumber"></p>
                                </div>
                                <div class="personal-info-row">
                                    <p id="articleType"><strong>Article Type</strong></p>
                                    <p id="displayArticleType"></p>
                                </div>
                                <div class="personal-info-row">
                                    <p id="quantity"><strong>Quantity</strong></p>
                                    <p id="displayQuantity"></p>
                                </div>
                            </div>
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