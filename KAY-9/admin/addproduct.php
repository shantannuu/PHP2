<?php

require '../_connection.php';

$exist = '';
$name ='';
$categories_id ='';
$brand_id ='';
$mrp ='';
$price ='';
$qty ='';
$short_description ='';
$description ='';
$meta_title ='';
$meta_description ='';
$meta_keyword ='';
$status='';
$required_image = 'required';

if(isset($_GET['id']) && $_GET['id']!=''){
    $required_image= '';
    $id = $_GET['id'];
    $sql = "SELECT * FROM `products` WHERE `id`='$id'";
    $result = mysqli_query($conn,$sql);
    
    $num = mysqli_num_rows($result);
    if($num > 0){
        $row = mysqli_fetch_assoc($result); 
        $name = $row['name'];
        $categories_id = $row['categories_id'];
        $brand_id = $row['brand_id'];
        $mrp = $row['mrp'];
        $price = $row['price'];
        $qty = $row['qty'];
        $short_description = $row['short_description'];
        $description = $row['description'];
        $meta_title = $row['meta_title'];
        $meta_description = $row['meta_description'];
        $meta_keyword = $row['meta_keyword'];
        $status = $row['status'] ;
    }
    else
    {
      header("location: ../admin/admin-product.php");
      die();
    }
}

if(isset($_POST['submit'])){

    $name = $_POST['name'];
    $categories_id = $_POST['categories_id'];
    $brand_id = $_POST['brand_id'];
    $mrp = $_POST['mrp'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];
    $short_description = $_POST['short_description'];
    $description = $_POST['description'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keyword = $_POST['meta_keyword'];
    $status = $_POST['status'] ;
    $sql = "SELECT * FROM `products` WHERE `name`='$name'";
    $result = mysqli_query($conn,$sql);
    $num = mysqli_num_rows($result);
    if($num > 0){
        if(isset($_GET['id']) && $_GET['id']!=''){
            $get_data=mysqli_fetch_assoc($result);
            if($id == $get_data['id']){

            }
            else
            {
                $exist = '<div class="alert alert-danger my-3" role="alert">
                    product already exist...!
                </div>';
            }
    }
    else
    {
        $exist = '<div class="alert alert-danger my-3" role="alert">
          product already exist...!
        </div>';
    }
}
    
if($_FILES['image']['type']!='' && $_FILES['image']['type']!='image/png' && $_FILES['image']['type']!='image/jpg' && $_FILES['image']['type']!='image/jpeg'){
        $exist = '<div class="alert alert-danger my-3" role="alert">
        Please select only png,jpg and jpeg formatted files..!
      </div>';
}
    
if($exist == ""){
    if(isset($_GET['id']) && $_GET['id']!=''){
      if($_FILES['image']['name']!=''){
          $image =rand(111111111,999999999). '_' . $_FILES['image']['name'];
          move_uploaded_file($_FILES['image']['tmp_name'],'../images/products/'.$image);
          mysqli_query($conn,"UPDATE `products` SET `categories_id`='$categories_id',`brand_id`='$brand_id',`name`='$name', `mrp`='$mrp', `price`='$price',`image`='$image',`qty`='$qty', `short_description`='$short_description', `description`='$description', `meta_title`='$meta_title', `meta_description`='$meta_description', `meta_keyword`='$meta_keyword', `status`='$status' WHERE `products`.`id` = '$id'");
      }
      else
      {
        mysqli_query($conn,"UPDATE `products` SET `categories_id`='$categories_id',`brand_id`='$brand_id',`name`='$name', `mrp`='$mrp', `price`='$price',`qty`='$qty', `short_description`='$short_description', `description`='$description', `meta_title`='$meta_title', `meta_description`='$meta_description', `meta_keyword`='$meta_keyword', `status`='$status' WHERE `products`.`id` = '$id'");
      }
    }
    else
    {
      $image =rand(111111111,999999999). '_' . $_FILES['image']['name'];
      move_uploaded_file($_FILES['image']['tmp_name'],'../images/products/'.$image);
      mysqli_query($conn,"INSERT INTO `products` (`categories_id`,`brand_id`, `name`, `mrp`, `price`, `image`, `qty`, `short_description`, `description`, `meta_title`, `meta_description`, `meta_keyword`, `status`) VALUES ('$categories_id','$brand_id', '$name', '$mrp', '$price', '$image', '$qty', '$short_description', '$description', '$meta_title', '$meta_description', '$meta_keyword', '$status')");
    }
    
        header("location: ../admin/admin-product.php");
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
          echo '<form method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="name">Product Name :</label>
              <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp" name="category_name" value="'.$name.'"required>
            </div>
            <div class="form-group">
              <label for="categories_id">Categories</label>
              <select class="form-control" id="categories_id" name="categories_id">
                <option>Select Options..</option>';
                ?>
                <?php
                $result = mysqli_query($conn,"select category_id,category_name from categories");
                  while($row=mysqli_fetch_assoc($result)){
                    if($row['category_id']==$categories_id){
                      echo '<option selected value="'. $row['category_id'] .'">'. $row['category_name'] .'</option> ';
                    }
                    else
                    {
                      echo '<option value="'. $row['category_id'] .'">'. $row['category_name'] .'</option> ';
                    }
                  }
                ?>
                <?php
                echo '
              </select>
            </div>
            <div class="form-group">
              <label for="brand_id">brand</label>
              <select class="form-control" id="brand_id" name="brand_id">
                <option>Select Options..</option>';
                ?>
                <?php
                $result = mysqli_query($conn,"select brand_id,brand_name from brands");
                  while($row=mysqli_fetch_assoc($result)){
                    if($row['brand_id']==$brand_id){
                      echo '<option selected value="'. $row['brand_id'] .'">'. $row['brand_name'] .'</option> ';
                    }
                    else
                    {
                      echo '<option value="'. $row['brand_id'] .'">'. $row['brand_name'] .'</option> ';
                    }
                  }
                ?>
                <?php
                echo '
              </select>
            </div>
            <div class="form-group">
              <label for="mrp">Product MRP :</label>
              <input type="text" class="form-control" id="mrp" name="mrp" value="'.$mrp.'"required>
            </div>
            <div class="form-group">
              <label for="price">Product Price :</label>
              <input type="text" class="form-control" id="price" aria-describedby="emailHelp" name="price" value="'. $price .'"required>
            </div>
            <div class="form-group">
              <label for="qty">Product Quantity :</label>
              <input type="text" class="form-control" id="qty" aria-describedby="emailHelp" name="qty" value="'. $qty .'"required>
            </div>
            <div class="form-group">
              <label for="short_description">Product short Description :</label>
              <textarea class="form-control" id="short_description" aria-describedby="emailHelp" name="short_description"  required>'. $short_description .'</textarea>
            
            </div>
            <div class="form-group">
              <label for="description">Product Description :</label>
              <textarea class="form-control" id="description" aria-describedby="emailHelp" name="description"  required>'. $description .'</textarea>
            
            </div>
            </div>
            <div class="form-group">
                <label for="meta_title">Product Meta-Title :</label>
                <input type="text" class="form-control" id="meta_title" aria-describedby="emailHelp" name="meta_title" value="'. $meta_title .'">
            </div>
            </div>
            <div class="form-group">
              <label for="meta_description">Product Meta-Description :</label>
              <textarea class="form-control" id="meta_description" aria-describedby="emailHelp" name="meta_description" >'. $meta_description .'</textarea>
            
            </div>
            </div>
            <div class="form-group">
              <label for="meta_keyword">Product Meta-Keyword :</label>
              <input type="text" class="form-control" id="meta_keyword" aria-describedby="emailHelp" name="meta_keyword" value="'. $meta_keyword .'">
            
            </div>
            <div class="form-group">
              <label for="status">Product status :</label>
              <input type="text" class="form-control" id="status" aria-describedby="emailHelp" name="status" value="'. $status .'"required>
            
            </div>
            <div class="form-group">
              <label for="image">Product Image :</label>
              <input type="file" class="form-control-file" id="image" name="image" '. $required_image .'>
            </div>
  
            <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block my-2">Submit</button>
            <?php echo $exist; ?>
        </form>';
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