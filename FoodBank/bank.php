<?php
require('config.php');
session_start();
if(!isset($_SESSION['user']))
{
  header("Location: http://127.0.0.1/FoodBank/bank.php");
}
$user = $_SESSION['user'];
$user_id = $_SESSION['user_id'];

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
<form class="form-horizontal" method="post" action="http://127.0.0.1/FoodBank/bank.php">
  <fieldset>
    <legend class="text-center"></legend>
    <div class="form-group">
      <label for="inputProduct" class="col-lg-2 control-label">Име на продукта</label>
      <div class="col-lg-10">
        <input class="form-control" id="inputProduct" placeholder="Име на продукта" type="text" name="search_name">
      </div>
    </div>
    <div class="form-group">
      <label for="inputQuantity" class="col-lg-2 control-label">Количество</label>
      <div class="col-lg-10">
        <input class="form-control" id="inputQuantity" placeholder="Количество" type="text" name="search_quantity">
      </div>
    </div>
    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
        <button type="reset" class="btn btn-default">Отказ</button>
        <button type="submit" class="btn btn-primary">Търси</button>
      </div>
    </div>
  </fieldset>
</form>

<table class="table table-striped table-hover table-bordered table-condensed">
  <thead>
    <tr>
      <th>#</th>
      <th>Име на продукта</th>
      <th>Магазин</th>
      <th>Телефон</th>
      <th>Количество</th>
    </tr>
  </thead>
  <tbody>
    <?php
    if(isset($_POST['search_name']))
    {
      $product_name=$_POST['search_name'];
      $sql = "SELECT products.name, products.quantity, shops.address, shops.mobile,shops.name as shop_name FROM products inner join shops on shops.id=products.shop_id inner join foodbanks on foodbanks.user_id=shops.id where products.name='$product_name' and foodbanks.user_id= '$user_id' order by products.expiration_date asc";
      // echo $sql;
      
      foreach ($connection->query($sql) as $row) {
        
          echo "<tr>";
          echo "<th> </th>";
          echo "<th>".$row['name']."</th>";
          echo "<th>".$row['shop_name']."</th>";
          echo "<th>".$row['mobile']."</th>";
          echo "<th>".$row['quantity']."</th>";
          echo "</tr>";
        }
    }
    ?>
  </tbody>
</table>
</div>
</body>
</html>



