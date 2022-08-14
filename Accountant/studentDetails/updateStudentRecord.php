<?php

if(isset($_POST['saveBtn'])){
    session_start();
    $name = $_POST['name'];
    $semester = $_POST['semester'];
    $phoneNumber = $_POST['phoneNum'];
    $rollNo = $_POST['rollNo'];
    $registrationNumber = $_POST['registrationNumber'];
    $address = $_POST['address'];
    $email = $_POST['email'];

    /*
    1. Make db connection
        Change 3 tables

    */

    require_once "../../Database/dbConnection.php";

        //fetch email previous to change

        $sqlFetchEmail = "SELECT * from studentdetail WHERE registrationNumber='$registrationNumber'";
        $oldEmail = mysqli_fetch_assoc(mysqli_query($conn,$sqlFetchEmail))['email'];

    $sqlQuery1 = "UPDATE studentdetail SET name='$name', semester='$semester', phoneNumber='$phoneNumber',
    rollNo ='$rollNo', address='$address', email='$email' WHERE registrationNumber='$registrationNumber'";

    mysqli_query($conn,$sqlQuery1);




    $sqlQueryCredentials = "UPDATE logincredentials SET email='$email', userName='$name' WHERE email='$oldEmail'";
    $sqlQueryAdmission = "UPDATE admissiondetail  SET name='$name', rollNo ='$rollNo',semester='$semester' WHERE email='$oldEmail'";

    mysqli_query($conn,$sqlQueryCredentials);
    mysqli_query($conn, $sqlQueryAdmission);
    
    header("Location: http://localhost/crystal/accountant/studentDetails/studentInfo.php?n=true");
}

?>