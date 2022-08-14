<?php
//session is started so we don't have to start inside of multiple if conditions
session_start();
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
            flex-direction: column;
            font-family: 'Montserrat', sans-serif;
            font-family: 'Open Sans', sans-serif;
            background-image: url("../Images/loginBackground.png");
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
            padding: 10px 16px;
            text-align: center;
            z-index: 1;
            color: white;
            box-shadow: 0px 0px 2px 3px rgba(0, 0, 0, 0.558);
            border-radius: 8px;
            color: rgba(255, 255, 255, 0.676);
            transition: all 0.3s ease-in;
            box-shadow: 0px 0px 1px 1px rgba(255, 255, 255, 0.144);
        }

        .wrapper:hover {
            box-shadow: 0px 0px 2px 3px cyan;
            color: white;
        }

        .wrapper .formHeading {
            margin-bottom: 18px;
            transition: all 0.3s ease-in;
        }

        .wrapper:hover .formHeading {
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

        .form-field .fa,
        .form-field .fa-key {
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
            left: 10px;
        }

        .mainHeading {
            width: auto;
            color: greenyellow;
            font-family: monospace;
            text-align: center;
            font-size: 36px;
            margin-bottom: 60px;
            text-shadow: 1px 1px 3px orange;
            position: relative;
        }

        .mainHeading span {
            color: deeppink;
        }

        .mainHeading .heart {
            position: absolute;
            top: 34px;
            left: 86px;
        }

        footer .note {
            color: white;
            font-family: cursive;
            margin-top: 100px;
        }
    </style>
</head>

<body>
    <h1 class="mainHeading">Welcome to <br><span>CSIT/_\PARIWAAR</span><span class="heart">💙</span></h1>
    <div class="wrapper">

        <h1 class="formHeading">LogIn</h1>
        <form class="form" action="loginResponse.php" method="POST" autocomplete="off">
            <div class="form-field">
                <i class="fa fa-user" aria-hidden="true"></i>
                <input type="email" placeholder="Email" required name="email" value="<?php
                    //this variable helps to identify if the email is already set in field or not
                    $emailPresentAlready = false;

                    //email is restored upon successfull registration
                    if (isset($_SESSION['email'])) {
                        echo $_SESSION['email'];
                        $emailPresentAlready = true;
                    }

                    //restoring email in case of invalid password
                    // if (isset($_SESSION['userEmail']) && $emailPresentAlready == false) {
                    //     echo $_SESSION['userEmail'];
                    // }

                    //This cookie value will be displayed only if the email field is empty
                    if (isset($_COOKIE['email']) && $emailPresentAlready == false) {
                        echo $_COOKIE['email'];
                    }

                    ?>" onclick="clearErrorMsg()">
            </div>
            <div class="form-field">
                <i class="fa-solid fa-key"></i>
                <input type="password" placeholder="Password" required name="password" onclick="clearErrorMsg()">
            </div>
            <div class="form-field">
                <input type="submit" value="LogIn" name="submitBtn">
                <span id="errorMsg">
                    <?php
                    //displaying error with help of session 
                    if (isset($_SESSION['error'])) {
                        echo $_SESSION['error'];
                        session_unset();
                        session_destroy();
                    }
                    ?>
                </span>
            </div>

            <a href="sendRecoveryEmail.php" class="forget">Forgot <span>password</span>?</a>
            <hr class="sectionBreak">
            <a href="registration.php" class="register">Don't have an account? <span>Register</span></a>
        </form>
    </div>
    <footer>
        <p class="note">Made with ❤️ by Team Crystal<span>
    </footer>
    
    <!-- JavaScript script for clearing the error message -->
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