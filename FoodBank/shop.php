
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
<form class="form-horizontal">
  <fieldset>
    <legend class="text-center"></legend>
    <div class="form-group">
      <label for="inputProduct" class="col-lg-2 control-label">Име на продукта </label>
      <div class="col-lg-10">
        <input class="form-control" id="nameProduct" placeholder="Принос" type="text" name="">
      </div>
    </div>
    <div class="form-group">
      <label for="inputProduct" class="col-lg-2 control-label">Тип на продукт</label>
      <div class="col-lg-10">
        <input class="form-control" id="TypeProduct" placeholder="Принос" type="text" name="">
      </div>
    </div>
    <div class="form-group">
      <label for="inputProduct" class="col-lg-2 control-label">Количество</label>
      <div class="col-lg-10">
        <input class="form-control" id="QuantityProduct" placeholder="Принос" type="text" name="">
      </div>
    </div>
    <div class="form-group">
      <label for="inputProduct" class="col-lg-2 control-label">Цена на единица</label>
      <div class="col-lg-10">
        <input class="form-control" id="PPUroduct" placeholder="Принос" type="text" name="">
      </div>
    </div>
    <div class="form-group">
      <label for="inputProduct" class="col-lg-2 control-label">Изтичане на срок</label>
      <div class="col-lg-10">
        <input class="form-control" id="ExpirationDateProduct" placeholder="Принос" type="text" name="">
      </div>
    </div>
    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
        <a class="btn btn-primary" onclick="addProduct()">Добави нов продукт</a>
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
      <th>Количество</th>
      <th>Цена на единица</th>
      <th>Срок на годност</th>
    </tr>
  </thead>
  <tbody id="addedElements">

  </tbody>
</table>
</div>
</body>
</html>


<script>
function addProduct() {

    var product_name = $( "#nameProduct" ).val();
    var product_type = $( "#TypeProduct" ).val();
    var product_quantity = $( "#QuantityProduct" ).val();
    var product_ppu= $( "#PPUroduct" ).val();
    var product_expiration = $( "#ExpirationDateProduct" ).val();
    
    var additional = "";
    additional=additional.concat("<tr>");
    additional=additional.concat("<th>");
    additional=additional.concat("</th>");
    additional=additional.concat("<th>");
    additional=additional.concat(product_name);
    additional=additional.concat("</th>");
    additional=additional.concat("<th>");
    additional=additional.concat(product_type);
    additional=additional.concat("</th>");
    additional=additional.concat("<th>");
    additional=additional.concat(product_quantity);
    additional=additional.concat("</th>");
    additional=additional.concat("<th>");
    additional=additional.concat(product_ppu);
    additional=additional.concat("</th>");
    additional=additional.concat("<th>");
    additional=additional.concat(product_expiration);
    additional=additional.concat("</th>");
    additional=additional.concat("</tr>");


    var html = $( "#addedElements" ).html();
    html = html.concat(additional);

    $( "#addedElements" ).html(html);
    
    $.ajax({
    type: "POST",
    url: "ajax.php",
    data: {
              producName : product_name,
              productType : product_type,
              productQuantity : product_quantity,
              productPpu : product_ppu,
              productExpiration : product_expiration},
    dataType: "text",

    success: function(data) {
        console.log(data);
    },
    error: function(data){
    //alert("fail");
      console.log(data);
    }

    });

}
</script>