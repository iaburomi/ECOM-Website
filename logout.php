<?php
session_start(); // Ensure session is started
// Store a logout message in a session variable
$_SESSION['logout_message'] = "You have successfully logged out.";
// Unset all session variables
session_unset();
// Destroy the session
session_destroy();
// Redirect to the login page
header("Location: login.php");
exit();
?>
