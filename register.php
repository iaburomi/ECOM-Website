<?php
require(__DIR__ . "/partials/nav.php");
?>
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
        <label for="confirm">Confirm</label>
        <input type="password" name="confirm" required minlength="8" />
    </div>
    <input type="submit" value="Register" />
</form>
<script>
    function validate(form) {
        //TODO 1: implement JavaScript validation
        //ensure it returns false for an error and true for success

        return true;
    }
</script>
<?php
//TODO 2: add PHP Code
if (isset($_POST["email"]) && isset($_POST["password"]) && (isset($_POST["confirm"]))){
    $email = se($_POST, "email", "", false);
    $username = se($_POST, "username", "",false);
    $password = se($_POST, "password", "", false);
    $confirm = se($_POST, "confirm", "", false);
    //TODO 3
    $hasError = false;

    if (empty($email)) {
        $errorMessages[] = "Email must not be empty";
        $hasError = true;
    }
    

    //Check DB if email is already taken
   


    // Check DB if username is already taken
   
    if (!$hasError) {
        echo "Welcome, $email";
        //TODO 4
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $db = getDB();
        $stmt = $db->prepare("INSERT INTO Users (email, password, username) VALUES(:email, :password, :username)");
        try {
            $stmt->execute([":email" => $email, ":password" => $hash, ":username" => $username]);
            echo "\nSuccessfully registered!";
        } catch (Exception $e) {
            echo "\nThere was a problem registering";
            "<pre>" . var_export($e, true) . "</pre>";
        }
    }

    else {
        //Email and username don't get cleared for password mismatch
        $enteredEmail = $_POST["email"];
        $enteredUsername = $_POST["username"];
    }
}
?>