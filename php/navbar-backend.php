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
        <i class="bi bi-house"></i>
        <span class="nav-text">Dashboard</span>
    </a>
</li>';

// Factory
$isActive = ($currentFile == 'factory.php' && $userType == 4) ? 'red-text' : '';
if($userType == 4) {
    echo '
    <li>
        <a href="./factory.php" class="'.$isActive.'">
            <i class="bi bi-gear"></i>
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
            <i class="bi bi-box"></i>
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
            <i class="bi bi-people"></i>
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
            <i class="bi bi-currency-exchange"></i>
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
            <i class="bi bi-megaphone"></i>
            <span class="nav-text">Marketing</span>
        </a>
    </li>';
}

// Calendar
$isActive = ($currentFile == 'calendar.php' && $userType == 4) ? 'red-text' : '';
if($userType == 4) {
    echo '
    <li>
        <a href="./calendar.php" class="'.$isActive.'">
            <i class="bi bi-calendar-week"></i>
            <span class="nav-text">Calendar</span>
        </a>
    </li>';
}

// Orders
$isActive = ($currentFile == 'orders.php' && $userType == 7) ? 'red-text' : '';
if($userType == 7) {
    echo '
    <li>
        <a href="./orders.php" class="'.$isActive.'">
            <i class="bi bi-cart"></i>
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
            <i class="bi bi-newspaper"></i>
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
            <i class="bi bi-calendar-week"></i>
            <span class="nav-text">Events</span>
        </a>
    </li>';
}

// Contracts
$isActive = ($currentFile == 'contracts.php' && $userType == 6) ? 'red-text' : '';
if($userType == 6) {
    echo '
    <li>
        <a href="./contracts.php" class="'.$isActive.'">
            <i class="bi bi-file-earmark-text"></i>
            <span class="nav-text">Contracts</span>
        </a>
    </li>';
}

// Production 
$isActive = ($currentFile == 'production.php' && $userType == 3) ? 'red-text' : '';
if($userType == 3) {
    echo '
    <li>
        <a href="./production.php" class="'.$isActive.'">
            <i class="bi bi-gear"></i>
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
            <i class="bi bi-gear-wide-connected"></i>
            <span class="nav-text">Components</span>
        </a>
    </li>';
}

?>