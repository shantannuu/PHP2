<?php

require '../home/partials/_connection.php';
$orderid = $_GET['id'];
$user = $_GET['user'];
$sql3 = "SELECT distinct(order_details.id), order_details.*,products.name,products.image from order_details,products,`orders` where order_details.order_id='$orderid' and `orders`.user_id='$user' and products.id = order_details.product_id";
$result3 = mysqli_query($conn,$sql3);
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
 
  </style>
  </head>
  <body>
  <?php
  $page = false;
        include "../home/partials/_nav.php";
        
  ?>

<div class="container my-4">
<h3>YOUR PRODUCTS DETAILS</h3>
<table class="table">
  <thead>
 
    <tr>
      <th scope="col">Product Name</th>
      <th scope="col">Product Image</th>
      <th scope="col">Qty</th>
      <th scope="col">Price</th>
      <th scope="col">Total Price</th>
    </tr>
  </thead>
  <tbody>
  <?php
     while($row3=mysqli_fetch_assoc($result3)){ 
    echo '
    <tr>
      <th scope="row">' . $row3['name'] . '</th>
      <td><img src="../images/products/' . $row3['image'] . '" width="300px" height="300px" style="border:2px solid black;border-radius:6px"></td>
      <td>' . $row3['qty'] . '</td>
      <td>' . $row3['price'] . '</td>
      <td>' . $row3['qty']*$row3['price'] . '</td>
    </tr>';
     }
    ?>
    
  </tbody>
</table>
</div>
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