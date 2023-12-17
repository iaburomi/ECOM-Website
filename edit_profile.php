<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["user"]["email"])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

// Assuming your login logic sets the 'profile_message' in the session
$profileMessage = isset($_SESSION["user"]["profile_message"]) ? $_SESSION["user"]["profile_message"] : '';

// Other user information can be retrieved similarly

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <style>
        /* Your CSS styles here */
    </style>
</head>

<body>

    <header>
        <h1>Edit Profile</h1>
    </header>

    <main>
        <form id="editProfileForm" action="update_profile.php" method="post">
            <label for="newProfileMessage">New Profile Message:</label>
            <textarea id="newProfileMessage" name="newProfileMessage" rows="4" cols="50"><?php echo htmlspecialchars($profileMessage); ?></textarea>
            <br>
            <input type="submit" value="Save">
        </form>
    </main>

</body>

</html>
