<?php
session_start();
require "../../Database/dbConnection.php";
$name = $_SESSION['name'];
$semester = $_SESSION['semester'];
$rollNo =  $_SESSION['rollNo'];
$amount = $_POST['amount'];
$purpose = $_POST['purpose'];
$date = $_POST['date'];
$email = $_SESSION['email'];

$paymentInsertionSql = "INSERT INTO admissiondetail(SN, RollNo, semester, Name, Amount, Purpose, Date,email)
VALUES(default,'$rollNo', '$semester','$name', '$amount', '$purpose', '$date','$email')";

if(mysqli_query($conn, $paymentInsertionSql)){
  $paymentSucessful = true; 
  session_unset();
  session_destroy();
   header("Location: http://localhost/crystal/accountant/payment/payment.php?name=$name&semester=$semester&rollNo=$rollNo&paymentInserted=$paymentSucessfull");
    
}
else{
  $_SESSION['notification'] = "<span class='notification'>Error ! Record Not inserted</span>";
  header("Location: http://localhost/crystal/accountant/payment/payment.php");
}




?>