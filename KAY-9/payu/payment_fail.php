<?php
require '../home/partials/_connection.php';
// echo '<pre>';
// print_r($_POST);
$pay_id=$_POST['mihpayid'];
$status=$_POST["status"];
$firstname=$_POST["firstname"];
$amount=$_POST["amount"];
$txnid=$_POST["txnid"];
mysqli_query($conn,"update orders set payment_status='$status', mihpayid='$pay_id',payu_status='fail' where txnid='$txnid'");	
header("location: ../payu/payment_fail.php");
?>