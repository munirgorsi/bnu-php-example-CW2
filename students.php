<?php
include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

// Check if logged in
if (isset($_SESSION['id'])) {
   $hidePassword = true;

    echo template("templates/partials/header.php");
    echo template("templates/partials/nav.php");

    // Build SQL statement that selects all students
    $sql = "SELECT * FROM student";
    $result = mysqli_query($conn, $sql);

    // Form for deleting students
    $data['content'] .= "<form id='deleteForm' action='deletestudents.php' method='POST'>";

    // Prepare table for displaying student data
    $data['content'] .= "<table border='1'>";
    $data['content'] .= "<tr><th>studentid</th><th>password</th><th>dob</th>
    <th>firstname</th><th>lastname</th><th>house</th><th>town</th>
    <th>county</th><th>country</th><th>postcode</th></tr>";

    // Display student data in the table
    while ($row = mysqli_fetch_array($result)) {
        $data['content'] .= "<tr>";
        $data['content'] .= "<td>{$row["studentid"]}</td>";
        // Check if the password should be hidden
        if ($hidePassword) {
            // Hide the password with #
            $data['content'] .= "<td>####### </td>";
        } else {
            // Display the actual password
            $data['content'] .= "<td>{$row["password"]}</td>";
        }
        $data['content'] .= "<td>{$row["dob"]}</td>";
        $data['content'] .= "<td>{$row["firstname"]}</td>";
        $data['content'] .= "<td>{$row["lastname"]}</td>";
        $data['content'] .= "<td>{$row["house"]}</td>";
        $data['content'] .= "<td>{$row["town"]}</td>";
        $data['content'] .= "<td>{$row["county"]}</td>";
        $data['content'] .= "<td>{$row["country"]}</td>";
        $data['content'] .= "<td>{$row["postcode"]}</td>";
        $data['content'] .= "<td><input type ='checkbox' name='students[]'
         value ='{$row['studentid']}'/></td>";
        $data['content'] .= "</tr>";
    }

    $data['content'] .= "</table>";

    // Delete Button with confirmation
    $data['content'] .= "<input type='submit' name='deletebtn' 
    value ='Delete' onclick='return confirmDelete();'/>";

    $data['content'] .= "</form>";

    // JavaScript function for confirmation dialog
    $data['content'] .= "<script>
        function confirmDelete() {
            return confirm('Are you sure you want to delete records?');
        }
    </script>";

    // Render the template
    echo template("templates/default.php", $data);
} else {
    header("Location: index.php");
}

echo template("templates/partials/footer.php");
?>

