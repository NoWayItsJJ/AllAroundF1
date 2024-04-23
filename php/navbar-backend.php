<?php
$userType = $_SESSION['userType']; 

if($userType == 5) {
    header('Location: access_denied.php');
    exit();
} else if (!isset($_SESSION['userType'])){
    header('Location: ../html/login.html');
    exit();
}

/*
utenti:
- dirigente (4)
- ingegnere (3)(poi in base al tipo)
- pilota (1)
- amministrazione/risorse umane (6)
- marketing (7)
*/

echo '
<li>
    <a href="./backend.php" class="red-text">
        <i class="bi bi-house"></i>
        <span class="nav-text">Dashboard</span>
    </a>
</li>';

// Factory
if($userType == 4) {
    echo '
    <li>
        <a href="./factory.php">
            <i class="bi bi-gear"></i>
            <span class="nav-text">

            Factory</span>
        </a>
    </li>';
}

// Logistics
if($userType == 4) {
    echo '
    <li>
        <a href="./logistics.php">
            <i class="bi bi-box"></i>
            <span class="nav-text">Logistics</span>
        </a>
    </li>';
}

// Staff
if($userType == 4) {
    echo '
    <li>
        <a href="./staff.php">
            <i class="bi bi-people"></i>
            <span class="nav-text">Staff</span>
        </a>
    </li>';
}

// Finances
if($userType == 4 || $userType == 6) {
    echo '
    <li>
        <a href="./finances.php">
            <i class="bi bi-currency-exchange"></i>
            <span class="nav-text">Finances</span>
        </a>
    </li>';
}

// Marketing
if($userType == 4 || $userType == 7) {
    echo '
    <li>
        <a href="./marketing.php">
            <i class="bi bi-megaphone"></i>
            <span class="nav-text">Marketing</span>
        </a>
    </li>';
}

// Calendar
if($userType == 4) {
    echo '
    <li>
        <a href="./calendar.php">
            <i class="bi bi-calendar-week"></i>
            <span class="nav-text">Calendar</span>
        </a>
    </li>';
}

?>