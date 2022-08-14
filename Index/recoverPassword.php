<?php
//this page will be rendered after clicking in link from mail sent for resetting password
//starting the session
session_start();

//only executing if the form is submitted
if (isset($_POST['submitBtn'])) {
    //fetching token that is send in link itself
    $token = $_GET['token'];

    //making a database connection
    require "../Database/dbConnection.php";

    //getting the user details through the help of token, 
    $fetchUserDetials = "SELECT * FROM loginCredentials WHERE token = '$token'";
    $response = mysqli_query($conn, $fetchUserDetials);

    //if there is a response
    if ($userRecord = mysqli_fetch_assoc($response)) {
        //fetching the token
        $fetchedToken = $userRecord['token'];
        //again make suring the token is correct, though is previously ensured. If the token would be incorrect we cound't
        //reach this far
        if ($token == $fetchedToken) {
            //fetching the form data
            $password = $_POST['password'];
            $cpassword = $_POST['cpassword'];

            //checking if the password to be reset are matched
            if ($password == $cpassword) {
                //hashing the password
                $hash = password_hash($password, PASSWORD_DEFAULT);
                //sql query for updating password
                $changePasswordQuery = "UPDATE loginCredentials SET password = '$hash' WHERE token = '$token'";
                //executing the query
                if (mysqli_query($conn, $changePasswordQuery)) {
                    $_SESSION['error'] = "Password is reset successfully !";
                    //heading to login page after successful login
                    header('Refresh: 2; URL=http://localhost/crystal/Index/login.php');
                }
            } else {
                //if the password didn't matched
                $_SESSION['error'] = "Password didn't matched !";
            }
        }
    }
    //in case the token is found invalid
    else {

        $_SESSION['error'] = "Sorry 🥺. We can't reset your password ! <br>Contact admin, please.";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WELCOME TO CRYSTAL</title>
    <script src="https://kit.fontawesome.com/435298012d.js" crossorigin="anonymous"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Open+Sans:wght@400;700&display=swap');


        * {
            padding: 0px;
            margin: 0px;
            box-sizing: border-box;
        }

        body {
            width: 100%;
            height: 100vh;
            background-color: rgba(0, 0, 0, 0.211);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Montserrat', sans-serif;
            font-family: 'Open Sans', sans-serif;
            background-image: url("../Images/lock.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            position: relative;
        }

        body::after {
            content: "";
            width: 100%;
            height: 100vh;
            background-color: rgba(0, 0, 0, 0.455);
            position: absolute;
        }

        .wrapper {
            border: 1px solid black;
            background: rgba(0, 0, 0, 0.411);
            padding: 10px 16px;
            text-align: center;
            z-index: 1;
            color: white;
            box-shadow: 0px 0px 2px 3px rgba(0, 0, 0, 0.558);
            border-radius: 8px;
            color: rgba(255, 255, 255, 0.676);
            transition: all 0.3s ease-in;
        }

        .wrapper:hover {
            box-shadow: 0px 0px 2px 3px cyan;
            color: white;

        }

        .wrapper .heading {
            margin-bottom: 18px;
            transition: all 0.3s ease-in;
        }

        .wrapper:hover .heading {
            text-shadow: 0px 0px 5px cyan;
        }

        .form input {
            width: 100%;
            height: 38px;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            padding: 2px 40px;
            margin-bottom: 18px;
            background: rgba(255, 255, 255, 0.676);

        }

        .form input:focus,
        .form input:hover {
            outline: 1px solid cyan;
            background: white;

        }

        .form .form-field {
            position: relative;
        }

        .form-field .fa-solid {
            position: absolute;
            top: 10px;
            left: 12px;
            color: black;

        }

        .form input[type="submit"] {
            cursor: pointer;
            transition: all 0.1s ease-in;
            margin-bottom: 20px;
            position: relative;
        }

        .form input[type="submit"]:hover {
            color: white;
            background: black;
        }

        .form a {
            text-decoration: none;
            color: rgba(255, 255, 255, 0.644);
            display: inline-block;
            margin: 10px auto;
        }

        a.register:hover span,
        a.forget:hover span {
            color: cyan;
        }

        #errorMsg {
            display: block;
            position: absolute;
            top: 47px;
            color: red;
            left: 20px;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <h1 class="heading">Reset you password</h1>
        <form class="form" action="" method="POST" autocomplete="off">
            <div class="form-field">
                <i class="fa-solid fa-lock"></i>
                <input type="password" placeholder="Password" name="password" required onclick="clearErrorMsg()">
            </div>
            <div class="form-field">
                <i class="fa-solid fa-lock"></i>
                <input type="password" placeholder="Confirm Password" required name="cpassword" onclick="clearErrorMsg()">
            </div>
            <div class="form-field">
                <input type="submit" value="Reset Password" name="submitBtn">
                <span id="errorMsg">
                    <?php
                    //displaying error in case of any error is set
                    if (isset($_SESSION['error'])) {
                        echo $_SESSION['error'];
                        session_unset();
                        session_destroy();
                    }

                    ?>
                </span>
            </div>



        </form>
    </div>
    <!-- JavaScript code for hiding the error message on clicking the form field -->
    <script type="text/javascript">
        let errorMsg = document.getElementById("errorMsg");
        errorMsg.style.cssText = "display: block;";

        function clearErrorMsg() {
            errorMsg.innerText = "";
            errorMsg.style.cssText = "display: none;";
        }
    </script>
</body>

</html>