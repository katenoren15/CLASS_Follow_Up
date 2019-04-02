<?php
    session_start();
    unset($_SESSION["loggedin"]);
    setcookie ("username",$user,time()- (10 * 365 * 24 * 60 * 60));  
    setcookie ("psword",$passw,time()- (10 * 365 * 24 * 60 * 60));
    header('location:login.php');
?>