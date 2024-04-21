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
    ),
);

foreach ($array_students as $key => $student_array) {
    $studentid = $student_array['studentid'];
    $password = $student_array['password'];
    $dob = $student_array['dob'];
    $firstname = $student_array['firstname'];
    $lastname = $student_array['lastname'];
    $house = $student_array['house'];
    $town = $student_array['town'];
    $county = $student_array['county'];
    $country = $student_array['country'];
    $postcode = $student_array['postcode'];

    $sql = "INSERT INTO student (studentid, password, dob, firstname, lastname, house, town, county, country, postcode) 
        VALUES ('$studentid', '$password', '$dob', '$firstname', '$lastname', '$house', '$town', '$county', '$country', '$postcode')";

    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully<br>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn) . "<br>";
    }
}

?>

