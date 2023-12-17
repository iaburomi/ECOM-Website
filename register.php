<?php

require(__DIR__ . "/partials/nav.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 8px;
        }

        input {
            padding: 8px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
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

        .error {
            color: #dc3545;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<header>
    <h1>Register</h1>
</header>

<main>
    <form onsubmit="return validate(this)" method="POST">
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" required />
        </div>
        <div>
            <label for="username">Username</label>
            <input type="text" name="username" required />
        </div>
        <div>
            <label for="pw">Password</label>
            <input type="password" id="pw" name="password" required minlength="8" />
        </div>
        <div>
            <label for="confirm">Confirm Password</label>
            <input type="password" name="confirm" required minlength="8" />
        </div>
        <input type="submit" value="Register" />
    </form>

    <?php
    // TODO: Add your existing PHP code here
    if (isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["confirm"])) {
        // Your existing PHP code for registration goes here
        // Make sure to adjust the styling of success and error messages
        $email = se($_POST, "email", "", false);
        $username = se($_POST, "username", "", false);
        $password = se($_POST, "password", "", false);
        $confirm = se($_POST, "confirm", "", false);

        $hasError = false;
        $errorMessages = [];

        // Check if passwords match
        if ($password !== $confirm) {
            $errorMessages[] = "Passwords do not match";
            $hasError = true;
        }

        // Check if email is empty
        if (empty($email)) {
            $errorMessages[] = "Email must not be empty";
            $hasError = true;
        }

        // Check if username already taken
        $db = getDB();
        $stmt = $db->prepare("SELECT username FROM Users WHERE username = :username");
        $stmt->execute([":username" => $username]);
        $existingUsername = $stmt->fetchColumn();

        if ($existingUsername) {
            $errorMessages[] = "Username is already taken";
            $hasError = true;
        }

        if (!$hasError) {
            echo "<p>Welcome, $email</p>";
            // TODO: The rest of your registration PHP code...
            $hash = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $db->prepare("INSERT INTO Users (email, password, username) VALUES(:email, :password, :username)");
            try {
                $stmt->execute([":email" => $email, ":password" => $hash, ":username" => $username]);
                echo "<p>Successfully registered!</p>";
            } catch (Exception $e) {
                echo "<p>There was a problem registering</p>";
                echo "<pre>" . var_export($e, true) . "</pre>";
            }
        } else {
            // Display error messages
            foreach ($errorMessages as $errorMessage) {
                echo "<p class='error'>Error: $errorMessage</p>";
            }
        }
    }
    ?>

</main>

</body>
</html>
