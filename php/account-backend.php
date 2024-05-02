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
    <?php include 'account-info.php'; ?>
    <div id="screen-overlay" class="screen-overlay">
        <div id="popup" class="popup">
            <div class="popup-header">
                <h3>Modifica foto profilo</h3>
                <i class="bi bi-x" onclick="document.getElementById('screen-overlay').classList.remove('open-overlay')"></i>
            </div>
            <div class="popup-content">
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="file" name="file" id="file" class="inputfile" accept="image/*">
                    <button type="submit" name="submit" class="fill-button green-button">Upload</button>
                </form>
            </div>
        </div>
    </div>
    <section id="account">
        <div class="user-profile">
            <div class="user-info">
                <div class="user-avatar">
                    <img src="../img/utenti/<?php echo $userImage; ?>" alt="">
                    <div class="overlay" onclick="openPopup()">
                        <i class="bi bi-pencil"></i>
                    </div>
                </div>
                <div class="user-details">
                    <p><?php echo ucfirst($userRole); ?></p>
                    <h3><?php echo ucfirst($userName).' '.ucfirst($userSurname); ?></h3>
                    <p><strong><?php echo $userEmail; ?></strong></p>
                </div>
            </div>
            <div class="user-actions">
                <button onclick="openPopup()" class="button-outline">Modifica foto profilo</button>
            </div>
        </div>
        <div class="account-card ">
            <div class="account-card-header">
                <h3>Info utente</h3>
                <img src="../img/logo/logo-scuderia.png" alt="">
            </div>
            <div class="line"></div>
            <div class="account-card-content">
                <div class="account-card-row">
                    <div class="account-card-line">
                        <p><strong>Name</strong></p>
                        <div class="account-card-row-dx">
                            <p><?php echo ucfirst($userName); ?></p>
                            <div class="i-button" onclick="toggleForm('formNome', 'cr-nome')">
                                <i id="cr-nome" class="bi bi-chevron-right"></i>
                            </div>
                        </div>
                    </div>
                    <form id="formNome" action="" method="post">
                        <label for="name">New Name</label>
                        <div class="form-row">
                            <input id="inputNome" type="text" name="name" placeholder="<?php echo ucfirst($userName); ?>">
                            <div class="form-button">
                                <button type="submit" onclick="toggleForm('formNome', 'cr-nome'); clearInput('inputNome')" class="fill-button red-button small-button">Cancel</button>
                                <button type="submit" name="submit" class="fill-button green-button small-button">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="line"></div>
                <div class="account-card-row">
                    <div class="account-card-line">
                        <p><strong>Surname</strong></p>
                        <div class="account-card-row-dx">
                            <p><?php echo ucfirst($userSurname); ?></p>
                            <div class="i-button" onclick="toggleForm('formCognome', 'cr-cognome')">
                                <i id="cr-cognome" class="bi bi-chevron-right"></i>
                            </div>
                        </div>
                    </div>
                    <form id="formCognome" action="" method="post">
                        <label for="surname">New Surname</label>
                        <div class="form-row">
                            <input id="inputCognome" type="text" name="name" placeholder="<?php echo ucfirst($userSurname); ?>">
                            <div class="form-button">
                                <button type="submit" onclick="toggleForm('formCognome', 'cr-cognome'); clearInput('inputCognome')" class="fill-button red-button small-button">Cancel</button>
                                <button type="submit" name="submit" class="fill-button green-button small-button">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="line"></div>
                <div class="account-card-row">
                    <div class="account-card-line">
                        <p><strong>Email</strong></p>
                        <div class="account-card-row-dx">
                            <p><?php echo $userEmail; ?></p>
                            <div class="i-button" onclick="toggleForm('formEmail', 'cr-email')">
                                <i id="cr-email" class="bi bi-chevron-right"></i>
                            </div>
                        </div>
                    </div>
                    <form id="formEmail" action="" method="post">
                        <label for="email">New Email</label>
                        <div class="form-row">
                            <input id="inputEmail" type="email" name="email" placeholder="<?php echo $userEmail; ?>">
                            <div class="form-button">
                                <button type="submit" onclick="toggleForm('formEmail', 'cr-email'); clearInput('inputEmail')" class="fill-button red-button small-button">Cancel</button>
                                <button type="submit" name="submit" class="fill-button green-button small-button">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="line"></div>
                <div class="account-card-row">
                    <div class="account-card-line">
                        <p><strong>Password</strong></p>
                        <div class="account-card-row-dx">
                            <p class="password">
                                <i class="bi bi-dot"></i>
                                <i class="bi bi-dot"></i>
                                <i class="bi bi-dot"></i>
                                <i class="bi bi-dot"></i>
                                <i class="bi bi-dot"></i>
                                <i class="bi bi-dot"></i>
                                <i class="bi bi-dot"></i>
                                <i class="bi bi-dot"></i>
                            </p>
                            <div class="i-button" onclick="toggleForm('formPassword', 'cr-password')">
                                <i id="cr-password" class="bi bi-chevron-right"></i>
                            </div>
                        </div>
                    </div>
                    <form id="formPassword" action="" method="post">
                        <label for="password">New Password</label>
                        <div class="form-row">
                            <input id="inputPassword" type="password" name="password" placeholder="********">
                            <div class="form-button">
                                <button type="submit" onclick="toggleForm('formPassword', 'cr-password'); clearInput('inputPassword')" class="fill-button red-button small-button">Cancel</button>
                                <button type="submit" name="submit" class="fill-button green-button small-button">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="line"></div>
                <div class="account-card-row">
                    <div class="account-card-line">
                        <p><strong>Address</strong></p>
                        <div class="account-card-row-dx">
                            <p><?php echo $userAddress; ?></p>
                            <div class="i-button" onclick="toggleForm('formAddress', 'cr-address')">
                                <i id="cr-address" class="bi bi-chevron-right"></i>
                            </div>
                        </div>
                    </div>
                    <form id="formAddress" action="" method="post">
                        <label for="address">New Address</label>
                        <div class="form-row">
                            <input id="inputAddress" type="text" name="address" placeholder="<?php echo $userAddress; ?>">
                            <div class="form-button">
                                <button type="submit" onclick="toggleForm('formAddress', 'cr-address'); clearInput('inputAddress')" class="fill-button red-button small-button">Cancel</button>
                                <button type="submit" name="submit" class="fill-button green-button small-button">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="line"></div>
                <div class="account-card-row">
                    <div class="account-card-line">
                        <p><strong>Contract</strong></p>
                        <div class="account-card-row-dx">
                            <p>Scadenza il <?php echo $endContract; ?></p>
                            <div class="i-button" onclick="toggleForm('contractDetails', 'cr-contract')">
                                <i id="cr-contract" class="bi bi-chevron-right"></i>
                            </div>
                        </div>
                    </div>
                    <div id="contractDetails">

                    </div>
                </div>
            </div>
        </div>
        <a href="./logout.php" class="exit" role="button"><strong>Logout</strong></a>
    </section>
</body>
<script>
function toggleForm(formId, iconId) {
    // Seleziona il form e l'icona specifici
    var form = document.getElementById(formId);
    var icon = document.getElementById(iconId);

    // Se il form specifico è già aperto...
    if (form.classList.contains('active')) {
        // Chiudi il form specifico e ruota l'icona specifica nella posizione originale
        form.classList.remove('active');
        icon.classList.remove('rotate');
    } else {
        // Chiudi tutti i form
        var forms = document.querySelectorAll('form');
        forms.forEach(function(form) {
            if (form.classList.contains('active')) {
                form.classList.remove('active');
            }
        });

        // Ruota tutte le icone nella posizione originale
        var icons = document.querySelectorAll('.bi-chevron-right');
        icons.forEach(function(icon) {
            if (icon.classList.contains('rotate')) {
                icon.classList.remove('rotate');
            }
        });

        // Apri il form specifico e ruota l'icona specifica
        form.classList.add('active');
        icon.classList.add('rotate');
    }
}

function clearInput(id) {
    var input = document.getElementById(id);
    input.value = '';
}

function openPopup() {
    var popup = document.getElementById('screen-overlay');
    popup.classList.add('open-overlay');
}
</script>
</html>