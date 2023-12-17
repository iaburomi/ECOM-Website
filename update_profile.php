<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["user"]["email"])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Assuming you have a validation and sanitation process here
    $newProfileMessage = $_POST["newProfileMessage"];

    // Save the new profile message to the session or your database
    $_SESSION["user"]["profile_message"] = $newProfileMessage;

    // Redirect back to the profile page
    header("Location: profile.php");
    exit();
} else {
    // Redirect to the profile page if the request method is not POST
    header("Location: profile.php");
    exit();
}
?>
