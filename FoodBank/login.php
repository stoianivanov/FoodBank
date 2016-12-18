<?php
require('config.php');

$username = $_POST['username'];
$password = $_POST['password'];

$check = false;
if(isset($_POST['username']))
{
  if(isset($_POST['password']))
  {
    if($connection)
    {
      $sql = "SELECT COUNT(*) as user FROM users where username='$username' and password='$password'";
      foreach ($connection->query($sql) as $row) {
        if($row['user'] > 0)
        {
          $check = true;
        }
      }
    }
  }
}



if(isset($_POST['username']))
{
  if($check)
  {
    session_start();
    $_SESSION['user'] = $username;

    $sql = "SELECT type, id FROM users where username='$username' and password='$password'";
    foreach ($connection->query($sql) as $row) {
        $_SESSION['user_type'] = $row['type'];
        $_SESSION['user_id'] = $row['id'];
      }
      if($_SESSION['user_type'] == 1)
      {
          header("Location: http://127.0.0.1/FoodBank/bank.php");
      }elseif($_SESSION['user_type'] == 2)
      {
          header("Location: http://127.0.0.1/FoodBank/shop.php");
      }else
      {
          header("Location: http://127.0.0.1/FoodBank/admin.php");
      }
    
  }
  else
  {
    header("Location: http://127.0.0.1/FoodBank/login.php");
  }
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" xmlns="">
	<!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="lib/bootstrap-3.3.7-dist/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/style.css" />

  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

</head>
<body>
<div class="container">
<form class="form-horizontal" method="post" action="http://127.0.0.1/FoodBank/login.php">
  <fieldset>
    <legend class="text-center">Login Form</legend>
    <div class="form-group">
      <label for="inputUser" class="col-lg-2 control-label">Username</label>
      <div class="col-lg-10">
        <input class="form-control" id="inputUser" placeholder="Username" type="text" name="username">
      </div>
    </div>
    <div class="form-group">
      <label for="inputPassword" class="col-lg-2 control-label">Password</label>
      <div class="col-lg-10">
        <input class="form-control" id="inputPassword" placeholder="Password" type="password" name="password">
      </div>
    </div>
    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
        <button type="reset" class="btn btn-default">Отхвърли</button>
        <button type="submit" class="btn btn-primary">Влез</button>
        <a class="btn btn-primary" href="http://127.0.0.1/FoodBank/register.php">Регистрация</a>
      </div>
    </div>
  </fieldset>
</form>
</div>
</body>
</html>


