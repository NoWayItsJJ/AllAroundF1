<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $block = array(5);

    /*
    utenti:
    - dirigente (4)
    - ingegnere (3)(poi in base al tipo)
    - pilota (1)
    - amministrazione/risorse umane (6)
    - marketing (7)
    */

    $file = basename($_SERVER['SCRIPT_FILENAME']);
    
    switch($file) {
        case ('finances.php'):
            $block[] = 7;
            $block[] = 3;
            $block[] = 1;
            break;
        case ('logistics.php'):
            $block[] = 7;
            $block[] = 3;
            $block[] = 1;
            break;
        case ('staff.php'):
            $block[] = 3;
            $block[] = 1;
            break;
        case ('factory.php'):
            $block[] = 7;
            $block[] = 6;
            $block[] = 1;
            break;
        case ('marketing.php'):
            $block[] = 6;
            $block[] = 3;
            $block[] = 1;
            break;
    }

    if (isset($_SESSION['user_type'])) {
        $user_type = $_SESSION['user_type'];
        if (in_array($user_type, $block)) {
            header('Location: access_denied.php');
            exit();
        }
    } else {
        header('Location: ../php/login.php');
        exit();
    }
?>