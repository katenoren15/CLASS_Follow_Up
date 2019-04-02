<?php
session_start();
    @$page = $_GET["page"];
    switch(@$page){
        case "":
            $index = "class='active'";
            $students = "";
            $enrollments = "";
            $orders = "";
            $courses = "";
            break;
        case "index":
            $index = "class='active'";
            $students = "";
            $enrollments = "";
            $orders = "";
            $courses = "";
            break;
        case "students":
            $index = "";
            $students = "class='active'";
            $enrollments = "";
            $orders = "";
            $courses = "";
            break;
        case "enrollments":
            $index = "";
            $students = "";
            $enrollments = "class='active'";
            $orders = "";
            $courses = "";
            break;
        case "orders":
            $index = "";
            $students = "";
            $enrollments = "";
            $orders = "class='active'";
            $courses = "";
            break;
        case "courses":
            $index = "";
            $students = "";
            $enrollments = "";
            $orders = "";
            $courses = "class='active'";
            break;
        case "viewstudents":
            $index = "";
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
  <link rel="stylesheet" href="./css/stylesheet.css"/>
</head>
<body>

<div class="container-fluid">
        <div class="row">
            <div class="col-sm-2 side full-height">
                <a href="index.php"><img class= "img-thumbnail" src="Images/Logo_CLASS.jpg" alt="CLASS logo"/></a>
                <a href="index.php" <?php echo $index ?>><span class="glyphicon glyphicon-home"></span> Home</a>
                <a href="index1.php?page=students" <?php echo $students ?>><span class="glyphicon glyphicon-user"></span> Students</a>
                <a href="index1.php?page=enrollments" <?php echo $enrollments ?>><span class="glyphicon glyphicon-file"></span> Enrollments</a>
                <a href="index1.php?page=orders" <?php echo $orders ?>><span class="glyphicon glyphicon-shopping-cart"></span> Orders </a>
                <a href="index1.php?page=courses" <?php echo $courses ?>><span class="glyphicon glyphicon-book"></span> Courses </a>
            </div>

            <nav class=" col-md-10 container-fluid" style="background-color: #e3f2fd;">
                <div class="container-fluid">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span><?php    
                        if($_SESSION["loggedin"] == true){
                        echo "  Welcome, " . $_SESSION['username'];
                        }   
                        ?>  </a>
                        <ul class="dropdown-menu">
                            <li><a href="myaccount.php">My Account</a></li>
                            <li><a href="signout.php">Sign Out</a></li>
                            <li><a href="login.php">Login</a></li>
                            <li><a href="index1.php?page=viewstudents">view</a></li>
                        </ul>
                        </li></a></li>
                        <li><a href="index.php"><span class="glyphicon glyphicon-bell"></span> Notifications</a></li>
                    </ul>
                </div>
            </nav>


  

    
        
       
      

    

