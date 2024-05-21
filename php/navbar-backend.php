<?php
$userType = $_SESSION['user_type']; 

include_once 'security.php';

/*
utenti:
- dirigente (4)
- ingegnere (3)(poi in base al tipo)
- pilota (1)
- amministrazione/risorse umane (6)
- marketing (7)
*/

$currentFile = basename($_SERVER['PHP_SELF']);

// Dashboard
$isActive = ($currentFile == 'backend.php') ? 'red-text' : '';
echo '
<li >
    <a href="./backend.php" class="'.$isActive.'">
        <i class="fa-regular fa-house-blank"></i>
        <span class="nav-text">Dashboard</span>
    </a>
</li>';

// Factory
$isActive = ($currentFile == 'factory.php' && $userType == 4) ? 'red-text' : '';
if($userType == 4) {
    echo '
    <li>
        <a href="./factory.php" class="'.$isActive.'">
            <i class="fa-regular fa-industry"></i>
            <span class="nav-text">Factory</span>
        </a>
    </li>';
}

// Logistics
$isActive = ($currentFile == 'logistics.php' && ($userType == 4 || $userType == 6)) ? 'red-text' : '';
if($userType == 4 || $userType == 6) {
    echo '
    <li>
        <a href="./logistics.php" class="'.$isActive.'">
            <i class="fa-regular fa-truck-fast"></i>
            <span class="nav-text">Logistics</span>
        </a>
    </li>';
}

// Staff
$isActive = ($currentFile == 'staff.php' && ($userType == 4 || $userType == 6)) ? 'red-text' : '';
if($userType == 4 || $userType == 6) {
    echo '
    <li>
        <a href="./staff.php" class="'.$isActive.'">
            <i class="fa-regular fa-user-group"></i>
            <span class="nav-text">Staff</span>
        </a>
    </li>';
}

// Finances
$isActive = ($currentFile == 'finances.php' && ($userType == 4 || $userType == 6)) ? 'red-text' : '';
if($userType == 4 || $userType == 6) {
    echo '
    <li>
        <a href="./finances.php" class="'.$isActive.'">
            <i class="fa-regular fa-chart-mixed-up-circle-dollar"></i>
            <span class="nav-text">Finances</span>
        </a>
    </li>';
}

// Marketing
$isActive = ($currentFile == 'marketing.php' && ($userType == 4 || $userType == 7)) ? 'red-text' : '';
if($userType == 4 || $userType == 7) {
    echo '
    <li>
        <a href="./marketing.php" class="'.$isActive.'">
            <i class="fa-regular fa-bullhorn"></i>
            <span class="nav-text">Marketing</span>
        </a>
    </li>';
}

// Orders
$isActive = ($currentFile == 'orders.php' && $userType == 7) ? 'red-text' : '';
if($userType == 7) {
    echo '
    <li>
        <a href="./orders.php" class="'.$isActive.'">
            <i class="fa-regular fa-bags-shopping"></i>
            <span class="nav-text">Orders</span>
        </a>
    </li>';
}

// Articles
$isActive = ($currentFile == 'articles.php' && $userType == 7) ? 'red-text' : '';
if($userType == 7) {
    echo '
    <li>
        <a href="./articles.php" class="'.$isActive.'">
            <i class="fa-regular fa-boxes-stacked"></i>
            <span class="nav-text">Articles</span>
        </a>
    </li>';
}

// Events
$isActive = ($currentFile == 'events.php' && $userType == 7) ? 'red-text' : '';
if($userType == 7) {
    echo '
    <li>
        <a href="./events.php" class="'.$isActive.'">
            <i class="fa-regular fa-calendar-lines"></i>
            <span class="nav-text">Events</span>
        </a>
    </li>';
}

// Production 
$isActive = ($currentFile == 'production.php' && $userType == 3) ? 'red-text' : '';
if($userType == 3) {
    echo '
    <li>
        <a href="./production.php" class="'.$isActive.'">
            <i class="fa-regular fa-conveyor-belt-arm"></i>
            <span class="nav-text">Production</span>
        </a>
    </li>';
}

// Components
$isActive = ($currentFile == 'components.php' && $userType == 3) ? 'red-text' : '';
if($userType == 3) {
    echo '
    <li>
        <a href="./components.php" class="'.$isActive.'">
            <i class="fa-regular fa-engine"></i>
            <span class="nav-text">Components</span>
        </a>
    </li>';
}

?>