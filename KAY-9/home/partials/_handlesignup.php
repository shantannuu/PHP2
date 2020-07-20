<?php


   
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "ecommerce";

    $conn = mysqli_connect($servername,$username,$password,$database);
    
    if(!$conn){
        die("Sorry we failed to connect:" . mysqli_connect_error()) ;
    }
    else{
        // echo "connect to database";
    }
    $success = "false";
    $error = "false";
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $username = $_POST['username'];
      $password = $_POST['password'];
      $confirm = $_POST['confirm'];
     
      $existsql = "SELECT * FROM `customers` WHERE `username`='$username'";
      $result = mysqli_query($conn,$existsql);
      $numrows = mysqli_num_rows($result);
      if($numrows>0){
        
        $error = "username is already been taken..!";
      }
      else{
      if($password == $confirm){
        $hash = password_hash($password,PASSWORD_DEFAULT);
      $sql = "INSERT INTO `customers` (`username`, `password`, `time`) VALUES ('$username', '$hash', current_timestamp());";
      $result = mysqli_query($conn,$sql);
      if($result){
      $success = true;
      
      header("location: ../home.php?signupsuccess=true ");
      exit();
      }
    }else{
      
      $error = "Password does not match with confirm password..!";
      
      }
      }
      header("location: ../home.php?signupsuccess=false&error=$error");
      
    }
?>