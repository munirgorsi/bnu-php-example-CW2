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
