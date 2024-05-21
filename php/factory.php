<?php include 'security.php'; ?>
<html>
<head>
    <title>Ferrari Factory</title>
    <link rel="icon" href="../img/logo/white-horse.svg" type="image/x-icon">

    <link rel="stylesheet" type="text/css" href="../css/AllAroundF1.css">
    <link rel="stylesheet" type="text/css" href="../css/backend.css">
    <link rel="stylesheet" type="text/css" href="../css/dynamic-dashboard.css">
    <link rel="stylesheet" type="text/css" href="../css/marketing.css">
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
    <section id="dynamic-dashboard">
        <div class="dynamic-dashboard-grid marketing"> 
            <div class="dynamic-dashboard-card grid-col-span-3 grid-row-span-3">
                <div class="list">
                    <div class="list-header">
                        <div class="title">
                            <div class="title-text">
                                <i class="bi bi-people"></i>
                                <h4>Car</h4>
                            </div>
                        </div>
                    </div>
                    <div class="list-content">
                    </div>
                    <div class="list-footer">
                        <div class="list-link" onclick="window.location.href='events.php';">
                            <i class="bi bi-arrow-down-right"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dynamic-dashboard-card grid-col-span-3 grid-row-span-5">
                <div class="list">
                    <div class="list-header">
                        <div class="title">
                            <div class="title-text">
                                <i class="bi bi-people"></i>
                                <h4>Components</h4>
                            </div>
                        </div>
                    </div>
                    <div class="list-card">
                        <div class="filter-card">
                            <div class="card-row">
                                <?php //include('merchandise_count.php'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="list-content">
                        <div class="table-header">
                            <p>Name</p>
                            <p>Email</p>
                            <p>Position</p>
                            <p>Specialization</p>
                        </div>
                        <div id="list-result" class="table-body scrollable-section">
                            <?php //include 'merchandise-list.php'; ?> <!-- sarebbe da fare con meno campi -->
                        </div>
                    </div>
                    <div class="list-footer">
                        <div class="list-link" onclick="window.location.href='merchandise.php';">
                            <i class="bi bi-arrow-down-right"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dynamic-dashboard-card grid-col-span-3 grid-row-span-5">
                <div class="list">
                    <div class="list-header">
                        <div class="title">
                            <div class="title-text">
                                <i class="bi bi-people"></i>
                                <h4>Factory Engineers</h4>
                            </div>
                        </div>
                    </div>
                    <div class="list-card">
                        <div class="filter-card">
                            <div class="card-row">
                                <?php //include('order_count.php'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="list-content">
                        <div class="table-header">
                            <p>Name</p>
                            <p>Email</p>
                            <p>Position</p>
                            <p>Specialization</p>
                        </div>
                        <div id="list-result" class="table-body scrollable-section">
                            <?php //include 'order-list.php'; ?> <!-- sarebbe da fare con meno campi -->
                        </div>
                    </div>
                    <div class="list-footer">
                        <div class="list-link" onclick="window.location.href='order.php';">
                            <i class="bi bi-arrow-down-right"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dynamic-dashboard-card grid-col-span-3 grid-row-span-3">
                <div class="list">
                    <div class="list-header">
                        <div class="title">
                            <div class="title-text">
                                <i class="bi bi-people"></i>
                                <h4>Production</h4>
                            </div>
                        </div>
                    </div>
                    <div class="list-content">
                    </div>
                    <div class="list-footer">
                        <div class="list-link" onclick="window.location.href='sponsor.php';">
                            <i class="bi bi-arrow-down-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>