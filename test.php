<?php
include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

// check if user is logged in
if (isset($_SESSION['id'])) {
    // Debugging
    var_dump($_POST['students']);
    // Check if students to delete are provided
    if (!empty($_POST['students'])) {
        // Loop over each student to delete
        foreach ($_POST['students'] as $studentId) {
            // Sanitize input to prevent SQL injection
            $studentId = mysqli_real_escape_string($conn, $studentId);
            // Build SQL query to delete student
            $sql = "DELETE FROM cw2_students.student WHERE studentid = '$studentId'";
            // Run the query
            $result = mysqli_query($conn, $sql);
            
            // Check if query was successful
            if (!$result) {
                // Handle error
                echo "Error deleting student with ID: $studentId. " . mysqli_error($conn);
            }
        }
    } else {
        echo "No students to delete.";
       
    }
    // Redirect to index.php after processing
    header("Location: index.php");
    exit(); 
} else {
    // If user is not logged in, redirect to index.php
    header("Location: index.php");
    exit(); 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Students</title>
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete?");
        }
    </script>
</head>
<body>
    <script>
        // Call the function when the page is loaded to show the confirmation dialog
        window.onload = function() {
            var confirmed = confirmDelete();
            if (!confirmed) {
                // If user cancels the deletion, redirect them to index.php
                window.location.href = "index.php";
            }
        };
    </script>
</body>
</html>
