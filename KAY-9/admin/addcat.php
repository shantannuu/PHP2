<?php

require '../_connection.php';

$exist = '';
$name ='';
$status='';
if(isset($_GET['id']) && $_GET['id']!=''){
    $id = $_GET['id'];
    $sql = "SELECT * FROM `categories` WHERE `category_id`='$id'";
    $result = mysqli_query($conn,$sql);
    $num = mysqli_num_rows($result);
    if($num > 0){
    $row = mysqli_fetch_assoc($result); 
    $name = $row['category_name'];
    $status = $row['category_status'] ;
}
else
{
    header("location: ../admin/admin-categories.php");
    die();
}
}

if(isset($_POST['submit'])){

    $name = $_POST['category_name'];
    $status = $_POST['category_status'];
    $sql = "SELECT * FROM `categories` WHERE `category_name`='$name' and `category_status`='$status'";
    $result = mysqli_query($conn,$sql);
    $num = mysqli_num_rows($result);
    if($num > 0){
        if(isset($_GET['id']) && $_GET['id']!=''){
            $get_data=mysqli_fetch_assoc($result);
            if($id == $get_data['category_id']){

            }
            else
            {
                $exist = '<div class="alert alert-danger my-3" role="alert">
                      Category already exist...!
                </div>';
            }
    }
    else
    {
        $exist = '<div class="alert alert-danger my-3" role="alert">
              Category already exist...!
        </div>';
       }
    }
    
    if($exist == ""){
    if(isset($_GET['id']) && $_GET['id']!=''){
        
        mysqli_query($conn,"UPDATE `categories` SET `category_name` = '$name', `category_status` = '$status' WHERE `categories`.`category_id` = '$id'");
        
    }else
    {
        
        mysqli_query($conn,"INSERT INTO `categories` (`category_name`, `category_status`, `time`) VALUES ('$name', '$status', current_timestamp());");
     
    }
    
    header("location: ../admin/admin-categories.php");
    die();
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
          echo '<form method="post">
                <div class="form-group">
                  <label for="category_name">Category_name :</label>
                  <input type="text" class="form-control" id="category_name" aria-describedby="emailHelp" name="category_name" value="'. $name .'"required>
                </div>
                <div class="form-group">
                  <label for="category_status">Category_status :</label>
                  <input type="text" class="form-control" id="category_status" name="category_status" value="'. $status .'"required>
                  <small id="emailHelp" class="form-text text-muted">submit (1) for active else (0) for deactive</small>
                </div>
                <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block">Submit</button>
                <?php  echo $exist;  ?>
              </form>';
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