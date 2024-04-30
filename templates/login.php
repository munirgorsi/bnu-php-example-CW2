<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <h1 class="mt-3 text-center">Login</h1>
      <?php
      if(!empty($message)){
          echo '<div class="alert alert-danger" role="alert">' . $message . '</div>';
      }
      ?>
      <form name="frmLogin" action="authenticate.php" method="post" class="mt-5">
        <div class="form-group">
          <label for="txtid">Student ID</label>
          <input type="text" class="form-control" id="txtid" name="txtid">
        </div>
        <div class="form-group">
          <label for="txtpwd">Password</label>
          <input type="password" class="form-control" id="txtpwd" name="txtpwd">
        </div>
        <button type="submit" name="btnlogin" class="btn btn-primary btn-block">Login</button>
      </form>
    </div>
  </div>
</div>

<!-- Bootstrap JS (optional) -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
