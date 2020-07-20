<?php
session_start();
require '../home/partials/_connection.php';

require '../_add_to_carts.php';

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

$obj =new add_to_cart();

$totalproducts = $obj->totalproduct();
// prx($_SESSION['cart'])
if(!isset($_SESSION['cart']) || count($_SESSION['cart'])==0){
  ?>
  <script>
  window.location.href='../home/home.php';
  </script>
  <?php
}

$total = 0;
      
      foreach ($_SESSION['cart'] as $key => $value) {
          
     $productArr = get_product($conn,'','',$key);
    $price = $productArr[0]['price'];
   $qty = $_SESSION['cart'][$productArr[0]['id']]['qty'];
   $total = $total + ($price*$qty);
      }
// echo $_SESSION['username'];
// echo $total;
if($_SERVER['REQUEST_METHOD']=="POST"){
  $address = $_POST['address'];
  $city = $_POST['city'];
  $state = $_POST['state'];
  $zip = $_POST['zip'];
  $paymentmethod = $_POST['paymentmethod'];
  $userid = $_SESSION['username'];
  $price = $total;
  if($paymentmethod == 'COD'){
    $payment_status = 'success';
  }
  $order_status = "1";
  $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
  $sql = "INSERT INTO `orders` (`user_id`, `address`, `city`, `state`, `zip`, `payment_method`, `total_price`, `payment_status`, `order_status`, `txnid`,`mihpayid`,`payu_status`,`added_on`) VALUES ('$userid', '$address', '$city', '$state', '$zip', '$paymentmethod', '$total', '$payment_status', '$order_status', '$txnid','20','success',current_timestamp());";
  $result = mysqli_query($conn,$sql);

  $order_id = mysqli_insert_id($conn);
  $total = 0;
      
      foreach ($_SESSION['cart'] as $key => $value) {
          
     $productArr = get_product($conn,'','',$key);
    $price = $productArr[0]['price'];
   $qty = $_SESSION['cart'][$productArr[0]['id']]['qty'];
   $total = $total + ($price*$qty);
   $sql = "INSERT INTO `order_details` (`order_id`, `product_id`, `qty`, `price`, `added_on`) VALUES ('$order_id', '$key', '$qty', '$price', current_timestamp());";
  $result = mysqli_query($conn,$sql);
      }
      unset($_SESSION['cart']);

      if($paymentmethod == 'payu'){
  $MERCHANT_KEY = "gtKFFx"; 
  $SALT = "eCwWELxi";
  $hash_string = '';
  // $PAYU_BASE_URL = "https://secure.payu.in";
  $PAYU_BASE_URL = "https://test.payu.in";
  $action = '';
  $posted = array();
  if(!empty($_POST)) {
    foreach($_POST as $key => $value) {    
      $posted[$key] = $value; 
    }
  }
  $formError = 0;
 
  $posted['txnid']=$txnid;
  $posted['amount']=$total;
  $posted['firstname']=$userid;
  $posted['email']="shantanubolate@gmail.com";
  $posted['phone']="8879864123";
  $posted['productinfo']="productinfo";
  $posted['key']=$MERCHANT_KEY ;
  $hash = '';
  $hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
  if(empty($posted['hash']) && sizeof($posted) > 0) {
    if(
            empty($posted['key'])
            || empty($posted['txnid'])
            || empty($posted['amount'])
            || empty($posted['firstname'])
            || empty($posted['email'])
            || empty($posted['phone'])
            || empty($posted['productinfo'])
          
    ) {
      $formError = 1;
    } else {    
    $hashVarsSeq = explode('|', $hashSequence);
    foreach($hashVarsSeq as $hash_var) {
        $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
        $hash_string .= '|';
      }
      $hash_string .= $SALT;
      $hash = strtolower(hash('sha512', $hash_string));
      $action = $PAYU_BASE_URL . '/_payment';
    }
  } elseif(!empty($posted['hash'])) {
    $hash = $posted['hash'];
    $action = $PAYU_BASE_URL . '/_payment';
  }


  $formHtml ='<form method="post" name="payuForm" id="payuForm" action="'.$action.'"><input type="hidden" name="key" value="'.$MERCHANT_KEY.'" /><input type="hidden" name="hash" value="'.$hash.'"/><input type="hidden" name="txnid" value="'.$posted['txnid'].'" /><input name="amount" type="hidden" value="'.$posted['amount'].'" /><input type="hidden" name="firstname" id="firstname" value="'.$posted['firstname'].'" /><input type="hidden" name="email" id="email" value="'.$posted['email'].'" /><input type="hidden" name="phone" value="'.$posted['phone'].'" /><textarea name="productinfo" style="display:none;">'.$posted['productinfo'].'</textarea><input type="hidden" name="surl" value="http://localhost/PHP/KAY-9/payu/payment_complete.php" /><input type="hidden" name="furl" value="http://localhost/PHP/KAY-9/payu/payment_fail.php"/><input type="submit" style="display:none;"/></form>';
  echo $formHtml;
  echo '<script>document.getElementById("payuForm").submit();</script>';
  }else{

      ?>
  <script>
  window.location.href='../home/thankyou.php';
  </script>
  <?php
  }
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
   
    <title>E-commerce</title>
  </head>
  <body>



    <div class="container my-4">
 
  <div class="py-5 text-center">
   
    <h2>Checkout form</h2>
    
  </div>

  <div class="row">
    <div class="col-md-4 order-md-2 mb-4">
      <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted">Your cart</span>
        <span class="badge badge-secondary badge-pill" style="margin:0px -18%"><?php echo $totalproducts ?></span>
      </h4>
      <ul class="list-group mb-3" style="width:120%">
      <?php $total = 0;
      
      foreach ($_SESSION['cart'] as $key => $value) {
          
     $productArr = get_product($conn,'','',$key);
     
     $name = $productArr[0]['name'];
    $short_desc = $productArr[0]['short_description'];
    $image = $productArr[0]['image'];
    $price = $productArr[0]['price'];
   $qty = $_SESSION['cart'][$productArr[0]['id']]['qty'];
   $total = $total + ($price*$qty);
      
      ?>
        <li class="list-group-item d-flex justify-content-between lh-condensed">
          <div>
          
          <img src="../images/products/<?php echo $image?>" width="50px" height="50px" style="margin:10px 0px">
          
            <h6 class="my-0"><?php echo $name ?></h6>
            <small class="text-muted"><?php echo $short_desc ?></small>
          
          </div>
          <span class="text-muted">RS <?php echo $price*$qty ?></span>
        </li>
      <?php } ?>
        
    
        <li class="list-group-item d-flex justify-content-between">
          <span>Total For (<?php echo $totalproducts ?>)</span>
          <strong>RS <?php echo $total ?></strong>
        </li>
      </ul>
    </div>
    <div class="col-md-8 order-md-1">
      <h4 class="mb-3">Billing address</h4>
      <form class="needs-validation" novalidate method="post" action="../home/checkouts.php">
        

       


        <div class="mb-3">
          <label for="address">Address</label>
          <input type="text" class="form-control" id="address" placeholder="1234 Main St" name="address" required>
          <div class="invalid-feedback">
            Please enter your shipping address.
          </div>
        </div>

        <div class="row">
          <div class="col-md-5 mb-3">
            <label for="city">City</label>
            <select class="custom-select d-block w-100" id="city" name="city" required>
              <option value="">Choose...</option>
              <option>MUMBAI</option>
            </select>
            <div class="invalid-feedback">
              Please select a valid country.
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <label for="state">State</label>
            <select class="custom-select d-block w-100" id="state" name="state" required>
              <option value="">Choose...</option>
              <option>MAHARASHTRA</option>
            </select>
            <div class="invalid-feedback">
              Please provide a valid state.
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <label for="zip">Zip</label>
            <input type="text" class="form-control" id="zip" placeholder="" name="zip" required>
            <div class="invalid-feedback">
              Zip code required.
            </div>
          </div>
        </div>
        <hr class="mb-4">

        <h4 class="mb-3">Payment</h4>

        <div class="d-block my-3">
          <div class="custom-control custom-radio">
            <input id="credit" name="paymentmethod" type="radio" class="custom-control-input" value="COD" checked required>
            <label class="custom-control-label" for="credit">Cash On Delivery</label>
          </div>
          <div class="custom-control custom-radio">
            <input id="debit" name="paymentmethod" type="radio" class="custom-control-input" value="payu" required>
            <label class="custom-control-label" for="debit">PayU</label>
          </div>
        
        </div>
        
        <hr class="mb-4">
        <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>
      </form>
    </div>
  </div>
    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>

