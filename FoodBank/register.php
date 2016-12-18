<?php
require('config.php');

$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$comfirm = $_POST['comfirm'];
$type = $_POST['optionsRadios'];

$check = false;

if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email']) && isset($_POST['comfirm']))
{

  if(strcmp($password,$comfirm) == 0)
  {
    $sql = "insert into users (username, password, email, realname, type, type_id) values ('$username', '$password', '$email', 'Pesho', '$type', '1')";
    $connection->query($sql);
    $check = true;
  }
}

if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email']) && isset($_POST['comfirm']))
{
  if($check)
  {
    //select user_id
    $user_id=0;
    $sql = "SELECT id FROM users where username='$username' and password='$password'";
    foreach ($connection->query($sql) as $row) {
        $user_id=$row['id'];
      }
    
    if($type == 1)
    {
        $bank_name = $_POST['bank_name'];
        $bank_region = $_POST['bank_region'];
        $bank_owner = $_POST['bank_owner'];
        $sql = "insert into foodbanks (region, name, owner, user_id) values ('$bank_region', '$bank_name', '$bank_owner', '$user_id')";
        $connection->query($sql);
    }
    else
    {
        $shop_name = $_POST['shop_name'];
        $shop_address = $_POST['shop_address'];
        $shop_mobile = $_POST['shop_mobile'];
        $shop_owner = $_POST['shop_owner'];
        $shop_bul = $_POST['shop_bul'];
        $shop_region = $_POST['shop_region'];
        $sql = "insert into shops (name, address, mobile, owner, bul, contribution, region) values ('$shop_name', '$shop_address', '$shop_mobile', '$shop_owner', '$shop_bul', '0', '$shop_region')";
        $connection->query($sql);
    }
  }
}


if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email']) && isset($_POST['comfirm']))
{
  if($check)
  {
    header("Location: http://127.0.0.1/FoodBank/login.php");
  }
  else
  {
    header("Location: http://127.0.0.1/FoodBank/register.php");
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
<form class="form-horizontal" action="http://127.0.0.1/FoodBank/register.php" method="post">
  <fieldset>
    <legend class="text-center">Регистрация</legend>
    <div class="form-group">
      <label for="inputUser" class="col-lg-2 control-label">Потербителско име</label>
      <div class="col-lg-10">
        <input class="form-control" id="inputUser" placeholder="Username" type="text" name="username">
      </div>
    </div>
    <div class="form-group">
      <label for="inputPassword" class="col-lg-2 control-label">Парола</label>
      <div class="col-lg-10">
        <input class="form-control" id="inputPassword" placeholder="Password" type="password" name="password">
      </div>
    </div>
    <div class="form-group">
      <label for="inputConfirmPassword" class="col-lg-2 control-label">Потвърди паролата</label>
      <div class="col-lg-10">
        <input class="form-control" id="inputConfirmPassword" placeholder="Confirm password" type="password" name="comfirm">
      </div>
    </div>
    <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Емайл</label>
      <div class="col-lg-10">
        <input class="form-control" id="inputEmail" placeholder="Email" type="text" name="email">
      </div>
    </div>
    <div class="form-group">
      <label class="col-lg-2 control-label">Тип на акаунта</label>
      <div class="col-lg-10">
        <div class="radio">
          <label>
            <input name="optionsRadios" id="typeShop" value="2" checked="" type="radio" name="type" onclick="shopClicked()">
            Магазин
          </label>
        </div>
        <div class="radio">
          <label>
            <input name="optionsRadios" id="typeBank" value="1" type="radio" name="type" onclick="bankClicked()">
            Хранителна банка
          </label>
        </div>
<!--         <div class="radio">
          <label>
            <input name="optionsRadios" id="typeAdmin" value="3" type="radio" name="type">
            Admin
          </label>
        </div> -->
      </div>
    </div>
    <div class="form-group" id="shop_reg">
      <div class="form-group">
        <label for="inputShopName" class="col-lg-2 control-label">Име на магазин</label>
        <div class="col-lg-10">
          <input class="form-control" id="inputShopName" placeholder="Shopname" type="text" name="shop_name">
        </div>
      </div>
      <div class="form-group">
        <label for="inputShopAddress" class="col-lg-2 control-label">Адрес</label>
        <div class="col-lg-10">
          <input class="form-control" id="inputShopAddress" placeholder="Address" type="text" name="shop_address">
        </div>
      </div>
      <div class="form-group">
        <label for="inputShopMobile" class="col-lg-2 control-label">Телефон</label>
        <div class="col-lg-10">
          <input class="form-control" id="inputShopMobile" placeholder="Mobile" type="text" name="shop_mobile">
        </div>
      </div>
      <div class="form-group">
        <label for="inputShopOwner" class="col-lg-2 control-label">Собственик</label>
        <div class="col-lg-10">
          <input class="form-control" id="inputShopOwner" placeholder="Owner" type="text" name="shop_owner">
        </div>
      </div>
      <div class="form-group">
        <label for="inputShopBul" class="col-lg-2 control-label">Булсат</label>
        <div class="col-lg-10">
          <input class="form-control" id="inputShopBul" placeholder="Bul" type="text" name="shop_bul">
        </div>
      </div>
      <div class="form-group">
        <label for="inputShopRegion" class="col-lg-2 control-label">Регион</label>
        <div class="col-lg-10">
          <input class="form-control" id="inputShopRegion" placeholder="Shopname" type="text" name="shop_region">
        </div>
      </div>
    </div>
    <div class="form-group" id="bank_reg">
      <div class="form-group">
          <label for="inputBankName" class="col-lg-2 control-label">Име на хранателна банка</label>
          <div class="col-lg-10">
            <input class="form-control" id="inputBankName" placeholder="Bankname" type="text" name="bank_name">
          </div>
        </div>
        <div class="form-group">
          <label for="inputBankRegion" class="col-lg-2 control-label">Регион</label>
          <div class="col-lg-10">
            <input class="form-control" id="inputBankRegion" placeholder="Bankregion" type="text" name="bank_region">
          </div>
        </div>
        <div class="form-group">
          <label for="inputBankOwner" class="col-lg-2 control-label">Собственик</label>
          <div class="col-lg-10">
            <input class="form-control" id="inputBankOwner" placeholder="Owner" type="text" name="bank_owner">
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

<script>
$( document ).ready(function() {
    // $( "#bank_reg" ).hide();
    $( "#shop_reg" ).hide();
});
</script>

<script>
function bankClicked()
{
  $( "#bank_reg" ).show();
  $( "#shop_reg" ).hide();
}
</script>
<script>
function shopClicked()
{
  $( "#bank_reg" ).hide();
  $( "#shop_reg" ).show();
}
</script>
