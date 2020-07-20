<!-- CONNECTION TO DATABASE -->
<?php

require '../_connection.php';
$error = false;
$login = false;
if($_SERVER['REQUEST_METHOD']=='POST'){

  $username = $_POST['username'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM `users` WHERE `username`='$username' AND `password`='$password'";
  $result = mysqli_query($conn,$sql);
  $num = mysqli_num_rows($result);
  if($num == 1){
    $row = mysqli_fetch_assoc($result);
    $login = true;
    $_SESSION['username']=$username;
    $_SESSION['loggedin']=true;
    header("location: ../admin/admin-home.php");
    // $login=true;
  }else{
    $error = true;
    $error = "Please enter valid credentials";

  }
}
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>LOGIN-admin</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


    <!-- Custom styles for this template -->
    <link href="../admin/css/signin.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <form class="form-signin" action="../admin/login-admin.php" method="post">
      <img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Please Login</h1>
      <label for="username" class="sr-only">Username</label>
      <input type="text" id="username" class="form-control" placeholder="Username..." name="username" required autofocus>
      <label for="password" class="sr-only">Password</label>
      <input type="password" id="password" class="form-control" placeholder="Password..." name="password" required>
      
      <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
      
      <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
      <?php
      if($login){
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Hola..! </strong> Login
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
if($error){
  echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
<strong>warning..! </strong>'. $error .'
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>
</div>';
}
?>
    </form>
   
  </body>
</html>

