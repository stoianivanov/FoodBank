<?php
require('config.php');

$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$comfirm = $_POST['comfirm'];
$type = 1;

$check = false;

if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email']) && isset($_POST['comfirm']))
{

  if(strcmp($password,$comfirm) == 0)
  {
    $sql = "insert into users (username, password, email, realname, type, type_id) values ('$username', '$password', '$email', 'Pesho', '$type', '1')";
    $connection->query($sql);
    // echo $sql ;
    // die();
    $check = true;
  }
}


if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email']) && isset($_POST['comfirm']))
{
  if($check)
  {
    header("Location: http://127.0.0.1/FoodBank2/login.php");
  }
  else
  {
    header("Location: http://127.0.0.1/FoodBank2/register.php");
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
<form class="form-horizontal" action="http://127.0.0.1/FoodBank2/register.php" method="post">
  <fieldset>
    <legend class="text-center">Registration Form</legend>
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
      <label for="inputConfirmPassword" class="col-lg-2 control-label">Confirm password</label>
      <div class="col-lg-10">
        <input class="form-control" id="inputConfirmPassword" placeholder="Confirm password" type="password" name="comfirm">
      </div>
    </div>
    <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Email</label>
      <div class="col-lg-10">
        <input class="form-control" id="inputEmail" placeholder="Email" type="text" name="email">
      </div>
    </div>
    <div class="form-group">
      <label class="col-lg-2 control-label">Account type</label>
      <div class="col-lg-10">
        <div class="radio">
          <label>
            <input name="optionsRadios" id="typeUser" value="option1" checked="" type="radio" name="type">
            User
          </label>
        </div>
        <div class="radio">
          <label>
            <input name="optionsRadios" id="typeBank" value="option2" type="radio" name="type">
            Bank
          </label>
        </div>
        <div class="radio">
          <label>
            <input name="optionsRadios" id="typeAdmin" value="option3" type="radio" name="type">
            Admin
          </label>
        </div>
      </div>
    </div>
    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
        <button type="reset" class="btn btn-default">Cancel</button>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </fieldset>
</form>
</div>
</body>
</html>