<?php
session_start(); // Ensure session is started
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        body {
            background-color: #f4f4f4;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px;
        }

        main {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            color: white;
        }

        p {
            color: #555;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .success {
            color: green;
        }
    </style>
</head>

<body>

    <header>
        <h1>Welcome to Your Website</h1>
    </header>

    <main>
        <?php
        // Display the logout message if available
        if (!empty($_SESSION['logout_message'])) {
            echo "<p class='success'>{$_SESSION['logout_message']}</p>";
            // Remove the logout message from the session to prevent it from displaying again
            unset($_SESSION['logout_message']);
        }

        // Display the welcome message or login prompt
        if (isset($_SESSION["user"]["email"])) {
            $user_email = $_SESSION["user"]["email"];
            echo "<p>Welcome, $user_email</p>";
            echo '<p><a href="logout.php">Logout</a></p>'; // Logout link
        } else {
            // User is not logged in, display message and login button
            echo "<p>You need to be logged in first</p>";
            echo '<p><a href="login.php">Login</a></p>'; // Login button
        }
        ?>
    </main>

</body>

</html>
