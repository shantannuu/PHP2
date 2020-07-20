<?php

require '../_connection.php';
$sql2 = "SELECT `orders`.*,order_status.status as order_status_str from `orders` , order_status  where order_status.id = `orders`.order_status";
$result2 = mysqli_query($conn,$sql2);
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
        <h3>ORDER DETAILS</h3>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Order ID and Details</th>
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
    <th scope="row"><a class="btn btn-primary" href="../admin/admin-proorder.php?id='. $row['id'] .'&user='. $row['user_id'] . '" role="button">'. $row['id'] .'</a></th>
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

        </main>
</body>
<?php
    include '../admin/adminpa/_mainHTMLfooter.php';
?> 