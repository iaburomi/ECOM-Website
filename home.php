<?php
require(__DIR__ . "/partials/nav.php");
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
            color: white; /* Change color to white */
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
    </style>
</head>

<body>

    <header>
        <h1>Welcome to Your Website</h1>
    </header>

    <main>
        <?php
        session_start(); // Ensure session is started

        if (isset($_SESSION["user"]["email"])) {
            $user_email = $_SESSION["user"]["email"];
            echo "<p>Welcome, $user_email</p>";
            echo '<p><a href="logout.php">Logout</a></p>'; // Logout link
        } else {
            echo "<p>You're not logged in</p>";
        }
        ?>
    </main>

</body>

</html>
