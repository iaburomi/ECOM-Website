<?php
session_start();

$_SESSION["user"]["username"] = $username; // Replace $username with the actual username from your database
$_SESSION["user"]["email"] = $email; // Replace $email with the actual email from your database
$_SESSION["user"]["role"] = $role; // Replace $role with the actual role from your database
$_SESSION["user"]["profile_message"] = $profile_message; // Replace $profile_message with the actual profile message from your database

header("Location: home.php");
exit();

require(__DIR__ . "/partials/nav.php");
if (isset($_SESSION['logout_message'])) {
    echo "<p>{$_SESSION['logout_message']}</p>";
    // Remove the logout message from the session to prevent it from displaying again
    unset($_SESSION['logout_message']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title> <!-- Corrected title -->
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
        <h1>Login</h1>
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
                <label for="password">Password</label>
                <input type="password" id="pw" name="password" required minlength="8" />
            </div>
            <input type="submit" value="Login" />
        </form>

        <?php
        require_once(__DIR__ . "/lib/functions.php");

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = se($_POST, "email", "", false);
            $username = se($_POST, "username", "", false);
            $password = se($_POST, "password", "", false);
            $hasError = false;

            if (empty($email)) {
                echo "<p class='error'>Email must not be empty</p>";
                $hasError = true;
            }

            if (empty($username)) {
                echo "<p class='error'>Username must not be empty</p>";
                $hasError = true;
            }

            // Sanitize and validate email
            $email = sanitize_email($email);
            if (!is_valid_email($email)) {
                echo "<p class='error'>Invalid email address</p>";
                $hasError = true;
            }

            if (empty($password)) {
                echo "<p class='error'>Password must not be empty</p>";
                $hasError = true;
            }
            if ($user && password_verify($password, $user["password"])) {
                $_SESSION["user"] = [
                    "id" => $user["id"],
                    "email" => $user["email"],
                ];
                header("Location: home.php");
                exit();
            } else {
                echo "<p class='error'>Invalid email or password</p>";
            }

            if (!$hasError) {
                $db = getDB();
                $stmt = $db->prepare("SELECT id, email, password FROM Users WHERE email = :email");
                try {
                    $r = $stmt->execute([":email" => $email]);
                    if ($r) {
                        $user = $stmt->fetch(PDO::FETCH_ASSOC);
                        if ($user && password_verify($password, $user["password"])) {
                            session_start(); // Ensure session is started
                            $_SESSION["user"] = [
                                "id" => $user["id"],
                                "email" => $user["email"],
                            ];
                            header("Location: home.php");
                            exit();
                        } else {
                            echo "<p class='error'>Invalid email or password</p>";
                        }
                    }
                } catch (Exception $e) {
                    echo "<p class='error'>There was an error processing your request</p>";
                    echo "<pre>" . var_export($e, true) . "</pre>";
                }
            }
        }
        ?>

    </main>

</body>

</html>