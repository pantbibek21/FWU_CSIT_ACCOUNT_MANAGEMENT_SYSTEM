<?php

session_start();
$email =  $_SESSION['deleteEmail'];
require_once("../../Database/dbConnection.php");

//we need to delete from three table studentdetail, logincredentials, admissiondetail

$deleteFromStudentDetail = "DELETE FROM studentdetail WHERE email ='$email'";
$deleteFromAdmissionDetail = "DELETE FROM admissiondetail WHERE email ='$email'";
$deleteFromLoginCredentials = "DELETE FROM logincredentials WHERE email ='$email'";
mysqli_query($conn,$deleteFromStudentDetail);
mysqli_query($conn,$deleteFromAdmissionDetail);
mysqli_query($conn,$deleteFromLoginCredentials);

$_SESSION['deleteNotification'] = "Record Successfully deleted";



switch($_SESSION['semValue']){
    case 0: 
        header("Location: http://localhost/CRYSTAL/Accountant/semesterDetails/about.php?semester=0");
        break;
    case 1:
        header("Location: http://localhost/CRYSTAL/Accountant/semesterDetails/about.php?semester=1");
        break;
    case 2:
        header("Location: http://localhost/CRYSTAL/Accountant/semesterDetails/about.php?semester=2");
        break;
    case 3:
        header("Location: http://localhost/CRYSTAL/Accountant/semesterDetails/about.php?semester=3");
        break;
    case 4:
        header("Location: http://localhost/CRYSTAL/Accountant/semesterDetails/about.php?semester=4");
        break;
    case 5:
        header("Location: http://localhost/CRYSTAL/Accountant/semesterDetails/about.php?semester=5");
        break;
    case 6:
        header("Location: http://localhost/CRYSTAL/Accountant/semesterDetails/about.php?semester=6");
        break;
    case 7:
        header("Location: http://localhost/CRYSTAL/Accountant/semesterDetails/about.php?semester=7");
        break;
        
}


?>