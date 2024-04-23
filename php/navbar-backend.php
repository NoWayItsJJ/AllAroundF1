<?php
$userType = $_SESSION['user_type']; 

if($userType == 5) {
    header('Location: access_denied.php');
    exit();
} else if (!isset($_SESSION['user_type'])){
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
if($userType == 4 || $userType == 6) {
    echo '
    <li>
        <a href="./logistics.php">
            <i class="bi bi-box"></i>
            <span class="nav-text">Logistics</span>
        </a>
    </li>';
}

// Staff
if($userType == 4 || $userType == 6) {
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

// Orders
if($userType == 7) {
    echo '
    <li>
        <a href="./orders.php">
            <i class="bi bi-cart"></i>
            <span class="nav-text">Orders</span>
        </a>
    </li>';
}

// Articles
if($userType == 7) {
    echo '
    <li>
        <a href="./articles.php">
            <i class="bi bi-newspaper"></i>
            <span class="nav-text">Articles</span>
        </a>
    </li>';
}

// Social
if($userType == 7) {
    echo '
    <li>
        <a href="./social.php">
            <i class="bi bi-people"></i>
            <span class="nav-text">Social</span>
        </a>
    </li>';
}

// Clients
if($userType == 7) {
    echo '
    <li>
        <a href="./clients.php">
            <i class="bi bi-person"></i>
            <span class="nav-text">Clients</span>
        </a>
    </li>';
}

// Events
if($userType == 7) {
    echo '
    <li>
        <a href="./events.php">
            <i class="bi bi-calendar-week"></i>
            <span class="nav-text">Events</span>
        </a>
    </li>';
}

// Contracts
if($userType == 6) {
    echo '
    <li>
        <a href="./contracts.php">
            <i class="bi bi-file-earmark-text"></i>
            <span class="nav-text">Contracts</span>
        </a>
    </li>';
}

// Car
if($userType == 3) {
    echo '
    <li>
        <a href="./car.php">
            <i class="bi bi-gear"></i>
            <span class="nav-text">Car</span>
        </a>
    </li>';
}

// Production 
if($userType == 3) {
    echo '
    <li>
        <a href="./production.php">
            <i class="bi bi-gear"></i>
            <span class="nav-text">Production</span>
        </a>
    </li>';
}

// Development
if($userType == 3) {
    echo '
    <li>
        <a href="./development.php">
            <i class="bi bi-tools"></i>
            <span class="nav-text">Development</span>
        </a>
    </li>';
}

// Components
if($userType == 3) {
    echo '
    <li>
        <a href="./components.php">
            <i class="bi bi-gear-wide-connected"></i>
            <span class="nav-text">Components</span>
        </a>
    </li>';
}

?>