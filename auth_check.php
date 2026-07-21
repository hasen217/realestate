<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    // Determine the path to realestateadmin.php based on current directory
    $prefix = '';
    if (file_exists('realestateadmin.php')) {
        $prefix = '';
    } elseif (file_exists('../realestateadmin.php')) {
        $prefix = '../';
    }
    header("Location: " . $prefix . "realestateadmin.php");
    exit();
}
?>
