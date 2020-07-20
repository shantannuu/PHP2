<?php
session_start();




// unset($_SESSION['cart']);

unset($_SESSION['loggedin']);
unset($_SESSION['username']);
header("location: ../home/home.php?logout=true");
?>
