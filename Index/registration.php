<?php

//  function to filter data of the registration form

function appitizer($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = strip_tags($data);
    $data = htmlspecialchars($data);
    return $data;
}

//  will only be executed on the form submission

if (isset($_POST['submitBtn'])) {

    //  Making a database connection

    require "../Database/dbConnection.php";

    //  getting registration form field data and again passing them in filter function

    $userName = mysqli_escape_string($conn, appitizer($_POST["name"]));
    $address = mysqli_escape_string($conn, appitizer($_POST["address"]));
    $phoneNum = mysqli_escape_string($conn, appitizer($_POST["phoneNumber"]));
    $semester = $_POST["semester"];
    $rollNo = appitizer($_POST["rollNo"]);
    $registrationNumber = mysqli_escape_string($conn, appitizer($_POST["registrationNumber"]));
    $email = mysqli_real_escape_string($conn, appitizer($_POST['email']));
    $userPassword = mysqli_escape_string($conn, $_POST['password']);
    $cpassword = mysqli_escape_string($conn, $_POST['cpassword']);
    $userType = $_POST['userType'];




    // Server side validation of registration form data

    //check if user name field is empty or space
    //using $error[] to hold the error message

    if ($userName == "" || $userName == " ") {
        $error[] = "<span class='errorMsg'>Enter the username !</span>";
    }

    //check if phone Number is equal to 10 digits
    if (strlen($phoneNum) != 10) {
        $error[] = "<span class='errorMsg'>Phone Number should be of 10 digits !</span>";
    }

    //check if the join year is the 4 digit or not
    if (strlen($rollNo) > 2) {
        $error[] = "<span class='errorMsg'>Only 2 digit roll Number is valid !</span>";
    }

    //check if the password field is greater than 6 or not 
    if (strlen($userPassword) < 6) {
        $error[] = "<span class='errorMsg'>Password should be greater than 6 digits !</span>";
    }

    //check whether the password and confirm password field are matched
    if ($userPassword != $cpassword) {
        $error[] = "<span class='errorMsg'>Password does not match !</span>";
    }

    //check the fact that if userType is student, then must select the semester
    if ($semester == "" && $userType == "student") {
        $error[] = "<span class='errorMsg'>Select the semester !</span>";
    }

    //check the userType is selected
    if ($userType == "") {
        $error[] = "<span class='errorMsg'>Select the user type !</span>";
    }

    //Check if the userType is not student, then Select semester field should be empty.
    if ($userType != "student") {
        if ($semester != "") {
            $error[] = "<span class='errorMsg'>Only student can select semester !</span>";
        }
    }

    // switch ($semester) {
    //     case "firstSemester":
    //         $sem = "first";
    //         break;

    //     case "secondSemester":
    //         $sem = "second";
    //         break;

    //     case "thirdSemester":
    //         $sem = "third";
    //         break;
    //     case "fourthSemester":
    //         $sem = "fourth";
    //         break;
    //     case "fifthSemester":
    //         $sem = "fifth";
    //         break;
    //     case "sixthSemester":
    //         $sem = "sixth";
    //         break;
    //     case "seventhSemester":
    //         $sem = "seventh";
    //         break;
    //     case "eightSemester":
    //         $sem = "eighth";
    //         break;
    // }

    //check if the $error array is set or not. Set mean error so this code will not be executed else only be executed
    if (!isset($error)) {

        // while making registration checking if the email is already used for registration or not

        //fetching database record of that particular email
        $checkEmailExists = "SELECT * FROM loginCredentials WHERE email = '$email'";

        //making db query
        $response = mysqli_query($conn, $checkEmailExists);

        //if the response contains one row or not, meaning email found or not. If cound show error
        if (mysqli_num_rows($response) == 1) {
            $error[] = "<span class='errorMsg'>Email is already registered !</span>";
        } else {
            //if email is not registerd
            //checking the userType so we can insert details in repective tables
            //if userType will be student, then we will insert into repective semester table. This is possible with 
            // the help of $semester which holds the value of option field  and we have set same name as database tables as well

            //using switch statement 

            //incase of student, inserting in repective semester table

            // creating the  hash of the  password 
            $hash = password_hash($userPassword, PASSWORD_DEFAULT);

            //creating a token which is used for later use in password recovery and login
            $token = bin2hex(random_bytes(15));

            //saving the random unique of uploaded profile in database above and saving the image in server folder named studentProfiles

            $imageName = $_FILES['image']['name'];

            $imageSize = $_FILES['image']['size'];
            $tempName = $_FILES['image']['tmp_name'];
            $imageExtension = explode(("."), $imageName);
            $imageExtension = strtolower(end($imageExtension));

            $imageName = uniqid() . "." . $imageExtension;

            if ($imageSize > 2000000) {
                echo "<script>alert('Image size is too large to upload')</script>";
                die();
            }
            if (in_array($imageExtension, ["jpg", "jpeg", "png"])) {
                move_uploaded_file($tempName, "userProfiles/" . $imageName);
                
            $sqlStudentDetailInsertion = "INSERT INTO studentdetail(SN, name, phoneNumber, address, rollNo, email, registrationNumber, semester, studentProfile) VALUES
            ('', '$userName', '$phoneNum', '$address', '$rollNo', '$email', '$registrationNumber', '$semester', '$imageName')";

     mysqli_query($conn, $sqlStudentDetailInsertion) or die("error arised in student");



                //inserting the credetials records in loginCredentials table
                $sql_credential_insertion = "INSERT INTO logincredentials(userName, userType, token, password, email) values('$userName','$userType', '$token', '$hash','$email')";

                //database query
                mysqli_query($conn, $sql_credential_insertion);
                
            } else {
                echo "<script>alert('File extention is not supported')</script>";
            }

            //closing the database connection
            mysqli_close($conn);

            //maintaining a session so we can restore user email in login.php file
            session_start();
            $_SESSION['email'] = $email;

            //maintaing a cookie so that next time once the browers is open the email field retains email of user
            $cookie_name = "email";
            $cookie_value = $email;
            //setting cookie for 30 days
            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
            //redirecting to login page
            header("Location: http://localhost/crystal/Index/login.php");
        }
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
    <link rel="stylesheet" href="registrationForm.css">
</head>

<body>
    <div class="wrapper">
        <h1 class="heading">Create an account.</h1>
        <!-- PHP code for showing error message. This will only be displayed if error is set.  -->
        <?php if (isset($error)) {
            echo $error[0];
            unset($error[0]);
        }
        ?>
        <!-- action attribute is set empty so response will be sent in the same page  -->
        <form action="" method="POST" class="form" autocomplete="on" name="registrationForm" onsubmit="return validate()" enctype="multipart/form-data">
            <span id="errorMsg"></span>
            <div class="form-field">
                <!-- clearErrorMsg() is used to clear the error message while clicking on these fields -->
                <!-- value attribute is also set to retain form details in case of any errors else whole data will be erased -->
                <input type="text" placeholder="Full Name" name="name" onclick="clearErrorMsg()" value="<?php if (isset($userName)) echo $userName  ?>" required>
            </div>
            <div class="form-field">
                <input type="text" placeholder="Address" name="address" onclick="clearErrorMsg()" value="<?php if (isset($address)) echo $address  ?>" required>
            </div>
            <div class="form-field">
                <input type="number" placeholder="Phone Number" name="phoneNumber" onclick="clearErrorMsg()" value="<?php if (isset($phoneNum)) echo $phoneNum  ?>" required>
            </div>
            <div class="form-field">
                <select name="semester" onclick="clearErrorMsg()">

                    <option value="">Select Semester only if student</option>
                    <option value="firstSemester">First</option>
                    <option value="secondSemester">Second</option>
                    <option value="thirdSemester">Third</option>
                    <option value="fourthSemester">Fourth</option>
                    <option value="fifthSemester">Fifth</option>
                    <option value="sixthSemester">Sixth</option>
                    <option value="seventhSemester">Seventh</option>
                    <option value="eighthSemester">Eighth</option>
                </select>
            </div>
            <div class="form-field">
                <div>
                    <input type="number" placeholder="Roll No (only students)" name="rollNo" onclick="clearErrorMsg()" value="<?php if (isset($rollNo)) echo $rollNo ?>">
                </div>
                <div>
                    <input type="text" placeholder="Enter registration Number" name="registrationNumber" onclick="clearErrorMsg()" value="<?php if (isset($registrationNumber)) echo $registrationNumber ?>">
                </div>
            </div>
            <div class="form-field">
                <input type="email" placeholder="Email address" name="email" onclick="clearErrorMsg()" required>
            </div>
            <div class="form-field image-form-field">
                <label for="image">Upload your awesome profile *jpg,jpeg,png acceptable</label>
                <input type="file" placeholder="Upload profile Picture" name="image" id="image" onclick="clearErrorMsg()" required>
            </div>
            <div class="form-field">
                <input type="password" placeholder="Password" name="password" onclick="clearErrorMsg()" required>
            </div>
            <div class="form-field">
                <input type="password" placeholder="Confirm Password" name="cpassword" onclick="clearErrorMsg()" required>
            </div>
            <div class="form-field">
                <select name="userType" onclick="clearErrorMsg()">
                    <option value="">Select UserType</option>
                    <option value="accountant">Accountant</option>
                    <option value="student">Student</option>
                </select>
            </div>
            <input type="submit" value="Register" name="submitBtn">
        </form>
        <p id="bottomMsg">Already have an account? <span><a href="login.php">Sign In instead.</span>
    </div>
    <!-- Linking the javascript validation file. -->
    <script src="validateRegistration.js"></script>
</body>

</html>