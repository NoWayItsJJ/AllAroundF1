<?php include 'security.php'; ?>
<html>
<head>
    <title>Account</title>
    <link rel="icon" href="../img/logo/white-horse.svg" type="image/x-icon">

    <link rel="stylesheet" type="text/css" href="../css/AllAroundF1.css">
    <link rel="stylesheet" type="text/css" href="../css/backend.css">
    <link rel="stylesheet" type="text/css" href="../css/account-backend.css">
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
    <?php include 'account-info.php'; ?>
    <section id="account">
        <div class="user-profile">
            <div class="user-info">
                <div class="user-avatar">
                    <img src="../img/utenti/<?php echo $userImage; ?>" alt="">
                </div>
                <div class="user-details">
                    <p><?php echo ucfirst($userRole); ?></p>
                    <h3><?php echo ucfirst($userName).' '.ucfirst($userSurame); ?></h3>
                    <p><strong><?php echo $userEmail; ?></strong></p>
                </div>
            </div>
            <div class="user-actions">
                <button class="button-outline">Modifica foto profilo</button>
            </div>
        </div>
        <div class="account-card">
            <div class="account-card-header">
                <h3>Info utente</h3>
                <img src="" alt="">
            </div>
        </div>
    </section>
</body>
</html>