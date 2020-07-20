<?php

require '../_connection.php';

$sql = "SELECT * FROM `products`";
$result = mysqli_query($conn,$sql);
if(isset($_GET['type']) && $_GET['type']!= ''){
    $type = $_GET['type'];
    if($type=='status'){
        $operation = $_GET['operation'];
        $id = $_GET['id'];
        if($operation=='active'){
            $stat = '1';
        }
        else
        {
            $stat = '0';
        }
        $update_sql = "update products set status='$stat' where id='$id'";
        mysqli_query($conn,$update_sql);
    }
    if($type=='delete'){
        
        $id = $_GET['id'];
        
        $delete_sql = "delete from products where id='$id'";
        mysqli_query($conn,$delete_sql);
    }

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
        <?php
              $sql = "select products.*,categories.category_name from products,categories where products.categories_id=categories.category_id order by products.id desc";
              $result = mysqli_query($conn,$sql);
              if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true) {
                echo '<div style="display:flex;" >
                  <h2>Products</h2>
                  <a href="../admin/addproduct.php" class="btn btn-outline-primary mx-2" role="button" style="position:absolute;right:20px;">
                      Add Products <span class="badge badge-dark">+</span>
                      <span class="sr-only">unread messages</span>
                  </a>
                  </div>
                  <div class="table-responsive">
                        <table class="table table-striped table-sm">
                          <thead>
                            <tr>
                                <th>id</th>
                                <th>Category</th>
                                <th>Name</th>
                                <th>$MRP</th>
                                <th>$Price</th>
                                <th>Quantity</th>
                                <th>Short Description</th>
                                <th>image</th>
                                <th>status</th>
                            </tr>
                          </thead>
                          <tbody>';
                    $sno = 0;
                    while($row=mysqli_fetch_assoc($result)){
                        $id = $row['id'];
                        $sno = $sno + 1;
                        echo '<tr>
                                  <td>'. $sno . '</td>
                                  <td>' . $row['category_name'] . '</td>
                                  <td>' . $row['name'] . '</td>
                                  <td>' . $row['mrp'] . '</td>
                                  <td>' . $row['price'] . '</td>
                                  <td>' . $row['qty'] . '</td>
                                  <td>' . $row['short_description'] . '</td>
                                  <td><img src="../images/products/'.$row['image'].'" width="150px" height="150px"></td>
                                  <td>';
                        if($row['status']==1){
                              echo "<a class='btn btn-primary mx-2' role='button'  href='../admin/admin-product.php?type=status&operation=deactive&id=". $row['id'] ."'>Active</a>";
                          }
                          else{
                              echo "<a class='btn btn-dark mx-2' role='button' href='../admin/admin-product.php?type=status&operation=active&id=". $row['id'] ."'>Deactive</a>";
                          }
                          echo '<a class="btn btn-danger" role="button" href="../admin/admin-product.php?type=delete&id='. $id .'">Delete</a>';
                          echo "<a class='btn btn-success mx-2' role='button' href='../admin/addproduct.php?id=". $row['id'] ."'>Edit</a>";
                          echo '</td>
                          </tr>  
                          ';
                    }
                  
                    echo '</tbody>
                  </table>
                </div>';
                    } 
              
              else{
                  echo '<div class="jumbotron">
                      <h1 class="display-4">Welcome To Admin</h1>
                      <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
                      <hr class="my-4">
                      <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
                  </div>';
              }
          ?>
        </main>
</body>
<?php
    include '../admin/adminpa/_mainHTMLfooter.php';
?> 
