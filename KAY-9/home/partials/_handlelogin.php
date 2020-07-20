<?php
$success = false;
$error = false;
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include '../partials/_connection.php';
  $name = $_POST['login_username'];
  $pass = $_POST['login_password'];
  
  
  $sql = "SELECT * FROM `customers` WHERE `username`='$name'";
  $result = mysqli_query($conn,$sql);
  $rows = mysqli_num_rows($result);
  if($rows == 1){
    $num = mysqli_fetch_assoc($result);
      if(password_verify($pass,$num['password'])){
       
        session_start();
        
        $_SESSION['loggedin'] = true;
        $_SESSION['id'] = $num['uno'];
        
        $_SESSION['username'] = $name;
       
        echo "login" . $name;
       
            
        header("location: ../home.php?login=true");
      
      }
     
      else{
        header("location: ../home.php?login=false");
      }
      
    }
    
  }


?>
