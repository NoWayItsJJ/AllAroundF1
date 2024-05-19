<?php include 'security.php'; ?>
<html>
<head>
    <title>Ferrari Logistics</title>
    <link rel="icon" href="../img/logo/white-horse.svg" type="image/x-icon">

    <link rel="stylesheet" type="text/css" href="../css/AllAroundF1.css">
    <link rel="stylesheet" type="text/css" href="../css/backend.css">
    <link rel="stylesheet" type="text/css" href="../css/dynamic-dashboard.css">
    <link rel="stylesheet" type="text/css" href="../css/staff.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="../js/logistics.js"></script>
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
            <span class="popup-title"></span>
                <i class="bi bi-x" onclick="closePopup()"></i>
            </div>
            <div id="popup-content" class="popup-content">
            </div>
        </div>
    </div>
    <section id="dynamic-dashboard">
        <div class="dynamic-dashboard-grid">
            <div class="dynamic-dashboard-card grid-col-span-4">
                <div class="card-row">
                <?php 
                    include('logistics_count.php'); 
                ?>
                </div>
            </div>
            <div class="dynamic-dashboard-card popup-open buttonNew" data-form-type="newForm" data-header="New employee">
                <div class="new-button">
                    <i class="bi bi-plus"></i>
                    <h3>New</h3>
                </div>
            </div> 
            <div class="dynamic-dashboard-card grid-col-span-4 grid-row-span-5">
                <div class="list">
                    <div class="list-header">
                        <h3>Staff</h3>
                        <div class="search">
                            <input type="text" id="search" placeholder="Search">                            
                            <i class="bi bi-search"></i>
                        </div>
                    </div>
                    <div class="line"></div>
                    <div class="list-content">
                        <table>
                            <thead>
                                <tr>
                                    <th>Moved</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Departure date</th>
                                    <th>Arrival date</th>
                                </tr>
                            </thead>
                            <tbody id="list-result">
                                <?php include 'logistics-list.php'; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="dynamic-dashboard-card grid-row-span-5">
                <div class="details" id="detailsBlock" style="display: none;">
                    <div class="details-header">
                        <div class="item-img">
                            <i id="movingIcon"></i>
                        </div>
                        <div class="item-header-info">
                            <h3 id="userName"></h3>
                            <p id="userRole"></p>
                        </div>
                    </div>
                    <div class="details-content">
                        <h4>Transport Info</h4>
                        <div id="personal-info">
                            <div class="personal-info-row">
                                <p id="movingId" hidden></p>
                                <p id="itemId" hidden></p>
                                <p id="from"><strong>From</strong></p>
                                <p id="displayFrom"></p>
                            </div>
                            <div class="personal-info-row">
                                <p id="to"><strong>To</strong></p>
                                <p id="displayTo"></p>
                            </div>
                            <div class="personal-info-row">
                                <p id="departure"><strong>Departure</strong></p>
                                <p id="displayDeparture"></p>
                            </div>
                            <div class="personal-info-row">
                                <p id="arrival"><strong>Arrival</strong></p>
                                <p id="displayArrival"></p>
                            </div>
                        </div>
                        <h4>Subject Info</h4>
                        <div id="contract-info">
                        </div>
                    </div>
                    <div class="details-footer">
                        <button class="button-primary red-button button-max-width popup-open" data-form-type="fireForm" data-header="Fire employee">Fire</button>
                        <button class="button-primary green-button button-max-width popup-open" data-form-type="renewForm" data-header="Renew contract">Renew</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>