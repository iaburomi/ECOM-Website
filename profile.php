<?php
session_start();

// Assuming your login logic sets the 'role', 'profile_message', 'username', and 'email' in the session
$userRole = isset($_SESSION["user"]["role"]) ? $_SESSION["user"]["role"] : 'user';
$profileMessage = isset($_SESSION["user"]["profile_message"]) ? $_SESSION["user"]["profile_message"] : '';
$username = isset($_SESSION["user"]["username"]) ? $_SESSION["user"]["username"] : '';
$email = isset($_SESSION["user"]["email"]) ? $_SESSION["user"]["email"] : '';

// Function to update user information
function updateUserInformation($newUsername, $newEmail, $newProfileMessage)
{
    // Implement your logic to update the user information in the database
    // ...

    // Update session variables
    $_SESSION["user"]["username"] = $newUsername;
    $_SESSION["user"]["email"] = $newEmail;
    $_SESSION["user"]["profile_message"] = $newProfileMessage;
}

// Check if the form is submitted for updating information
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $newUsername = isset($_POST["newUsername"]) ? trim($_POST["newUsername"]) : '';
    $newEmail = isset($_POST["newEmail"]) ? trim($_POST["newEmail"]) : '';
    $newProfileMessage = isset($_POST["newProfileMessage"]) ? trim($_POST["newProfileMessage"]) : '';

    // Validate inputs as needed

    // Update user information
    updateUserInformation($newUsername, $newEmail, $newProfileMessage);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <style>
        /* Your CSS styles here */
        body {
            background-color: <?php echo $userRole === 'admin' ? 'white' : '#f4f4f4'; ?>;
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

        #profileSection {
            margin-top: 20px;
        }

        #editProfileBtn {
            background-color: #007bff;
            color: #fff;
            padding: 8px;
            cursor: pointer;
        }

        #editProfileBtn:hover {
            background-color: #0056b3;
        }

        #profileMessage {
            margin-top: 10px;
        }

        #editProfileModal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }

        #editProfileModalContent {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        #closeEditProfileModal {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        #closeEditProfileModal:hover,
        #closeEditProfileModal:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <header>
        <h1>Profile</h1>
    </header>

    <main>
        <?php
        // Display the profile section
        echo '<div id="profileSection">';
        echo '<p>Username: ' . htmlspecialchars($username) . '</p>';
        echo '<p>Email: ' . htmlspecialchars($email) . '</p>';
        echo '<p>Profile Message: ' . htmlspecialchars($profileMessage) . '</p>';
        echo '<button id="editProfileBtn" onclick="openEditProfileModal()">Edit Profile</button>';
        echo '</div>';
        ?>
    </main>

    <!-- Edit Profile Modal -->
    <div id="editProfileModal">
        <div id="editProfileModalContent">
            <span id="closeEditProfileModal" onclick="closeEditProfileModal()">×</span>
            <h2>Edit Profile</h2>
            <form id="editProfileForm" method="post" onsubmit="return validateEditProfileForm()">
                <label for="newUsername">New Username:</label>
                <input type="text" id="newUsername" name="newUsername" value="<?php echo htmlspecialchars($username); ?>">
                <br>

                <label for="newEmail">New Email:</label>
                <input type="email" id="newEmail" name="newEmail" value="<?php echo htmlspecialchars($email); ?>">
                <br>

                <label for="newProfileMessage">New Profile Message:</label>
                <textarea id="newProfileMessage" name="newProfileMessage" rows="4" cols="50"><?php echo htmlspecialchars($profileMessage); ?></textarea>
                <br>

                <input type="submit" value="Save">
            </form>
        </div>
    </div>

    <script>
        function openEditProfileModal() {
            document.getElementById('editProfileModal').style.display = 'block';
        }

        function closeEditProfileModal() {
            document.getElementById('editProfileModal').style.display = 'none';
        }

        function validateEditProfileForm() {
            // Implement validation logic as needed
            return true;
        }
    </script>

</body>

</html>
