<?php
    session_start();
    unset($_SESSION["login"]);
    unset($_SESSION["firstname"]);
    header('location:login.php');
?>