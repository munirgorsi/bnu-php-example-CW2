<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

$array_students = array(
    array(
        "studentid" => "22225432",
        "password" => "jhytdcbn65",
        "dob" => "1990/04/09",
        "firstname" => "Munir",
        "lastname" => "Gorsi",
        "house" => "50",
        "town" => "Slough",
        "county" => "Berkshire",
        "country" => "United Kingdom",
        "postcode" => "SL1 1LM",
        "photo" =>"C:\Users\Lenovo\OneDrive\Desktop\student3.jpg" 
    ),
    array(
        "studentid" => "22213254",
        "password" => "kocxrhmj09",
        "dob" => "1996/09/04",
        "firstname" => "Qasim",
        "lastname" => "Matloob",
        "house" => "1",
        "town" => "Slough",
        "county" => "Berkshire",
        "country" => "United Kingdom",
        "postcode" => "SL1 3KL",
        "photo" =>"images/student2.jpg"
    ),
    array(
        "studentid" => "22645928",
        "password" => "dfrghuyb60",
        "dob" => "1981/03/07",
        "firstname" => "Jack",
        "lastname" => "Jacob",
        "house" => "7",
        "town" => "Reading",
        "county" => "Berkshire",
        "country" => "United Kingdom",
        "postcode" => "RG1 3QN",
        "photo" => "images/student2.jpg"
    ),
    array(
        "studentid" => "22275678",
        "password" => "qsuophcrf8",
        "dob" => "2001/05/08",
        "firstname" => "Alan",
        "lastname" => "Parkinson",
        "house" => "33",
        "town" => "London",
        "county" => "London",
        "country" => "United Kingdom",
        "postcode" => "NW10 9YT",
        "photo" => "images/student2.jpg"
    ),
    array(
        "studentid" => "2226543",
        "password" => "mqsxcght54",
        "dob" => "1999/01/02",
        "firstname" => "Kaleem",
        "lastname" => "Karim",
        "house" => "85",
        "town" => "Windoser",
        "county" => "Berkshire",
        "country" => "United Kingdom",
        "postcode" => "SL4 5GH",
        "photo" => "images/student2.jpg"
    ),
);
    foreach ($array_students as $key => $student_array) {
        $studentid = $student_array['studentid'];
        // Check if studentid already exists in the database
        $check_query = "SELECT * FROM student WHERE studentid='$studentid'";
        $result = mysqli_query($conn, $check_query);
        if (mysqli_num_rows($result) > 0) {
            // Student already exists, you can skip or update the record here
            echo "Student with ID $studentid already exists.<br>";
            continue; // Skip inserting this record
        }
        // Proceed with insertion if the studentid doesn't exist
        $password = $student_array['password'];
        $dob = $student_array['dob'];
        $firstname = $student_array['firstname'];
        $lastname = $student_array['lastname'];
        $house = $student_array['house'];
        $town = $student_array['town'];
        $county = $student_array['county'];
        $country = $student_array['country'];
        $postcode = $student_array['postcode'];
        $photo = $student_array['photo'];
    
        $sql = "INSERT INTO student (studentid, password, dob, firstname, lastname, house, town, county, country, postcode, photo) 
        VALUES ('$studentid', '$password', '$dob', '$firstname', '$lastname', '$house', '$town', '$county', '$country', '$postcode', '$photo')";

        if (mysqli_query($conn, $sql)) {
            echo "New record created successfully for student with ID $studentid<br>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn) . "<br>";
        }
    }
    

?>

