<?php
require(__DIR__ . "/partials/nav.php");
?>
<body style='background-color:lightgray'>
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
<script>
    function validate(form) {
        // TODO: Implement JavaScript validation
        // Ensure it returns false for an error and true for success
        return true;
    }
</script>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = se($_POST, "email", "", false);
    $username = se($_POST, "username", "", false);
    $password = se($_POST, "password", "", false);

    $hasError = false;

    if (empty($email)) {
        echo "Email must not be empty";
        $hasError = true;
    }

    if (empty($username)) {
        echo "Username must not be empty";
        $hasError = true;
    }

    // Sanitize and validate email
    $email = sanitize_email($email);
    if (!is_valid_email($email)) {
        echo "Invalid email address";
        $hasError = true;
    }

    if (empty($password)) {
        echo "Password must not be empty";
        $hasError = true;
    }

    if (!$hasError) {
        $db = getDB();
        $stmt = $db->prepare("SELECT id, email, password FROM Users WHERE email = :email");
        try {
            $r = $stmt->execute([":email" => $email]);

            if ($r) {
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($user && password_verify($password, $user["password"])) {
                    echo "Welcome, $email";
                    $_SESSION["user"] = [
                        "id" => $user["id"],
                        "email" => $user["email"],
                    ];
                    header("Location: home.php");
                    exit();
                } else {
                    echo "Invalid email or password";
                }
            }
        } catch (Exception $e) {
            echo "<pre>" . var_export($e, true) . "</pre>";
        }
    }
}
?>
