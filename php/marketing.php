<?php include 'security.php'; ?>
<html>
<head>
    <title>Ferrari Marketing</title>
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
            <div class="dashboard-card grid-col-span-3 grid-row-span-5">
                <div class="card-header" onclick="window.location.href='merchandising.php';">
                    <i class="fa-regular fa-boxes-stacked"></i>
                    <h4>Merchandising</h4>
                </div>
                <div class="card-content">
                    <div class="list">
                        <div class="list-content scrollable-section">
                            <div class="table-header">
                                <p>Inventory Number</p>
                                <p>Article</p>
                                <p>Quantity</p>
                            </div>
                            <div id="list-result" class="table-body">
                                <?php include './merchandise/merchandise-list.php'; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="card-link" onclick="window.location.href='merchandise.php';">
                        <i class="fa-regular fa-arrow-down-right"></i>
                    </div>
                </div>
            </div>
            <div class="dashboard-card grid-col-span-3 grid-row-span-8">
                <div class="card-header" onclick="window.location.href='orders.php';">
                    <i class="fa-regular fa-bags-shopping"></i>
                    <h4>Orders</h4>
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
                    <div class="card-link" onclick="window.location.href='orders.php';">
                        <i class="fa-regular fa-arrow-down-right"></i>
                    </div>
                </div>
            </div>
            <div class="dashboard-card grid-col-span-3 grid-row-span-3 no-hover">
                <div class="card-header">
                    <i class="fa-regular fa-file-invoice-dollar"></i>
                    <h4>Sponsor</h4>
                </div>
                <div class="card-content">
                    <div class="sponsors">
                        <?php 
                            $sql = "SELECT * FROM sponsor";
                            $result = mysqli_query($conn, $sql);
                            $resultCheck = mysqli_num_rows($result);
                            if ($resultCheck > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<div class="sponsor">
                                            <div class="sponsor-img">
                                            <img src="../img/sponsors/'.$row['img'].'" alt="">
                                        </div>
                                        <span>'.$row['nome'].'</span>
                                        <p>'.$row['importo'].'&euro;</p>
                                        </div>';
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>