<?php include 'security.php'; ?>
<html>
<head>
    <title>Ferrari Marketing</title>
    <link rel="icon" href="../img/logo/white-horse.svg" type="image/x-icon">

    <link rel="stylesheet" type="text/css" href="../css/AllAroundF1.css">
    <link rel="stylesheet" type="text/css" href="../css/backend.css">
    <link rel="stylesheet" type="text/css" href="../css/dynamic-dashboard.css">
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
            <div class="dynamic-dashboard-card grid-col-span-3 grid-row-span-6">
            </div>
            <div class="dynamic-dashboard-card grid-col-span-3 grid-row-span-2">
            </div>
            <div class="dynamic-dashboard-card grid-col-span-3 grid-row-span-6">
            </div>
            <div class="dynamic-dashboard-card grid-col-span-3 grid-row-span-2">
            </div>
        </div>
    </section>
</body>
</html>