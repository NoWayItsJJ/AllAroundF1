<?php include 'security.php'; ?>
<html>
<head>
    <title>Ferrari Factory</title>
    <link rel="icon" href="../img/logo/white-horse.svg" type="image/x-icon">

    <link rel="stylesheet" type="text/css" href="../css/AllAroundF1.css">
    <link rel="stylesheet" type="text/css" href="../css/backend.css">
    <link rel="stylesheet" type="text/css" href="../css/factory-marketing.css">
    <link rel="stylesheet" type="text/css" href="../css/staff.css">
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
    <section id="dashboard">
        <div class="factory-marketing-grid"> 
            <div class="dashboard-card grid-col-span-3 grid-row-span-3 no-hover">
                <div class="card-header">
                    <i class="fa-regular fa-garage"></i>
                    <h4>Car</h4>
                </div>
                <div class="card-content">
                    <div class="car-points">
                        <div class="point first">
                        <span class="text">Rear wing</span>
                            <div class="inner-point"></div>
                        </div>
                        <div class="point second">
                            <span class="text">Front wing</span>
                            <div class="inner-point"></div>
                        </div>
                    </div>
                    <img class="img-absolute car" src="../img/car/car.png" alt="">
                    <div class="layer-black"></div>
                </div>
            </div>
            <div class="dashboard-card grid-col-span-3 grid-row-span-8">
                <div class="card-header" onclick="window.location.href='components.php';">
                    <i class="fa-regular fa-engine"></i>
                    <h4>Components</h4>
                </div>
                <div class="card-content">
                    <div class="list">
                        <div class="list-card">
                            <div class="filter-card">
                                <div class="card-row">
                                    <?php include('./staff/staff_count.php'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="list-content scrollable-section">
                            <div class="table-header">
                                <p>Article</p>
                                <p>Tipologia</p>
                                <p>quantità</p>
                            </div>
                            <div id="list-result" class="table-body">
                                <?php //include './staff/staff-list.php'; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="card-link" onclick="window.location.href='components.php';">
                        <i class="fa-regular fa-arrow-down-right"></i>
                    </div>
                </div>
            </div>
            <div class="dashboard-card grid-col-span-3 grid-row-span-5">
                <div class="card-header" onclick="window.location.href='staff.php';">
                    <i class="fa-regular fa-user-helmet-safety"></i>
                    <h4>Engineers</h4>
                </div>
                <div class="card-content">
                    <div class="list">
                        <div class="list-card">
                            <div class="filter-card">
                                <div class="card-row">
                                    <?php include('./staff/staff_count.php'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="list-content scrollable-section">
                            <div class="table-header">
                                <p>Article</p>
                                <p>Tipologia</p>
                                <p>quantità</p>
                            </div>
                            <div id="list-result" class="table-body">
                                <?php //include './staff/staff-list.php'; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="card-link" onclick="window.location.href='staff.php';">
                        <i class="fa-regular fa-arrow-down-right"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>