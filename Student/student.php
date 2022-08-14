<?php 
require "../Database/dbConnection.php";
session_start();

$email = $_GET['email'];
$sqlFetchUserInfo = "SELECT * FROM studentdetail WHERE email = '$email'";

$userInfo = (mysqli_fetch_assoc(mysqli_query($conn, $sqlFetchUserInfo)));


$userSemester = $userInfo['semester'];
$userImageRef = $userInfo['studentProfile'];
$userName = $userInfo['name'];
//have username and semester , first fetch userInfo using semester with string concatination
//then fetch userrecord same but use username

// $userInfoSemesterTable = $userSemester."semester";
// $userAdmissionSemesterTable = $userSemester."semesteradmissionrecord";

// $sqlFetchUserInfo = "SELECT * FROM studentdetail where email ='$email'";
$sqlFetchUserPayment = "SELECT * FROM admissiondetail where email = '$email'";


$response = mysqli_query($conn, $sqlFetchUserPayment);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student-Page</title>
    <link rel="stylesheet" href="../Student/main.css">
</head>
<body>
    <header class="header">
        
        <a href="../Index/logout.php">Logout</a>
    </header>

    <div class="container">
        <div class="img-wrapper">
            <img src="../Index/userProfiles/<?php echo $userImageRef ?>" alt="Your awesome picture..">
        </div>
        <h1 class="welcomeText">Hello, <?php echo $userName = explode(" ",$userInfo['name'])[0] ?> !</h1>
        <div class="studentDetails">
            <div class="field-box">
                <span>Name </span>
                <input type="text" value="<?php echo $userInfo['name'] ?>" disabled>
            </div>
            <div class="field-box">
                <span>Semester </span>
                <input type="text" value="<?php echo $userInfo['semester'] ?>" disabled>
            </div>
            <div class="field-box">
                <span>Roll No </span>
                <input type="text" value="<?php echo $userInfo['rollNo'] ?>" disabled>
            </div>
            <div class="field-box">
                <span>Reg. Number </span>
                <input type="text" value="<?php echo $userInfo['registrationNumber'] ?>" disabled>
            </div>
            <div class="field-box">
                <span>Phone No </span>
                <input type="text" value="<?php echo $userInfo['phoneNumber'] ?>" disabled>
            </div>
            <div class="field-box">
                <span>Address  </span>
                <input type="text" value="<?php echo $userInfo['address'] ?>" disabled>
            </div>
            <div class="field-box">
                <span>Email </span>
                <input type="text" value="<?php echo $userInfo['email'] ?>" disabled>
            </div>
        </div>

        <div class="paymentBox">
            <h2 class="paymentHeading">Your Payments</h2>
            <hr class="sectionBreak">
            <table>
                <tr>
                    <th>SN</th>
                    <th>Amount</th>
                    <th>Purpose</th>
                    <th>Date</th>
                </tr>
                <?php 
                if(mysqli_num_rows($response) > 0){

        
                $counter =1;
                while($paymentInfo = mysqli_fetch_assoc($response)){
                    
               ?>
                <tr>
                    <td><?php echo $counter ?></td>
                    <td><?php echo $paymentInfo['amount'] ?></td>
                    <td><?php echo $paymentInfo['purpose'] ?></td>
                    <td><?php echo $paymentInfo['date'] ?></td>
                </tr>
                
                
                    <?php 
                    $counter++;
                }
            }
            else {
                echo "No payment made so far";
            }
                ?>
                <!-- <tr>
                    <td>2</td>
                    <td>10000</td>
                    <td>Sixth Sem cleared</td>
                    <td>12/4/2022</td>
                </tr> -->
            </table>
        </div> 
    </div>
</body>
</html>