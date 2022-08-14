<?php 
session_unset();
session_destroy();

header("Location: http://localhost/crystal/Index/login.php");


?>