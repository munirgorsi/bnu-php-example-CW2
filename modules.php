<?php
include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

// check logged in
if (isset($_SESSION['id'])) {

    echo template("templates/partials/header.php");
    echo template("templates/partials/nav.php");

    // Build SQL statement that selects a student's modules
    $sql = "SELECT * FROM studentmodules sm, module m 
    WHERE m.modulecode = sm.modulecode AND sm.studentid = '" . $_SESSION['id'] ."';";

    $result = mysqli_query($conn, $sql);
    echo "<div style='display: flex; justify-content: center; align-items: top;'>";

    // prepare page content

    $data['content'] .= "<table border='1' class='table table-bordered border-primary'>";
    $data['content'] .= "<tr><th>Code</th><th>Name</th><th>Level</th></tr>";
    // Display the modules within the HTML table
    while ($row = mysqli_fetch_array($result)) {
        $data['content'] .= "<tr>";
        $data['content'] .= "<td>" . $row['modulecode'] . "</td>";
        $data['content'] .= "<td>" . $row['name'] . "</td>";
        $data['content'] .= "<td>" . $row['level'] . "</td>";
        $data['content'] .= "</tr>";
    }
    $data['content'] .= "</table>";

    // render the template
    echo template("templates/default.php", $data);

} else {
    header("Location: index.php");
}

echo template("templates/partials/footer.php");

?>
