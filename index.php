<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

echo template("templates/partials/header.php");

if (isset($_GET['return'])) {
    $msg = "";
    if ($_GET['return'] == "fail") {$msg = "Login Failed. Please try again";}
    $data['message'] = "<p>$msg</p>";
}

if (isset($_SESSION['id'])) {
    echo template("templates/partials/nav.php");
    // Center content
    echo "<div style='display: flex; justify-content: center; align-items: top; height: 100vh;'>"; 
    echo "<div>";
    $data['content'] = "<p style='font-weight: bold; font-size: medium;'>Welcome to your dashboard</p>";
    echo template("templates/default.php", $data);
    echo "</div>";
    echo "</div>";
} else {
    echo template("templates/login.php", $data);
}

echo template("templates/partials/footer.php");

?>
