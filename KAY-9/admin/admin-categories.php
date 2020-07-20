<?php

require '../_connection.php';

$sql = "SELECT * FROM `categories`";
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
        $update_sql = "update categories set category_status='$stat' where category_id='$id'";
        mysqli_query($conn,$update_sql);
    }
    if($type=='delete'){
        
          $id = $_GET['id'];
          $delete_sql = "delete from categories where category_id='$id'";
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
                  if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true) {
                      echo '
                          <div style="display:flex;" >
                          <h2>Categories</h2>
                          <a href="../admin/addcat.php" class="btn btn-outline-primary mx-2" role="button" style="position:absolute;right:20px;">
                              Add categories <span class="badge badge-dark">+</span>
                              <span class="sr-only">unread messages</span>
                          </a></div>
                        
                        <div class="table-responsive">
                          <table class="table table-striped table-sm">
                            <thead>
                              <tr>
                                <th>category_Id</th>
                                <th>category_Name</th>
                                <th>created_when</th>
                                <th>category_status</th>
                              </tr>
                            </thead>
                            <tbody>';
                        $sno = 0;
                        while($row = mysqli_fetch_assoc($result)){
                            $sno = $sno + 1;
                            echo '<tr>
                                    <td>' . $sno . '</td>
                                    <td>' . $row['category_name'] . '</td>
                                    <td>' . $row['time'] . '</td>
                                    <td>';
                                    if($row['category_status']==1){
                                          echo "<a class='btn btn-primary mx-2' role='button'  href='../admin/admin-categories.php?type=status&operation=deactive&id=". $row['category_id'] ."'>Active</a>";
                                      }
                                      else{
                                          echo "<a class='btn btn-dark mx-2' role='button' href='../admin/admin-categories.php?type=status&operation=active&id=". $row['category_id'] ."'>Deactive</a>";
                                      }
                                    echo "<a class='btn btn-danger' role='button' href='../admin/admin-categories.php?type=delete&id=". $row['category_id'] ."'>Delete</a>";
                                    echo "<a class='btn btn-success mx-2' role='button' href='../admin/addcat.php?id=". $row['category_id'] ."'>Edit</a>";
                                    echo '</td>
                                  </tr>';
                        }
                        echo '</tbody>
                      </table>
                    </div>';
                    
                  }else
                  {
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