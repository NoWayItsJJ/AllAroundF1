<?php include 'security.php'; ?>
<html>
<head>
    <title>Ferrari Staff</title>
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
                    <a href="./account-backend.php">
                        <i class="bi bi-person"></i>
                        <span class="nav-text">Account</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <section id="dynamic-dashboard">
        <div class="dynamic-dashboard-grid">
            <div class="dynamic-dashboard-card grid-col-span-4"></div>
            <div class="dynamic-dashboard-card">
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
                            <input type="text" placeholder="Search">
                            <i class="bi bi-search"></i>
                        </div>
                    </div>
                    <div class="list-content">
                        <table>
                            <thead>
                                <tr>
                                    <th>Staff ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Position</th>
                                    <th>Salary</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="dynamic-dashboard-card grid-row-span-5"></div>
        </div>
    </section>
</body>
</html>