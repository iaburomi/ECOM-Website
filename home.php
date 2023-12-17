<?php
require(__DIR__ . "/partials/nav.php");
?>
<h1>Home</h1>
<body style='background-color:lightgray'>
<?php
if (is_logged_in()) {
    $userEmail = get_user_email();
    echo "Welcome, $userEmail";
    echo '<br><a href="logout.php">Logout</a>';
} else {
    echo "You're not logged in";
}
// shows session info
?>
