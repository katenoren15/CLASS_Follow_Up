<?php
session_start();
    @$page = $_GET["page"];
    switch(@$page){
        case "":
            $home = "class='active'";
            $students = "";
            $enrollments = "";
            $orders = "";
            $courses = "";
            break;
        case "home":
            $home = "class='active'";
            $students = "";
            $enrollments = "";
            $orders = "";
            $courses = "";
            break;
        case "students":
            $home = "";
            $students = "class='active'";
            $enrollments = "";
            $orders = "";
            $courses = "";
            break;
        case "enrollments":
            $home = "";
            $students = "";
            $enrollments = "class='active'";
            $orders = "";
            $courses = "";
            break;
        case "orders":
            $home = "";
            $students = "";
            $enrollments = "";
            $orders = "class='active'";
            $courses = "";
            break;
        case "courses":
            $home = "";
            $students = "";
            $enrollments = "";
            $orders = "";
            $courses = "class='active'";
            break;
        case "viewstudents":
            $home = "";
            $students = "class='active'";
            $enrollments = "";
            $orders = "";
            $courses = "";
            break;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>CLASS Follow Up</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./css/bootstrap.min.css">
  <script src="./js/jquery-3.3.1.js"></script>
  <script src="./js/bootstrap.min.js"></script>
  <script src=".js/modify_records.js"></script>
  <link rel="stylesheet" href="./css/stylesheet.css"/>
</head>
<body class="container-fluid">

<div>
        <div class="row">
            <div class="side">
                <a href="index1.php?page=home"><img class= "img-thumbnail" src="Images/Logo_CLASS.jpg" alt="CLASS logo"/></a>
                <a href="index1.php?page=home" <?php echo $home ?>><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;Home</a>
                <a href="index1.php?page=students" <?php echo $students ?>><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Students</a>
                <a href="index1.php?page=enrollments" <?php echo $enrollments ?>><span class="glyphicon glyphicon-file"></span>&nbsp;&nbsp;Enrollments</a>
                <a href="index1.php?page=orders" <?php echo $orders ?>><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;&nbsp;Orders </a>
                <a href="index1.php?page=courses" <?php echo $courses ?>><span class="glyphicon glyphicon-book"></span>&nbsp;&nbsp;Courses </a>
            </div>

            <div class="col-sm-12" style="background-color: #e3f2fd;">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span><?php    
                        if($_SESSION["login"] == true){
                        echo "  Welcome, " . $_SESSION['firstname'];
                        }   
                        ?>  </a>
                        <ul class="dropdown-menu">
                            <li><a href="myaccount.php">My Account</a></li>
                            <li><a href="signout.php">Sign Out</a></li>
                            <li><a href="login.php">Login</a></li>
                            <li><a href="br.php">Backup and Restore</a></li>
                        </ul>
                        </li></a></li>
                        <li><a href="index.php"><span class="glyphicon glyphicon-bell"></span> Notifications</a></li>
                    </ul>
            </div>
        </div>
  

    
        
       
      

    

