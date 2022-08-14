<?php require "../partials/templateHeader.php";
echo "<a id=\"reloadBtn\" href='studentInfo.php'>Reload</a>";
?>
<?php if (isset($_SESSION['showContent'])) {

?>


<div class="content">
<h1 class="heading">Record Found !</h1>
<div class="imgWrapper">
<img src="../../Index/userProfiles/<?php echo $row['studentProfile'] ?>" alt="Your awesome picture..">
</div>
<div class="responseForm">
    <form action="updateStudentRecord.php" method="POST">
    <div class="formField">
        <label for="name">Name</label>
        <input type="text" value="<?php if(isset($row['name'])) echo $row['name'];  ?>" name= "name" id="name" disabled>
    </div>
    <div class="formField">
        <label for="semester">Semester</label>
        <input type="text" value="<?php if(isset($row['semester'])) echo $row['semester'];  ?>" name = "semester" id="semester" disabled>
    </div>
    <div class="formField">
        <label for="phoneNumber">Phone Number</label>
        <input type="text" value="<?php if(isset($row['phoneNumber'])) echo $row['phoneNumber'];  ?>" disabled name="phoneNum" id="phoneNumber">
    </div>
    <div class="formField">
        <label for="rollNo">Roll Number</label>
        <input type="text" value="<?php if(isset($row['rollNo'])) echo $row['rollNo'];  ?>" id="rollNo"  name="rollNo" disabled>
    </div>
    <div class="formField">
        <label for="registrationNumber">Reg. Number</label>
        <input type="text" value="<?php if(isset($row['registrationNumber'])) echo $row['registrationNumber'];  ?>" name="registrationNumber" id="registrationNumber" disabled>
    </div>
    <div class="formField">
        <label for="address">Address</label>
        <input type="text" value="<?php if(isset($row['address'])) echo $row['address'];  ?>" name = "address" id="address" disabled>
    </div>
    <div class="formField">
        <label for="email">Email</label>
        <input type="email" value="<?php if(isset($row['email'])) echo $row['email'];  ?>" name = "email" id="email" disabled>
    </div>
    <input type="button" value="UPDATE" id="updateBtn">
    <input type="submit" value="SAVE" name="saveBtn" id="saveBtn" disabled>
    </form>
    
</div>


<div class="paymentHistory">
    <div class="heading">Payment History</div>
    <hr class="lineBreak">
    <table>

         <tr>
            <th>SN</th>
            <th>Amount</th>
            <th>Purpose</th>
            <th>Date</th>
        </tr>
        <?php 
       
        $studentName = $row['name'];
        $studentRollNo = $row['rollNo'];
        $paymentEmail = $row['email'];
       
        $paymentRecordQuery = "SELECT * FROM admissiondetail WHERE email = '$paymentEmail'" ;
       $paymentRecords = mysqli_query($conn, $paymentRecordQuery);

       
       if(mysqli_num_rows($paymentRecords) > 0){
        $counter = 1;
           while($record = mysqli_fetch_assoc($paymentRecords)){
              
       ?>
       
        <tr>
            <td><?php echo $counter ?></td>
            <td><?php echo $record['amount'] ?></td>
            <td><?php echo $record['purpose'] ?></td>
            <td><?php echo $record['date'] ?></td>
        </tr>
        <?php
        $counter++;
            }
        }
        else {
            echo "<span class='notification'>No Payments made so far..</span>";
        }
         ?>
        
    </table>
</div>

    
  
</div>
<?php
}

?>
<script>
    
    let content = document.querySelector(".content");
    let saveBtn = document.getElementById("saveBtn");
   let nameField = document.getElementById("name");

    let reloadBtn = document.getElementById("reloadBtn");
    reloadBtn.style.cssText = "background: none;border-radius: 4px;padding: 3px 5px; border: 1px solid white; border-color: white;font-family: 'Poppins';margin-right: 10px;cursor: pointer;font-size: 17px;transition: all 0.5s ease; color: white; text-decoration: none; position: absolute; top: 14px; right: 120px;";

    let updateBtn = document.getElementById("updateBtn");
    updateBtn.addEventListener('click',()=>{
        let inputBoxes = document.getElementsByTagName("input");
        console.log(inputBoxes);

        for(let i=0; i<inputBoxes.length; i++){
            inputBoxes[i].disabled = false;
        }
        saveBtn.disabled = "true";

        for(let i=0; i<=10;i++){
            inputBoxes[i].addEventListener("click",function (){
                saveBtn.disabled = false;
            })
        }
        
    })
   
//     paymentBtn.addEventListener('click',()=>{
//         paymentBox.style.display = "block";
//    })

//    closeBtn.addEventListener("click",()=> {
//        paymentBox.style.display = "none";
//    })




</script> 

<?php require "../partials/templateFooter.php" ?>