<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semester Detials</title>
    <link rel="stylesheet" href="main.css">
</head>

<body>
    <header class="header">
        <a href="http://localhost/CRYSTAL/Accountant/index/accountant.php">Back</a>
        <a href="#">Logout</a>
    </header>

    <div class="wrapper">
        <a href="about.php" class="semesterLink">First Semester</a>
        <a href="about.php" class="semesterLink">Second Semester</a>
        <a href="about.php" class="semesterLink">Third Semester</a>
        <a href="about.php" class="semesterLink">Fourth Semester</a>
        <a href="about.php" class="semesterLink">Fifth Semester</a>
        <a href="about.php" class="semesterLink">Sixth Semester</a>
        <a href="about.php" class="semesterLink">Seventh Semester</a>
        <a href="about.php" class="semesterLink">Eighth Semester</a>
    </div>

    <script>
        var semesters = document.querySelectorAll(".semesterLink");

        console.log(semesters[1].href);

        for (let i = 0; i < 8; i++) {
            // semesters[i].href += '?query=';
            // semesters[i].href += `${i}`;

            semesters[i].addEventListener('click', function(event) {
                // Stop the link from redirecting
                event.preventDefault();

                // Redirect instead with JavaScript
                window.location.href = semesters[i].href + '?semester=' + `${i}`;
            }, false);

            
            console.log(semesters[i].href);
        }

        //       element.href += '?query=value';
    </script>
</body>

</html>