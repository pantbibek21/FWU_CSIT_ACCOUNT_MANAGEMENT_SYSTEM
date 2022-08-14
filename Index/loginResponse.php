<?php
//fetching form data
$email = $_POST['email'];
$userPassword = $_POST['password'];

//making database connection
require "../Database/dbConnection.php";

//making sure the email is registered af first
$sql_fetch_userDetail = "SELECT email, password, userType FROM loginCredentials WHERE email = '$email'";
//database query
$result = mysqli_query($conn, $sql_fetch_userDetail) or die("Query failed");

//if the email is registered
if (mysqli_num_rows($result) == 1) {
    //returns an associative array
    $row = mysqli_fetch_assoc($result);
    //getting the database password
    $dbpassword = $row['password'];

    //verifiying the password i.e making hash of entered password and comparing with hash stored in db
    //and if verified successfully
    if (password_verify($userPassword, $dbpassword)) {
        // if ($userPassword = "iammaya") {
        //identifying the userType from db
        $userType = $row['userType'];
        //switch based condition for redirecting in appropriate page depending on userType
        switch ($userType) {
            case 'student':
                header("Location: http://localhost/crystal/Student/student.php?email=$email");
                break;
           
            case 'accountant':
                header("Location: http://localhost/crystal/Accountant/index/accountant.php");
                break;

        }
    } else {
        //in case password didn't matched, creating a one session to hold error and one for retaining email
        session_start();
        $_SESSION['userEmail'] = $email;
        $_SESSION['error'] = "Invalid password !";
        //redirecting to login page
        header("Location: http://localhost/crystal/Index/login.php");
    }
} else {
    //in case there is not email found, means not registered first
    session_start();
    $_SESSION['error'] = "Invalid email or not registered !";
    header("Location: http://localhost/crystal/Index/login.php");
}
