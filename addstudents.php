<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

// Check if the form has been submitted
if (isset($_POST['submit'])) {

    // Check if file is uploaded without any errors
    if ($_FILES['file']['error'] === UPLOAD_ERR_OK) {
        // Handle file upload
        $file_name = $_FILES['file']['name'];
        $file_tmp = $_FILES['file']['tmp_name'];
        $file_type = $_FILES['file']['type'];
        $file_size = $_FILES['file']['size'];

        // File upload directory
        $upload_dir = "uploads/";

        // Create the upload directory if it doesn't exist
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true); // Create directory with full permissions
        }

        if (move_uploaded_file($file_tmp, $upload_dir . $file_name)) {
            // Construct the file path to be stored in the database
            $file_photo = $upload_dir . $file_name;
        } else {
            // Handle file upload error
            echo "File upload failed!";
            exit; // Exit the script
        }
    } else {
        // Handle file upload error
        echo "File upload error: " . $_FILES['file']['error'];
        exit; // Exit the script
    }

    // Hash the password
    $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Prepare SQL statement for inserting student details into the database
    $sql = "INSERT INTO student(studentid, password, dob, firstname, lastname, house, town, county,
    country, postcode, photo) 
    VALUES ('{$_POST['studentid']}','$hashed_password','{$_POST['dob']}',
    '{$_POST['firstname']}','{$_POST['lastname']}','{$_POST['house']}',
    '{$_POST['town']}','{$_POST['county']}',
    '{$_POST['country']}','{$_POST['postcode']}','$file_photo')";

    // Execute the SQL statement
    $result = mysqli_query($conn, $sql);

    // Check if the query was successful
    if ($result) {
        // Display success message
        echo "<p>Student Record has been added</p>";
    } else {
        // Display error message if query fails
        echo "Error: " . mysqli_error($conn);
    }
}

// Check if the user is logged in
if (isset($_SESSION['id'])) {
   echo template("templates/partials/header.php");
 echo template("templates/partials/nav.php");
    // Render the form
    $data['content'] = <<<EOD

    <h2>Add New Student</h2>
    <form name="frmdetails" action="" method="post" enctype="multipart/form-data">
    Student ID:
    <input name="studentid" type="text" value="" /><br/>
    Password:
    <input name="password" type="text" value="" /><br/>
    Date of Birth:
    <input name="dob" type="text" value="" required /><br/>
    First Name:
    <input name="firstname" type="text" value="" required /><br/>
    Surname:
    <input name="lastname" type="text" value="" required /><br/>
    Number and Street:
    <input name="house" type="text" value="" /><br/>
    Town:
    <input name="town" type="text" value="" /><br/>
    County:
    <input name="county" type="text" value="" /><br/>
    Country:
    <input name="country" type="text" value="" /><br/>
    Postcode:
    <input name="postcode" type="text" value="" /><br/>
    Upload image:
    <input type="file" name="file" /><br/>
    <input type="submit" value="Save" name="submit" />
    </form>

    EOD;

    // Render the template
    echo template("templates/default.php", $data);
   } else {
       header("Location: index.php");
   }
   
   echo template("templates/partials/footer.php");
   ?>
