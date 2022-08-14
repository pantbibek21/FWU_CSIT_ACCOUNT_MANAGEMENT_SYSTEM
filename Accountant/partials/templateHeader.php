<?php
if (isset($_POST["submitBtn"])) {
    
 session_start();
    $userName = $_POST["userName"];
    $semester = $_POST["semester"];
    $isSemesterCorrect = true;
    if(strlen($semester) == 1){
       
       switch($semester){
           case "1":
                $semester = "first";
                break;
        
            case "2":
                $semester = "second";
                break;
            
            case "3":
                $semester = "third";
                break;
            
            case "4":
                $semester = "fourth";
                break;
            
            case "5":
                $semester = "fifth";
                break;
            
            case "6":
                $semester = "sixth";
                break;
            
            case "7":
                $semester = "seventh";
                break;
            
            case "8":
                $semester = "eighth";
                break;
            
                default:
                // die("Invalid semester. Enter again !");
                $_SESSION["error"] = "Invalid Semester";
                $isSemesterCorrect = false;
                header("Location: http://localhost/crystal/accountant/payment/payment.php");
             
        
       }
        
    }
    if($isSemesterCorrect){
        
        $rollNo = $_POST["rollNo"];

        require "../../Database/dbConnection.php";
        $checkRecord = "SELECT * FROM studentdetail WHERE name = '$userName' AND rollNo ='$rollNo' AND semester = '$semester'";

        $response = mysqli_query($conn, $checkRecord);
    
        if (mysqli_num_rows($response) == 1) {
            $row = mysqli_fetch_assoc($response);
            $_SESSION['name'] = $row['name'];
            $_SESSION['semester'] = $row['semester'];
            $_SESSION['rollNo'] = $row['rollNo'];
            $_SESSION['email'] = $row['email'];
            $_SESSION["showContent"] = true;
        } else {

            $_SESSION["error"] = "Error ! No record found.";
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
    <title>Payment</title>
    <link rel="stylesheet" href="../payment/payment.css">
    <link rel="stylesheet" href="../payment/showContent.css">
</head>

<body>
    <div class="wrapper">
        <div class="header">
            <div class="backBtn">
                <a href="../index/accountant.php">Back</a>
            </div>
            <div class="rightControl">
                
                <a href="../../Index/logout.php">Logout</a>
            </div>
        </div>
       
        <div class="formWrapper">
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">
                <div class="formField">
                    <label for="name">Name </label>
                    <input type="text" id="name" value="<?php if(isset($_SESSION['name'])){
                        echo $_SESSION['name'];
                    }
                    if(isset($_GET['name'])){
                        echo $_GET['name'];
                    }
                    
                    ?>" placeholder="Enter you name..." name="userName" required onclick="hideErrorMsg()">        
                   </div>
                <div class="formField">
                    <label for="semester">Semester </label>
                    <input type="text" placeholder="Semeter goes here..." id="semester" name="semester" required onclick="hideErrorMsg()" value="<?php if(isset($_SESSION['semester'])){
                        echo $_SESSION['semester'];
                    }
                    if(isset($_GET['semester'])){
                        echo $_GET['semester'];
                    }
                    ?>">
                </div>
                <div class="formField">
                    <label for="rollNo">Roll No </label>
                    <input type="number" placeholder="Roll number goes here..." name="rollNo" required onclick="hideErrorMsg()" value="<?php if(isset($_SESSION['rollNo'])){
                        echo $_SESSION['rollNo'];
                    }
                    if(isset($_GET['rollNo'])){
                        echo $_GET['rollNo'];
                    }
                    ?>">
                </div>


                <input type="submit" value="Show"id="showBtn" name="submitBtn">
                <span class="errorMsg"><?php if (isset($_SESSION['error'])) {
                                            echo $_SESSION['error'];
                                            session_unset();
                                            session_destroy();
                                            // header('Refresh: 1; URL=http://localhost/crystal/accountant/payment/payment.php');
                                        }



                                        ?></span>
                <span style="color: blue;" id="updateNofication">
                <?php
                     if (isset($_GET['n'])) {
                                            echo "Successfully Updated !";
                                          
                                            // header('Refresh: 1; URL=http://localhost/crystal/accountant/payment/payment.php');
                                        }

                                ?>
                                        
                         </span>
            </form>

           
        </div>
        <?php
if(isset($_GET['paymentInserted'])){
    

    ?> 
    <script>
        var showContentBtn = document.getElementById("showBtn");
        console.log("i was here boy");
        showContentBtn.click();
        </script>
    
        <?php
    }

    ?>