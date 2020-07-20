<?php
session_start();
$home = false;
$about = false;
$contact = false;

if($page == 'home'){
  $home = 'active';
}
if($page == 'about'){
  $about = 'active';
}
if($page == 'contact'){
  $contact = 'active';
}
require '../_add_to_carts.php';
$obj =new add_to_cart();

$totalproducts = $obj->totalproduct();
// echo $totalproducts
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
<a class="navbar-brand" href="../home/abouts.php" style="margin-left:50px">
    <img src="../images/products/logo.png" width="50" height="50" alt="" loading="lazy" style="border-radius:50%;">
  </a>
  <a class="navbar-brand" href="../home/home.php">KAY-9</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto" style="margin-left:50px">
      <li class="nav-item <?php echo $home ?>">
        <a class="nav-link" href="../home/home.php">Home <span class="sr-only">(current)</span></a>
      </li>
      
      

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Categories
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
      <?php  $sql ="SELECT * FROM `categories` WHERE `category_status`= '1' ORDER BY `category_name` asc";
                $result = mysqli_query($conn,$sql);
                while($row = mysqli_fetch_assoc($result)){
                echo '

       
          <a class="dropdown-item" href="../home/categories.php?catid='. $row['category_id'] .'&name='. $row['category_name'] .'">'. $row['category_name'] .'</a>
              
         
        ';
                }
      ?>
       <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
      </div>
      </li>
      <li class="nav-item <?php echo $contact ?>">
        <a class="nav-link" href="../home/contacts.php">Contact</a>
      </li>
      <li class="nav-item <?php echo $about ?>">
        <a class="nav-link" href="../home/abouts.php">About</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0" action="../home/searches.php?search=" method="get">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
      <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Search</button>
    </form>
    <?php
    
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true) {
      echo '<div class="user mx-2">
      <a class="btn btn-outline-warning" href="../home/orders.php?username='. $_SESSION['username'] .'" role="button">' . $_SESSION['username'] . '</a>
      <a class="btn btn-outline-warning" href="../home/logout.php" role="button">Logout</a>
      </div>';
    }else{
    echo '<div class="user mx-2">
    <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#signup">Sign Up</button>
    <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#login">Log In</button>
    </div>';
    }
  ?>
    
    <?php 
       if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
          echo '<div class="user mx-2">
          <a href="../home/carts.php" role="button" class="btn btn-primary">
          <svg width="24px" height="24px" viewBox="0 0 16 16" class="bi bi-cart-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M8.5 5a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1H8V5.5a.5.5 0 0 1 .5-.5z"/>
  <path fill-rule="evenodd" d="M8 7.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0v-2z"/>
  <path fill-rule="evenodd" d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
</svg> Cart <span class="badge badge-light">' . $totalproducts . '</span>
          </a>
          </div>';
         
       }else{
        echo '<div class="user mx-2"><a href="../home/carts.php" role="button" class="btn btn-primary">
        <svg width="24px" height="24px" viewBox="0 0 16 16" class="bi bi-cart-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M8.5 5a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1H8V5.5a.5.5 0 0 1 .5-.5z"/>
  <path fill-rule="evenodd" d="M8 7.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0v-2z"/>
  <path fill-rule="evenodd" d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
</svg> Cart <span class="badge badge-light">0</span>
        </a></div>';
       }
         
          ?>
          </div>
</nav>

<?php
        include "../home/partials/_signupmodal.php";
  

        include "../home/partials/_loginmodal.php";
        if(isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "true"){
          echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
        <strong>HOLA..! </strong> Your registeration to the page is successfully done.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>';
        }
        if(isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "false"){
          echo '<div class="alert alert-warning alert-dismissible fade show my-0" role="alert">
          <strong>WARNING..! </strong>' . $_GET['error'] . '
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          </div>';
        }
        if(isset($_GET['login']) && $_GET['login'] == "true"){
          echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
        <strong>HOLA..! </strong> Login to the page is successfully done.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>';
        }
        if(isset($_GET['login']) && $_GET['login'] == "false"){
          echo '<div class="alert alert-warning alert-dismissible fade show my-0" role="alert">
          <strong>WARNING..! </strong> Failed to login
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          </div>';
        }
        if(isset($_GET['logout']) && $_GET['logout'] == "true"){
          echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
        <strong>HOLA..! </strong> Logout to the page is successfully done
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>';
        }
        ?>