<?php require "../partials/templateHeader.php" ; 
echo "<a id=\"reloadBtn\" href=\"../payment/payment.php\">Reload</a>";

?>
<?php if (isset($_SESSION['showContent'])) {
   $email = $row['email'];
    $sqlFetchUserSemester = "SELECT * FROM studentdetail WHERE email='$email'";
    $userImageRef = (mysqli_fetch_assoc(mysqli_query($conn, $sqlFetchUserSemester)))['studentProfile'];
    
    ?>


<div class="content">
    <h1 class="heading">Record Found !</h1>
    <div class="imgWrapper">
    <img src="../../Index/userProfiles/<?php echo $userImageRef ?>" alt="Your awesome picture..">
    </div>
    <div class="responseForm">
        <div class="formField">
            <label for="name">Name</label>
            <input type="text" value="<?php if(isset($row['name'])) echo $row['name'];  ?>" id="name" disabled>
        </div>
        <div class="formField">
            <label for="semester">Semester</label>
            <input type="text" value="<?php if(isset($row['semester'])) echo $row['semester'];  ?>" id="semester" disabled>
        </div>
        <div class="formField">
            <label for="phoneNumber">Phone Number</label>
            <input type="text" value="<?php if(isset($row['phoneNumber'])) echo $row['phoneNumber'];  ?>" id="phoneNumber" disabled>
        </div>
        <div class="formField">
            <label for="rollNo">Roll Number</label>
            <input type="text" value="<?php if(isset($row['rollNo'])) echo $row['rollNo'];  ?>" id="phoneNumber" disabled>
        </div>
        <div class="formField">
            <label for="registrationNumber">Reg. Number</label>
            <input type="text" value="<?php if(isset($row['registrationNumber'])) echo $row['registrationNumber'];  ?>" id="phoneNumber" disabled>
        </div>
        <div class="formField">
            <label for="address">Address</label>
            <input type="text" value="<?php if(isset($row['address'])) echo $row['address'];  ?>" id="address" disabled>
        </div>
        <div class="formField">
            <label for="email">Email</label>
            <input type="email" value="<?php if(isset($row['email'])) echo $row['email'];  ?>" id="email" disabled>
        </div>
</div>
    <button class="paymentBtn">Add Payment</button>

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
            $paymentRecordQuery = "SELECT * FROM admissiondetail WHERE name = '$studentName' AND rollNO = $studentRollNo" ;
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
    <form class="paymentForm" action="../payment/paymentInsertion.php" method="POST">
            <div class="formField">
                <label for="amount">Amount</label>
                <input type="number"  id="amount" name="amount" required>
            </div>
            <div class="formField">
                <label for="purpose">Purpose</label>
                <input type="text"  id="purpose" name="purpose" required>
            </div>
            <div class="formField">
                <label for="date">Date</label>
                <input type="text"  id="date" name="date" required>
            </div>
            
            <input type="submit" value="Go" name="btnSubmit">

            
            <span class="closeBtn">X</span>
        </form>    
        
      
</div>
<?php
}

?>


<script>
    let paymentBtn = document.querySelector(".content .paymentBtn");
    let paymentBox = document.querySelector(".content .paymentForm");
    let closeBtn = document.querySelector(".paymentForm .closeBtn ");
    let content = document.querySelector(".content");

    let reloadBtn = document.getElementById("reloadBtn");
    reloadBtn.style.cssText = "background: none;border-radius: 4px;padding: 3px 5px; border: 1px solid white; border-color: white;font-family: 'Poppins';margin-right: 10px;cursor: pointer;font-size: 17px;transition: all 0.5s ease; color: white; text-decoration: none; position: absolute; top: 14px; right: 120px;";
    console.log(closeBtn);
    paymentBtn.addEventListener('click',()=>{
        paymentBox.style.display = "block";
   })

   closeBtn.addEventListener("click",()=> {
       paymentBox.style.display = "none";
   })

   
</script>
<?php require "../partials/templateFooter.php" ?>