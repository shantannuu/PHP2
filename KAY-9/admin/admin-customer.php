<?php

require '../_connection.php';
$sql = "SELECT * FROM `customers`";
$result = mysqli_query($conn,$sql);

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
                echo '<div style="display:flex;" >
                  <h2>Customer Details</h2>
                  </div>
                
                  <div class="table-responsive">
                      <table class="table table-striped table-sm">
                        <thead>
                          <tr>
                            <th>customer_id</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Created_when</th>
                          </tr>
                        </thead>
                        <tbody>';
                        $sno = 0;
                        while($row=mysqli_fetch_assoc($result)){
                            $id = $row['customer_id'];
                            $sno = $sno + 1;
                            echo '<tr>
                                    <td>'. $sno . '</td>
                                    <td>' . $row['username'] . '</td>
                                    <td>' . $row['password'] . '</td>
                                    <td>' . $row['time'] . '</td>
                                    </tr>';
                        }
                        echo '</tbody>
                        </table>
                      </div>';
                    } 
                    else
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
