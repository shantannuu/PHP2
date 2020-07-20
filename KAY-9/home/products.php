<?php
require '../home/partials/_connection.php';
function get_product($conn,$limit='',$catid='',$productid=''){
            
  $sql = "SELECT * FROM `products` WHERE `status`='1'";
  if($catid!=''){
      $sql.=" and categories_id=$catid ";
  }
  if($productid!=''){
      $sql.=" and id=$productid ";
  }
  
  if($limit!=''){
      $sql.="limit $limit";
  }
  $result=mysqli_query($conn,$sql);
  $product=Array();
  while($row=mysqli_fetch_assoc($result)){
      $product[]=$row;
  }
  return $product;
}

$productid = $_GET["id"];
if($productid > 0){
 
 
}else{
  ?>
  <script>
  window.location.href='../home/demo.php';
  </script>
  <?php
}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
   
    <link href="https://fonts.googleapis.com/css2?family=Rowdies&display=swap" rel="stylesheet">
    <title>E-commerce</title>
    <style>
  *{
    font-family: 'Rowdies', cursive;
  }
  .carousel-indicators li{
    background-color:black;
  }
  @media screen and (max-width: 992px) {
  .container{
    flex-direction:column;
  }
  .btnn{
    margin: 10px auto;
  }
}
  </style>
  </head>
  <body>
  <?php
   $page = false;
        include "../home/partials/_nav.php";
  ?>

<?php
$sql = "SELECT * FROM `products` WHERE `id`='$productid'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);

echo '<div class="container" style="margin:150px auto;display:flex;" >
<div class="image">
<img src="../images/products/'. $row['image'] .'" width="500px" height="500px" >
</div>
<div class="content" style="margin:10px 0 0 10%;width:40%">
<div class="name">
<h3>'. strtoupper($row['name']) .' </h3>
</div>
<div class="shortdesc" style="font-size:18px;color:pink">
<p>'. $row['short_description'] .' </p>
</div>
<div class="price" style="font-size:20px;font-weight:bold">
<p style="margin:5px auto">'. $row['price'] .' RS -('. $row['mrp'] .' MRP) 100 RS OFF</p>
<p style="font-weight:100">inclusive all taxes</p>
<form action="../home/carts.php" method="get">
<input type="hidden" name="id" value="'. $row['id'] .'">
<input type="hidden" name="type" value="add">
<div class="form-group">
    <label for="qty">Quantity :</label>
    <select class="form-control" id="qty" name="qty">';
    $qrow = 1;
      while($qrow <= $row['qty']){
      echo '<option>'. $qrow .'</option>';
      $qrow = $qrow + 1;
      }
    echo '</select>
  </div>';
  if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
echo '<button type="submit" class="btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart">
<circle cx="9" cy="21" r="1"></circle>
<circle cx="20" cy="21" r="1"></circle>
<path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
</svg>&nbsp&nbsp&nbspADD TO CART</button>';
  }else{
    echo '<a href="../home/registers.php?productid='. $productid .'" role="button" class="btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart">
<circle cx="9" cy="21" r="1"></circle>
<circle cx="20" cy="21" r="1"></circle>
<path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
</svg>&nbsp&nbsp&nbspADD TO CART</a>';
  }
  

echo '<a href="#" role="button" class="btn btn-danger mx-4 btnn"><svg width="24" height="24" viewBox="0 0 16 16" class="bi bi-bag" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" d="M14 5H2v9a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V5zM1 4v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4H1z"/>
<path d="M8 1.5A2.5 2.5 0 0 0 5.5 4h-1a3.5 3.5 0 1 1 7 0h-1A2.5 2.5 0 0 0 8 1.5z"/>
</svg>&nbsp&nbsp&nbspWHISHLIST</a>
</form>
</div>
<div class="description" style="margin:35px auto;font-size:18px">
<p>'. $row['description'] .' </p>
</div>
<div class="meta">
<p><b>Product id :</b> '. $row['id'] .' </p>
</div>
</div>

</div>';

?>

<?php

$sql = "SELECT products.*,categories.* FROM products,categories WHERE products.id=$productid and products.categories_id=categories.category_id";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_assoc($result);
      $category_id = $row['category_id'];
                echo '<nav aria-label="breadcrumb" style="padding:10px 10%">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="../home/home.php">Home</a></li>
                  <li class="breadcrumb-item"><a href="../home/categories.php?catid='. $category_id .'&name='. $row['category_name'] .'">'. $row['category_name'] .'</a></li>
                  <li class="breadcrumb-item active" aria-current="page">'. $row['name'] .'</li>
                </ol>
              </nav>';


?>

<div class="footer" style="padding:20px;background-color:black;">
 <h6 class="text-center" style="color:white">All Right Reserved &copy | 2020 </h6>
</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>