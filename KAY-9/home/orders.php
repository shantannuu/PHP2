<?php

require '../home/partials/_connection.php';
$username = $_GET['username'];

$sql2 = "SELECT `orders`.*,order_status.status as order_status_str from `orders` , order_status  where `orders`.user_id='$username' and order_status.id = `orders`.order_status";
$result2 = mysqli_query($conn,$sql2);




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
<h3>YOUR ORDER DETAILS</h3>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Your Order ID and Details</th>
      <th scope="col">Order Date</th>
      <th scope="col">Address</th>
      <th scope="col">Payment type</th>
      <th scope="col">Payment Status</th>
      <th scope="col">Order Status</th>
    </tr>
  </thead>
  <tbody>
    
<?php
     while($row=mysqli_fetch_assoc($result2)){ 
    echo '<tr>
    <th scope="row"><a class="btn btn-primary" href="../home/details.php?id='. $row['id'] .'&user='. $username . '" role="button">'. $row['id'] .'</a></th>
      <td>'. $row['added_on'] .'</td>
      <td>'. $row['address'] .'</td>
      <td>'. $row['payment_method'] .'</td>
      <td>'. $row['payment_status'] .'</td>
      <td>'. $row['order_status_str'] .'</td>
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