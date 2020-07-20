<?php

require '../home/partials/_connection.php';

$search = $_GET['search'];

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
  </style>
  </head>
  <body>
  <?php
  $page = false;
        include "../home/partials/_nav.php";
        
  ?>

<div class="container my-4">
    <h1  class="text-center">The product You Looking at..  `<?php echo $search ?>`</h1>
   
    <div class="row">
    <?php
            $sql = "SELECT * FROM `products` WHERE match (`name`,`short_description`,`description`) against ('$search')";
            $result = mysqli_query($conn,$sql);
            $num = mysqli_num_rows($result);
            if($num > 0){
             while($row=mysqli_fetch_assoc($result)){
              $productid = $row['id'];     
    echo '<div class="col-md-4 my-3 ">
        <div class="card" style="width: 22rem; border:none ;">
        <a href="../home/products.php?id='. $productid .'"><img  src="../images/products/'. $row['image'] .'" class="card-img-top" alt="..." style="border-radius:10px;height:400px ;border:1px solid black"></a>
        <div class="card-body">
            <h5 class="card-title text-center">'. $row['name'].'</h5>
            <p class="card-text text-center">'. $row['description'] .'</p>
            
        </div>
        </div>
        </div>';
             }
            }else{
                echo '<p class="muted-text">NO PRODUCTS FOUND...!</p>';
            }
                ?>
        
    </div>
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