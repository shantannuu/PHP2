<?php
require '../home/partials/_connection.php';

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Rowdies&display=swap" rel="stylesheet">
    <title>E-commerce</title>
  <style>
  *{
    font-family: 'Rowdies', cursive;
  }
  .carousel-indicators li{
    background-color:black;
  }
 
  </style>
  </head>
  <body>
  <?php
  $page = 'home';
        include "../home/partials/_nav.php";
        
  ?>
  <div class="alert alert-primary" role="alert">
  first You need to login your account to add a product in cart...! 
</div>
<div class="container my-4">
<form action="../home/handleregister.php" method="post">
      <div class="form-group">
        <label for="login_username">Username :</label>
        <input type="text" class="form-control" id="login_username" name="login_username" aria-describedby="emailHelp" placeholder="Enter email">
        
      </div>
      <div class="form-group">
        <label for="login_password">Password :</label>
        <input type="password" class="form-control" id="login_password" name="login_password" placeholder="Password">
      </div>
    
      <button type="submit" class="btn btn-primary btn-lg btn-block">Login</button>
    </form>
</div>
<footer class="footer py-3" style="background-color:black;margin-top:465px">
  <div class="container">
    <span class="text-muted" style="color:white;margin:10px 40%">All Right Reserved &copy | 2020 </span>
  </div>
</footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>