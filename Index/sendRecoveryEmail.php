<?php

//checking if the submit button is clicked or not
if (isset($_POST['submitBtn'])) {
    //fetching the userEmail
    $email = $_POST['email'];
    //making the database connection
    require "../Database/dbConnection.php";

    //check if the email exists in our db or not first
    $checkEmailExists = "SELECT * FROM loginCredentials WHERE email = '$email'";
    $response = mysqli_query($conn, $checkEmailExists);
    $record = mysqli_fetch_assoc($response);
    //starting session
    session_start();
    //if the email is found in db
    if (mysqli_num_rows($response) == 1) {
        //retriving the userName and token; token will be used in making the recovery link so the respective user's password will only
        //be resetted
        $userName = $record['userName'];
        $token = $record['token'];

        //index.php is needed cause it contains code for sending email from PHPMailer -php library for sending email
        require "../phpmailer.php";

        //subject for mail
        $mail->Subject = 'Reset your password !';

        // Mail body content 
        $bodyContent = "<h2>Hello, $userName ! Click the following link to reset your password.</h2>";
        $bodyContent .= "<p>http://localhost/crystal/Index/recoverpassword.php?token=$token <br>This HTML email is sent from the CSIT/__\PARIWAR  by <b>Admin</b></p>";
        $mail->Body    = $bodyContent;

        // Sending email 
        if (!$mail->send()) {
            $_SESSION["mailResponse"] = "Mail could not be sent due to technical issue.";
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            $_SESSION["mailResponse"] = "Mail is sent, check and click on link to reset password";
        }
    }
    //in case email is not found in database
    else {
        $_SESSION['errorMessage'] = "Email is not registered !";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Recovery</title>
    <script src="https://kit.fontawesome.com/435298012d.js" crossorigin="anonymous"></script>
    <style>
        * {
            padding: 0px;
            margin: 0px;
            box-sizing: border-box;
        }

        body {
            width: 100vw;
            height: 100vh;
            display: flex;
            justify-content: center;
            padding-top: 100px;
            background-image: linear-gradient(blue, black);
        }

        .wrapper {
            width: 400px;
            height: 100px;
            text-align: center;
        }

        .wrapper h1 {
            font-size: 26px;
            font-family: cursive;
            margin-bottom: 16px;
            text-shadow: 0px 0px 2px cyan;
        }

        .wrapper form input {
            width: 100%;
            border: none;
            border-radius: 6px;
            outline: none;
            font-size: 18px;
            padding: 2px 32px;
            font-family: monospace;
            background: rgba(0, 0, 0, 0.5);
            height: 40px;
            margin-bottom: 10px;
        }

        .wrapper form input[type="submit"] {
            width: 60%;
            min-width: 200px;
            color: rgba(255, 255, 255, 0.8);
            cursor: pointer;
            transition: all 0.5s ease-in;
        }

        .wrapper form input[type="submit"]:hover {
            background: linear-gradient(to right, blue, black);
        }

        .wrapper form input:hover,
        .wrapper form input:focus {
            outline: 1px solid cyan;
            color: white;
        }

        .inputField {
            position: relative;
        }

        .fa-user {
            color: rgba(255, 255, 255, 0.6);
            position: absolute;
            top: 10px;
            left: 12px;
            margin-right: 10px;
            display: inline-block;
        }

        .errorMsg,
        .mailNotification {
            display: block;
            color: crimson;
            font-family: cursive;
        }

        .havePassword {
            color: rgba(255, 255, 255, 0.6);
            text-decoration: none;
            font-family: cursive;
        }

        .havePassword:hover span {
            color: cyan;
        }

        .mailNotification {
            color: greenyellow;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <h1>Recover your password</h1>
        <form action="" method="POST" autocomplete="off">
            <div class="inputField">
                <i class="fa fa-user" aria-hidden="true"></i>
                <input type="email" placeholder="Enter valid registered email" name="email" required onclick="hideErrorMsg()">
            </div>
            <input type="submit" value="Send recovery mail" name="submitBtn">
            <span class="errorMsg">
                <?php
                //displaying error message if it is set after form submission
                if (isset($_SESSION['errorMessage'])) {
                    echo $_SESSION['errorMessage'];
                    session_unset();
                    session_destroy();
                }
                ?>
            </span>
            <span class="mailNotification">
                <?php
                //displaying notification after email is verified like email is successfully sent or techinical issue
                if (isset($_SESSION['mailResponse'])) {
                    echo $_SESSION['mailResponse'];
                    session_unset();
                    session_destroy();
                }
                ?>
            </span>
        </form>
        <a href="login.php" class="havePassword">Remembered password ? <span>Login here</span></a>
    </div>
    <!-- JavaScript code for hiding error Message -->
    <script type="text/javascript">
        function hideErrorMsg() {
            var error = document.getElementsByClassName("errorMsg");
            error[0].style.display = "none";
        }
    </script>
</body>

</html>