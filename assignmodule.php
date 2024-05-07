<?php
include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

// check logged in
if (isset($_SESSION['id'])) {

   echo template("templates/partials/header.php");
   echo template("templates/partials/nav.php");

   // If a module has been selected
   if (isset($_POST['selmodule'])) {
      $sql = "insert into studentmodules values ('" .  $_SESSION['id'] . "','" . $_POST['selmodule'] . "');";
      $result = mysqli_query($conn, $sql);
      $data['content'] .= "<p>The module " . $_POST['selmodule'] . " has been assigned to you</p>";

   }
   else  // If a module has not been selected
   {

     // Build sql statement that selects all the modules
     $sql = "select * from module";
     $result = mysqli_query($conn, $sql);

     $data['content'] .= "<div style='text-align: center;'>";
     $data['content'] .= "<form name='frmassignmodule' action='' method='post' >";
     $data['content'] .= "<strong>Select a module to assign</strong><br/>";
     $data['content'] .= "<select name='selmodule' >";
     // Display the module names in a drop-down selection box
     while($row = mysqli_fetch_array($result)) {
        $data['content'] .= "<option value='$row[modulecode]'>$row[name]</option>";
     }
     $data['content'] .= "</select><br/>";
     $data['content'] .= "<input type='submit' name='confirm' value='Save' />";
     $data['content'] .= "</form>";
     $data['content'] .= "</div>"; 
   }

   // render the template
   echo template("templates/default.php", $data);


} else {
   header("Location: index.php");
}

echo template("templates/partials/footer.php");

?>
