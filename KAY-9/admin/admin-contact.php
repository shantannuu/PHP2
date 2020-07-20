<?php

require '../_connection.php';

$sql = "SELECT * FROM `contacts`";
$result = mysqli_query($conn,$sql);

if(isset($_GET['type']) && $_GET['type']!= ''){
      $type = $_GET['type'];
      if($type=='delete'){
            $id = $_GET['id'];
            $delete_sql = "delete from contacts where contact_id='$id'";
            mysqli_query($conn,$delete_sql);
      }

}


?>

<?php
    include '../admin/adminpa/_mainHTMLheader.php';
?> 

<body>
    
    <!-- (NAVIGATION BAR) -->
    <?php
    include '../admin/adminpa/_adnav.php';
    ?>
    
    <!-- (SIDE NAV BAR) -->
    <?php
    include '../admin/adminpa/_adsidenav.php';
    ?>
     
    <!-- (HEADER) -->
    <?php
    include '../admin/adminpa/_header.php';

    ?>

    <!-- (MAIN CONTAINER) -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
              <?php
              if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true) {
                 echo '
                  <div style="display:flex;" >
                  <h2>Contacts</h2>
                  </div>
                
                  <div class="table-responsive">
                    <table class="table table-striped table-sm">
                      <thead>
                        <tr>
                          <th>contact_id</th>
                          <th>Name</th>
                          <th>E-mail</th>
                          <th>Phone</th>
                          <th>Queries</th>
                          <th>created_when</th>
                          <th>DELETE</th>
                        </tr>
                    </thead>
                    <tbody>';
                    $sno = 0;
                    while($row=mysqli_fetch_assoc($result)){
                        $id = $row['contact_id'];
                        $sno = $sno + 1;
                        echo '
                               <tr>
                                  <td>'. $sno . '</td>
                                  <td>' . $row['contact_name'] . '</td>
                                  <td>' . $row['contact_email'] . '</td>
                                  <td>' . $row['contact_phone'] . '</td>
                                  <td>' . $row['contact_comment'] . '</td>
                                  <td>' . $row['contact_time'] . '</td>
                                  <td> <a class="btn btn-danger" role="button" href="../admin/admin-contact.php?type=delete&id='. $id .'">Delete</a></td>
                               </tr>';
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
