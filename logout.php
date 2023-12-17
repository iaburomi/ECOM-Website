<?php
session_start(); // Ensure session is started

// Store a logout message in a session variable
$_SESSION['logout_message'] = "You have successfully logged out.";

// Destroy the session
session_unset();
session_destroy();

// Ensure that the cookie is completely removed
setcookie(session_name(), "", time() - 3600, "/");

// Redirect to the login page
header("Location: login.php");
exit();
?>
