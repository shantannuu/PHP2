<?php

require '../_connection.php';
$orderid = $_GET['id'];
$user = $_GET['user'];
$sql3 = "SELECT distinct(order_details.id), order_details.*,products.name,products.image from order_details,products,`orders` where order_details.order_id='$orderid' and `orders`.user_id='$user' and products.id = order_details.product_id";
$result3 = mysqli_query($conn,$sql3);
$total = 0;
if($_SERVER['REQUEST_METHOD']== 'POST'){
    $update_id = $_POST['update_id'];
    echo $update_id;
    echo $orderid;
    mysqli_query($conn,"update `orders` set order_status='$update_id' where id='$orderid'");
    
}
?>

<?php
    include '../admin/adminpa/_mainHTMLheader.php';
?> 

<body>
    
    <?php
    include '../admin/adminpa/_adnav.php';
    ?>
    
    <?php
    include '../admin/adminpa/_adsidenav.php';
    ?>
     
    <?php
    include '../admin/adminpa/_header.php';

    ?>
        
        
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <h3>THEIR PRODUCT DETAILS</h3>
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
         $total = $total + $row3['qty']*$row3['price'];
         
    echo '
    <tr>
      <th scope="row">' . $row3['name'] . '</th>
      <td><img src="../images/products/' . $row3['image'] . '" width="300px" height="300px" style="border:2px solid black;border-radius:6px"></td>
      <td>' . $row3['qty'] . '</td>
      <td>' . $row3['price'] . '</td>
      <td>' . $row3['qty']*$row3['price'] . '</td>
      
    </tr>
    ';
     }
    ?>
    
  </tbody>
</table>

<div><?php echo "Total Price :" . $total ?></div>
<?php
$change = mysqli_fetch_assoc(mysqli_query($conn,"SELECT `orders`.*,order_status.status as order_status_str from `orders` , order_status  where `orders`.user_id='$user' and order_status.id = `orders`.order_status"));

?>

<?php
echo '<form method="post" action="../admin/admin-proorder.php?id='. $orderid .'&user='. $user . '">';
?>
<div class="form-group">
              <label for="id">Order Status</label>
              
              <select class="form-control" id="id" name="update_id">
                <option>select status</option>
               
                <?php
                $result = mysqli_query($conn,"select id,status from order_status");
                  while($row=mysqli_fetch_assoc($result)){
                    if($row['id']==$categories_id){
                      echo '<option selected value="'. $row['id'] .'">'. $row['status'] .'</option> ';
                    }
                    else
                    {
                      echo '<option value="'. $row['id'] .'">'. $row['status'] .'</option> ';
                    }
                  }
                ?>
                <?php
                echo '
              </select>
            </div>';
            ?>
            <button type="submit" class="btn btn-primary btn-lg btn-block">Block level button</button>
            </form>
        </main>
</body>
<?php
    include '../admin/adminpa/_mainHTMLfooter.php';
?> 