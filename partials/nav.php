<?php
// Note: this is to resolve cookie issues with port numbers
$domain = $_SERVER["HTTP_HOST"];
if (strpos($domain, ":")) {
    $domain = explode(":", $domain)[0];
}
$localWorks = true; // some people have issues with localhost for the cookie params
// if you're one of those people make this false

// this is an extra condition added to "resolve" the localhost issue for the session cookie
if (($localWorks && $domain == "localhost") || $domain != "localhost") {
    session_set_cookie_params([
        "lifetime" => 60 * 60,
        "path" => "/Project",
        "domain" => $domain,
        "secure" => true,
        "httponly" => true,
        "samesite" => "lax"
    ]);
}
require_once(__DIR__ . "/../lib/functions.php");
?>
<nav>
    <style>
        body {
            background-color: #f4f4f4;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            background-color: #333;
            padding: 10px;
        }

        .navbar ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .navbar li {
            margin-right: 15px;
        }

        .navbar a {
            text-decoration: none;
            color: #fff;
        }

        .navbar a:hover {
            text-decoration: underline;
        }
    </style>

    <div class="navbar">
        <ul>
            <?php if (is_logged_in()) : ?>
                <li><a href="home.php">Home</a></li>
                <li><a href="logout.php">Logout</a></li>
                <li><a href="profile.php">Profile</a></li> <!-- Add this line for the profile button -->
            <?php else : ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Register</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
