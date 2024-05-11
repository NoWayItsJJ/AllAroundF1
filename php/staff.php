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
                    include('staff_count.php'); 
                ?>
                </div>
            </div>
            <div class="dynamic-dashboard-card popup-open" data-form-type="newForm" data-header="New employee">
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
                <div class="details" id="detailsBlock" style="display: none;">
                    <div class="details-header">
                        <div class="item-img">
                            <img id="userImage" src="" alt="">
                        </div>
                        <div class="item-header-info">
                            <h3 id="userName"></h3>
                            <p id="userRole"></p>
                        </div>
                    </div>
                    <div class="details-content">
                        <h4>Personal Info</h4>
                        <div id="personal-info">
                            <div class="personal-info-row">
                                <p id="age"><strong>Age</strong></p>
                                <p id="displayAge"></p>
                            </div>
                            <div class="personal-info-row">
                                <p id="nationality"><strong>Nationality</strong></p>
                                <p id="displayNationality"></p>
                            </div>
                            <div class="personal-info-row">
                                <p id="email"><strong>Email</strong></p>
                                <p id="displayEmail"></p>
                            </div>
                            <div class="personal-info-row">
                                <p id="specialization"><strong>Specialization</strong></p>
                                <p id="displaySpecialization"></p>
                            </div>
                        </div>
                        <h4>Contract Info</h4>
                        <div id="contract-info">
                            <div class="contract-info-row">
                                <p id="salary"><strong>Salary</strong></p>
                                <p id="displaySalary"></p>
                            </div>
                            <div class="contract-info-row">
                                <p id="end"><strong>Contract end</strong></p>
                                <p id="displayEnd"></p>
                            </div>
                            <div class="contract-info-row">
                                <p id="bonus"><strong>Bonus</strong></p>
                                <p id="displayBonus"></p>
                            </div>
                        </div>
                    </div>
                    <div class="details-footer">
                        <button class="button-primary red-button button-max-width popup-open" data-form-type="fireForm" data-header="Fire emploeey">Fire</button>
                        <button class="button-primary green-button button-max-width popup-open" data-form-type="renewForm" data-header="Renew contract">Renew</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>