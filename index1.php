<?php
require_once ('includes/dbconnect.php');
session_start();

@$page = $_GET["page"];

include ('includes/header.php');
switch (@$page){
    case "":
        include ("index.php");
        break;
    case "index":
        include ("index.php");
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
    case "viewstudents":
        include ("viewstudents.php");
        break;
}   


include ('includes/footer.php');
?>