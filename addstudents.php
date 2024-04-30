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
            echo "<div class='container'><div class='alert alert-danger' role='alert'>File upload failed!</div></div>";
            exit; // Exit the script
        }
    } else {
        // Handle file upload error
        echo "<div class='container'><div class='alert alert-danger' role='alert'>File upload error: " . $_FILES['file']['error'] . "</div></div>";
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
        echo "<div class='container'><div class='alert alert-success' role='alert'>Student Record has been added</div></div>";
    } else {
        // Display error message if query fails
        echo "<div class='container'><div class='alert alert-danger' role='alert'>Error: " . mysqli_error($conn) . "</div></div>";
    }
}

// Check if the user is logged in
if (isset($_SESSION['id'])) {
    echo template("templates/partials/header.php");
    echo template("templates/partials/nav.php");

    // Render the form
    $data['content'] = <<<EOD
    <div class='container'>
        <h2 class='text-center'>Add New Student</h2>
        <form name="frmdetails" action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="studentid" class="form-label">Student ID</label>
                <input name="studentid" type="text" class="form-control" id="studentid" value="" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input name="password" type="password" class="form-control" id="password" required>
            </div>
            <div class="mb-3">
                <label for="dob" class="form-label">Date of Birth</label>
                <input name="dob" type="date" class="form-control" id="dob" required>
            </div>
            <div class="mb-3">
                <label for="firstname" class="form-label">First Name</label>
                <input name="firstname" type="text" class="form-control" id="firstname" required>
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">Surname</label>
                <input name="lastname" type="text" class="form-control" id="lastname" required>
            </div>
            <div class="mb-3">
                <label for="house" class="form-label">Number and Street</label>
                <input name="house" type="text" class="form-control" id="house">
            </div>
            <div class="mb-3">
                <label for="town" class="form-label">Town</label>
                <input name="town" type="text" class="form-control" id="town">
            </div>
            <div class="mb-3">
                <label for="county" class="form-label">County</label>
                <input name="county" type="text" class="form-control" id="county">
            </div>
            <div class="mb-3">
                <label for="country" class="form-label">Country</label>
                <input name="country" type="text" class="form-control" id="country">
            </div>
            <div class="mb-3">
                <label for="postcode" class="form-label">Postcode</label>
                <input name="postcode" type="text" class="form-control" id="postcode">
            </div>
            <div class="mb-3">
                <label for="file" class="form-label">Upload Image</label>
                <input type="file" name="file" class="form-control" id="file required">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Save</button>
        </form>
    </div>
EOD;

    // Render the template
    echo template("templates/default.php", $data);
} else {
    header("Location: index.php");
}

echo template("templates/partials/footer.php");
?>
