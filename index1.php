<?php
require_once ('includes/dbconnect.php');
session_start();

@$page = $_GET["page"];

include ('includes/header.php');
switch (@$page){
    case "":
        include ("home.php");
        break;
    case "home":
        include ("home.php");
        break;
    case "students":
        include ("students.php");
        break;
    case "enrollments":
        include ("enrollments.php"); 
        break;
    case "orders":
        include ("orders.php"); 
        break; 
    case "courses":
        include ("courses.php");
        break;
}   


include ('includes/footer.php');
?>