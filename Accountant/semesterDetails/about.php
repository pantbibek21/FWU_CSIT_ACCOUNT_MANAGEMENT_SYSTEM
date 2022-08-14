<?php 
$sem = $_GET["semester"];

session_start();
switch($sem){
    case 0: 
        $semester = "First";
        $heading = "First Semester Student Details";
        break;
    case 1:
        $semester = "Second";
        $heading = "Second Semester Student Details";
        break;
    case 2:
        $semester = "Third";
        $heading = "Third Semester Student Details";
        break;
    case 3:
        $semester = "Fourth";
        $heading = "Fourth Semester Student Details";
        break;
    case 4:
        $semester = "Fifth";
        $heading = "Fifth Semester Student Details";
        break;
    case 5:
        $semester = "Sixth";
        $heading = "Sixth Semester Student Details";
        break;
    case 6:
        $semester = "Seventh";
        $heading = "Seventh Semester Student Details";
        break;
    case 7:
        $semester = "Eighth";
        $heading = "Eighth Semester Student Details";
        break;
        
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>First Semester</title>
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="common.css">
</head>
<body>
<header class="header">
<a href="http://localhost/CRYSTAL/Accountant/semesterDetails/index.php">Back</a>
        <a href="#">Logout</a>
    </header>
    <h1 class="heading"><?php echo $heading ?></h1>
    
    
    <div class="container">
    <span id="notification"><?php if(isset($_SESSION['deleteNotification'])){
    echo $_SESSION['deleteNotification']; }?></span>
        <table>
            <tr>
                <th>Roll No</th>
                <th>Name</th>
                <th>Phone Number</th>
                <th>Registration Number</th>
                <th>Address</th>
                <th>Email</th>
            </tr>
        <?php 

        
            require "../../Database/dbConnection.php";
            $getRecords = "SELECT * FROM studentdetail where semester='$semester' order by rollNo ASC";
            $response = mysqli_query($conn, $getRecords);
            if(mysqli_num_rows($response) > 0){
                while($row = mysqli_fetch_assoc($response)){

         ?>
            <tr>
                <td><?php echo $row['rollNo'] ?></td>
                <td><?php echo $row['name'] ?></td>
                <td><?php echo $row['phoneNumber'] ?></td>
                <td><?php echo $row['registrationNumber'] ?></td>
                <td><?php echo $row['address'] ?></td>
                <td><?php echo $row['email'] ?></td>
                <td><a style="color: red;" href="delete.php">Delete</a></td>
            </tr>

        <?php 
         $_SESSION['deleteEmail'] = $row['email'];
         $_SESSION['semValue'] = $sem;
                }
            }
        ?>
            
        </table>
    </div>

    <script>
        let notification = document.getElementById("notification");
        window.addEventListener("click",function(){
            notification.style.display="none";
        })
    </script>
</body>
</html>