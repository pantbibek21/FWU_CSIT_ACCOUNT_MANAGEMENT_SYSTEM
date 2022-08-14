<?php 

if(isset($_POST['submitBtn'])){
    $oldSemester = $_POST['oldTable'];
    $newSemester = $_POST['newTable'];
    $validSemesterNames = ['first','second','third','fourth','fifth','sixth','seventh','eighth'];

    if(in_array($oldSemester,$validSemesterNames) && in_array($newSemester, $validSemesterNames)){
        //we have two tables to update
        /*
            1. studentdetail table
            2. admissiondetail table 
        */
        require "../../Database/dbConnection.php";

        //updating the student table
        $sqlUpdateStudentDetail = "UPDATE studentdetail SET semester = '$newSemester' WHERE semester = '$oldSemester'";
        mysqli_query($conn, $sqlUpdateStudentDetail);
        
        //updating the admission table   
        $sqlUpdatAdmissionDetail = "UPDATE admissiondetail SET semester = '$newSemester' WHERE semester = '$oldSemester'";
        mysqli_query($conn, $sqlUpdatAdmissionDetail);
        $error = "Succesfully Updated !";
    }
    else {
        $error = "Semester name incorrect !";
    }
    
}



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update semesters</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Open+Sans:wght@400;700&family=Poppins:wght@400;700&display=swap');

        * {
            padding: 0px;
            margin: 0px;
            box-sizing: border-box;
        }

        body {
            width: 100vw;
            height: 100vh;
            font-family: "Montserrat";
            display: flex;
            align-items:flex-start;
            justify-content: center;
            background: linear-gradient(to bottom, blue,orange);
           
        }
        .wrapper {
            width: 420px;
            height: 260px;
            border: 1px solid black;
            margin-top: 100px;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0px 0px 4px 2px black;
            text-align: center;
            position:relative;
        }
        .wrapper .headingText {
            font-family: cursive;
            margin-bottom: 20px;
            position: relative;
            
        }
        .wrapper .headingText::after {
            content: "";
            width: 100px;
            height: 6px;
            border-radius: 4px;
            background-image: linear-gradient(to right, yellowgreen,orange);
            position: absolute;
            bottom: -10px;
            left: 46px;
            transition: all 0.6s ease-in;
        }
        .wrapper:hover .headingText::after {
            width: 280px;
        }
    
        form label {
            width: 140px;
            display: inline-block;
            text-align: left;
            font-size: 18px;
            font-weight: 600;
        }
         form input {
             padding: 3px 10px;
             font-family: "Poppins";
             font-size: 16px;
             background-color: rgba(255, 255, 255, 0.665);
             border: none;
             color: black;
             outline: 1px solid black;
             border-radius: 4px;
             margin-bottom: 10px;
         }
         form input[type="submit"]{
             width: 140px;
            margin-right: -70px;
             margin-top: 10px;
             cursor: pointer;
             transition: all 0.2s ease-in;
         }
         form input[type="submit"]:hover {
             color: white;
             font-weight: bold;
             background: black;
         }
         .wrapper .errorMsg {
             display: inline-block;
             position: absolute;
             bottom: 30px;
            left: 100px;
             color: rgb(89, 10, 10);
             font-family: cursive;
         }

         #backBtn {
             display: block;
             width: 60px;
             padding: 4px 8px;
             border-radius: 3px;
             color: black;
             font-weight: bold;
             text-decoration: none;
             font-size: 18px;
             border: 1px solid black;
             transition: all 0.2s ease-in;
             position: absolute;
             top: -80px;
             left: -400px;

         }
         #backBtn:hover {
             background: white;
             color: blue;
         }

    </style>
</head>
<body>
    <div class="wrapper">
    <a id="backBtn" href="http://localhost/CRYSTAL/Accountant/index/accountant.php">Back</a>
        <h2 class="headingText">Update entire semester</h2>
        <div class="updateBox">
            <form action="" method="POST">
                <label for="oldTable">Old Semester</label>
                <input type="text" id="oldTable" name="oldTable" placeholder="From semester" required onclick="hideErrorMsg()"><br>
                <label for="newTable">New Semester</label>
                <input type="text"  id="newTable" name="newTable" placeholder="To semesster" required onclick="hideErrorMsg()"><br>
                <input type="submit" name="submitBtn">  
            </form>
            
            <span class="errorMsg"><?php if(isset($error)){
                echo $error; }
                ?></span>
        </div>
    </div>

    <script>
       
        function hideErrorMsg(){
            let errorMsg = document.querySelector(".wrapper .errorMsg");
            errorMsg.style.display = "none";
        }
    </script>
</body>
</html>