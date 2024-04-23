<?php

   include("_includes/config.inc");
   include("_includes/dbconnect.inc");
   include("_includes/functions.inc");
   // check logged in
   if (isset($_SESSION['id'])) {
     
    var_dump ($_POST['students']);
    die();
   if (empty($_POST['students'])){

   }
   //loop over $_POST['students'] - foreach()
      //build SQL query to delte item 
      $sql = "SELECT FROM students WHERE student_id = '$studentId'";
      // run the query
      $result = mysqli_query($conn,$sql);
   //redirect
   header("Location: index.php");
   }
   else {
      header("Location: index.php");
   }
?>
