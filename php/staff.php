<?php include 'security.php'; ?>
<html>
<head>
    <title>Ferrari Staff</title>
    <link rel="icon" href="../img/logo/white-horse.svg" type="image/x-icon">

    <link rel="stylesheet" type="text/css" href="../css/AllAroundF1.css">
    <link rel="stylesheet" type="text/css" href="../css/backend.css">
    <link rel="stylesheet" type="text/css" href="../css/dynamic-dashboard.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="../js/staff.js"></script>
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
            <div class="dynamic-dashboard-card grid-col-span-4">
                <div class="card-row">
                <?php 
                    $role = "1";
                    include('staff_count.php'); 
                ?>
                </div>
            </div>
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
                            <input type="text" id="search" placeholder="Search">                            
                            <i class="bi bi-search"></i>
                        </div>
                    </div>
                    <div class="line"></div>
                    <div class="list-content">
                        <table>
                            <thead>
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Position</th>
                                    <th>Salary</th>
                                    <th>Contract end</th>
                                </tr>
                            </thead>
                            <tbody id="list-result">
                                <?php include 'staff-list.php'; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="dynamic-dashboard-card grid-row-span-5">
                <div class="details">
                    <div class="details-header">
                        <div class="item-img">
                            <img src="" alt="">
                        </div>
                        <div class="item-header-info">
                            <h3></h3>
                            <p></p>
                        </div>
                    </div>
                    <div class="details-content">
                        <div class="details-content-info">
                            <h4>Personal Info</h4>
                            <div id="personal-info">
                                <p><strong>Age</strong></p>
                                <p><strong>Nationality</strong></p>
                                <p><strong>Email</strong></p>
                                <p><strong>Specialization</strong></p>
                            </div>
                            <h4>Contract Info</h4>
                            <div id="contract-info">
                                <p><strong>Salary</strong></p>
                                <p><strong>Contract end</strong></p>
                                <p><strong>Bonus</strong></p>
                            </div>
                        </div>
                    </div>
                    <div class="details-buttons">
                        <button class="btn">Fire</button>
                        <button class="btn">Renew</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>