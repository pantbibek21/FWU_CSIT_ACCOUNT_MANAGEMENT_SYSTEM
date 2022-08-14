<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accountant : Home</title>
    <link rel="stylesheet" href="../payment/payment.css">
    <link rel="stylesheet" href="accountantStylesheet.css">
    <style>
       
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="dateTime">
                <div class="time">
                    <span id="hour">12</span>
                    <span> : </span>
                    <span id="minute">12</span>
                    <span> : </span>
                    <span id="second">12</span>
                    <span id="session"></span>

                </div>
                <div class="date"><?php echo date("d F, Y (l)"); ?></div>
            </div>
            <a href="../index/accountant.php"  style="color: black; margin-left: auto; margin-right: 10px;">Reload</a>
            <div class="Logout">
                <a href="../../Index/logout.php" style="color: black;">Logout</a>
            </div>
        </div>

        <div class="quoteWrapper">
            <div class="welcomeMsg">Good Morning, <span class="userName">Gautam Mishra </span>!</div>

            <div class="quote">Getting best quote....</div>

            <div class="author"></div>
        </div>

        <div class="menu">
            <a href="../payment/payment.php">Payment</a>
            <a href="../studentDetails/studentInfo.php">Student Details</a>
            <a href="../semesterDetails/index.php">Semester Details</a>
            <a href="../Update/copyTable.php">Update Semesters</a>
        </div>
    </div>


    <script src="quoteGenerator.js"></script>
</body>

</html>