<?php
// Start session only if it hasn't been started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Unset and destroy session variables
session_unset();
session_destroy();

// Redirect to login page
header("Location: login.php");
exit();
?>
