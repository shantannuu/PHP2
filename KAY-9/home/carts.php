<?php
session_start();
require '../home/partials/_connection.php';

require '../_add_to_carts.php';


if(isset($_GET['id']) && isset($_GET['qty']) && isset($_GET['type']) && $_GET['id']!='' && $_GET['qty']!='' && $_GET['type']!=''){
    $pid = $_GET['id'];
    $qty = $_GET['qty'];
    $type = $_GET['type'];
    }else{
    
    }
    
    $obj =new add_to_cart();
    if(isset($_GET['id']) && isset($_GET['qty']) && isset($_GET['type']) && $_GET['id']!='' && $_GET['qty']!='' && $_GET['type']!=''){
    if($type == 'add'){
      $obj->addproduct($pid,$qty);
      
    }
    
    }

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

//   echo "total products are :" . $obj->totalproduct();
if($obj->totalproduct() == 0){
  header("location: ../home/home.php");
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
  .h3{
    display:flex;margin-top:10px;font-weight:bold;
  }
  .delivery{
    border:1px solid black;border-radius:5px;margin-top:10px;padding:10px 10px 0px 10px;font-size:15px
  }
  .borderr{
    border:1px solid black;border-radius:5px;margin-top:10px;

  }
  .btl{
    padding: 8px 165px;
  }
  .btp{
    display:none;
  }
  @media screen and (max-width: 992px) {
  .h3{
    margin:50px 100px ;
    width:100%;
  }
  .delivery{
    padding:21px 10px 21px 10px;
  }
  .borderr{
    border:none;
  }
  .btl{
    display:none;
  }
  .btp{
    display:inline-block;
    margin:10px 0;
    padding: 8px 165px;
  }
}
  </style>
  </head>
  <body>



    <div class="container">
    <div class="alert alert-light text-center" role="alert" style="margin:5px 0px;border-radius:0px;font-weight:bold;border-bottom:2px solid gray;padding-bottom:10px">
        <p style="color:red;display:inline-block">YOUR BAG</p> ---- YOUR DETAILS ---- CHECKOUT
   </div>
   <div class="container my-5" style="display:flex;font-family:Whitney,Helvetica,Arial,sans-serif!important">
   <div class="left" style="width:60%">
   <div class="offers" style="border:1px solid black;border-radius:5px;">
      <h6 style="font-weight:bold;padding:10px 20px 5px 20px"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" class="offersV2-base-discountIcon"><g fill="#000" fill-rule="evenodd"><path d="M15.292 10.687v.001c-.198.742.076 1.454.296 2.026l.045.12-.137.021c-.602.094-1.352.211-1.892.75-.538.54-.655 1.288-.748 1.89l-.022.138a22.096 22.096 0 0 1-.12-.045c-.443-.171-.946-.364-1.49-.364-.185 0-.366.023-.536.068-.728.194-1.198.78-1.577 1.249-.032.04-.07.088-.111.137l-.112-.138c-.378-.47-.848-1.054-1.575-1.248a2.092 2.092 0 0 0-.537-.068c-.543 0-1.046.193-1.49.364l-.12.045-.022-.138c-.093-.602-.21-1.35-.749-1.89-.539-.539-1.289-.656-1.891-.75l-.137-.022a15 15 0 0 1 .045-.118c.22-.573.494-1.286.296-2.027-.194-.728-.78-1.199-1.25-1.577L1.323 9l.137-.11c.47-.38 1.055-.85 1.249-1.577.198-.742-.076-1.455-.296-2.028l-.045-.118.137-.022c.602-.094 1.352-.211 1.891-.75.54-.539.656-1.289.75-1.891l.022-.137.119.045c.443.171.947.365 1.49.365.186 0 .367-.024.537-.07.727-.193 1.198-.778 1.576-1.248L9 1.322l.111.137c.379.47.85 1.055 1.576 1.249.17.045.352.069.537.069.544 0 1.047-.194 1.491-.365l.119-.045.022.137c.094.602.21 1.353.75 1.891.538.539 1.288.656 1.89.75l.138.022-.046.119c-.22.572-.494 1.285-.295 2.026.194.728.778 1.199 1.248 1.577.04.033.088.07.137.111l-.137.11c-.47.38-1.054.85-1.249 1.577M18 9c0-.744-1.459-1.286-1.642-1.972-.19-.71.797-1.907.437-2.529-.364-.63-1.898-.372-2.41-.884-.511-.511-.253-2.045-.883-2.41a.647.647 0 0 0-.33-.08c-.585 0-1.403.542-1.998.542a.778.778 0 0 1-.201-.025C10.286 1.46 9.743 0 9 0c-.744 0-1.286 1.459-1.972 1.642a.78.78 0 0 1-.2.025c-.596 0-1.414-.542-2-.542a.647.647 0 0 0-.33.08c-.63.365-.37 1.898-.883 2.41-.512.512-2.046.254-2.41.884-.36.62.627 1.819.437 2.529C1.46 7.714 0 8.256 0 9s1.459 1.286 1.642 1.972c.19.71-.797 1.908-.437 2.53.364.63 1.898.371 2.41.883.511.512.253 2.045.884 2.41.097.056.208.08.33.08.585 0 1.403-.542 1.998-.542a.78.78 0 0 1 .201.025C7.714 16.54 8.256 18 9 18s1.286-1.46 1.973-1.642a.774.774 0 0 1 .2-.025c.595 0 1.413.542 1.998.542a.647.647 0 0 0 .33-.08c.631-.365.373-1.898.884-2.41.512-.512 2.046-.254 2.41-.884.36-.62-.627-1.819-.437-2.529C16.54 10.286 18 9.744 18 9"></path><path d="M10.897 6.34l-4.553 4.562a.536.536 0 0 0 .76.758l4.552-4.562a.536.536 0 0 0-.76-.758M6.75 7.875a1.126 1.126 0 0 0 0-2.25 1.126 1.126 0 0 0 0 2.25M11.25 10.125a1.126 1.126 0 0 0 0 2.25 1.126 1.126 0 0 0 0-2.25"></path></g></svg> Available Offers</h6>
      <p style="padding:0px 20px;font-size:15px">10% Cashback upto Rs 500 on a minimum spend of Rs 1,000 with PayZapp. TCA</p>
      <a href="#" style="color:red;font-weight:bold;padding:0px 20px">Show more  <svg xmlns="http://www.w3.org/2000/svg"  width="7" height="12" viewBox="0 0 7 12" class="offersV2-base-arrowIcon" style="transform: rotate(90deg);"><path fill-rule="evenodd" d="M6.797 5.529a.824.824 0 0 0-.042-.036L1.19.193a.724.724 0 0 0-.986 0 .643.643 0 0 0 0 .94L5.316 6 .203 10.868a.643.643 0 0 0 0 .938.724.724 0 0 0 .986 0l5.566-5.299a.644.644 0 0 0 .041-.978"></path></svg></a>
   </div>
   <div class="delivery">
   <p><svg width="24px" height="24px" viewBox="0 0 16 16" class="bi bi-truck" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5v7h-1v-7a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .5.5v1A1.5 1.5 0 0 1 0 10.5v-7zM4.5 11h6v1h-6v-1z"/>
  <path fill-rule="evenodd" d="M11 5h2.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5h-1v-1h1a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4.5h-1V5zm-8 8a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0 1a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/>
  <path fill-rule="evenodd" d="M12 13a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0 1a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/>
</svg> Shop for $360 more to get <b>Free delivery.</b></p>
   </div>
   <div class="h3">
   <?php
   if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
     ?>
   <h5 style="font-weight:bold;">My shopping Bag (<?php echo $obj->totalproduct()?> items)</h5>
   
   </div>
   <?php foreach ($_SESSION['cart'] as $key => $value) {
     $productArr = get_product($conn,'','',$key);
    $name = $productArr[0]['name'];
    $short_desc = $productArr[0]['short_description'];
    $image = $productArr[0]['image'];
    $price = $productArr[0]['price'];
   $qty = $_SESSION['cart'][$productArr[0]['id']]['qty'];
   if(isset($_GET['updateid']) && $_GET['updateid']!=''){
    $qty = $_GET['qty'];
    //    echo $qty;
       $updateid = $_GET['updateid'];
    //    echo $updateid;
       $typess = $_GET['typess'];
    //    echo $typess;
       if($typess == 'update'){
           $obj->updateproduct($updateid,$qty);
       }
    }
    else{
    
    }
   
    
   echo '<div class="borderr"><div class="content" style="display:flex;max-height:200px">
   <img src="../images/products/'. $image .'" width="200px" height="185px" style="margin:10px">
      <div class="para">
      <p style="margin:10px">Product name :'. $name .' </p>
      <p style="margin:10px">short_description : '. $short_desc .'</p>
      <form action="../home/carts.php" method="get" style="padding-left:8px">
      quantity :<input type="text" name="qty" id="qty" style="margin:10px" value="'. $_SESSION['cart'][$productArr[0]['id']]['qty'] .'">
      <input type="hidden" id="typess" name="typess" value="update"> 
      <input type="hidden" id="updateid" name="updateid" value="'. $productArr[0]['id'] .'">
        <button class="btn btn-sm btn-primary" type="submit">Add IF Want more</button>
      </form>
      <p style="margin:10px">price : '. $price .'</p>
      </div>
      
   </div>
   <div style="display:flex">
   <a href="../home/carts.php?removeid='. $productArr[0]['id'] .'&type=remove" role="button" class="btn" style="margin:10px 50px;border-right:1px solid black;border-radius:0px;padding:0px 80px">Remove</a>
   <a href="#" role="button" class="btn" style="margin:10px 8px;padding:0px 32px">Add To Whishlist</a>
   </div>
   </div>';
   
   
}
if(isset($_GET['removeid']) && $_GET['removeid']!=''){
    $removeid = $_GET['removeid'];
    //    echo $removeid;
       $types = $_GET['type'];
    //    echo $types;
       if($types == 'remove'){
           $obj->removeproduct($removeid);
       }
    }
    else{
    
    }


   ?>
   <?php
   }else{
     echo 'YOUR CART IS EMPTY';
   }

?>
<div style="margin-top:10px">
   <a class="btn btn-primary btn-block" href="../home/home.php">HOME</a>
   <?php
   if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
echo '<a class="btn btn-primary  btp" href="../home/checkouts.php">CHECKOUT</a>';
}else{
  echo '<a class="btn btn-primary btp" href="../home/register.php">CHECKOUT</a>';
}
   ?> 
   </div>
   </div>
   <?php
   if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
     ?>
    <div class="col-md-4 order-md-2 mb-4">
      <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted">Your cart</span>
        <span class="badge badge-secondary badge-pill" style="margin:0px -25%"><?php echo $obj->totalproduct() ?></span>
      </h4>
      <ul class="list-group mb-3" style="width:128%">
      <?php $total = 0;
      foreach ($_SESSION['cart'] as $key => $value) {
     $productArr = get_product($conn,'','',$key);
    $name = $productArr[0]['name'];
    $short_desc = $productArr[0]['short_description'];
    $image = $productArr[0]['image'];
    $price = $productArr[0]['price'];
   $qty = $_SESSION['cart'][$productArr[0]['id']]['qty'];
   $total = $total + ($price*$qty);
      echo '<li class="list-group-item d-flex justify-content-between lh-condensed">
          <div>
            <h6 class="my-0">' . $name . '</h6>
            <small class="text-muted">'.$short_desc.'</small>
          </div>
          <span class="text-muted">RS '.  $price*$qty . '</span>
        </li>';
      }
        ?>
        <li class="list-group-item d-flex justify-content-between">
          <span>Total For (<?php echo $obj->totalproduct() ?>)<span>
          <strong style="position:absolute;right:5%">RS <?php echo $total ?></strong>
        </li>
      </ul>
      <?php
   if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
echo '<a class="btn btn-primary btl" href="../home/checkouts.php">CHECKOUT</a>';
}else{
  echo '<a class="btn btn-primary btl" href="../home/register.php">CHECKOUT</a>';
}
   ?> 
   </div>
   <?php
   }
   ?>
</div>
    </div>


<div class="footer" style="padding:20px;background-color:black;margin-top:135px">
 <h6 class="text-center" style="color:white">All Right Reserved &copy | 2020 </h6>
</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>