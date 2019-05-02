<?php
session_start();
require_once ('includes/dbconnect.php');
$connection = db_connect();

    @$page = $_GET["page"];
    switch(@$page){
        case "":
            $home = "";
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
                            <?php if($_SESSION["level"] == "User"){ ?> 
                            <li><a href="myaccount.php">My Account</a></li>
                            <li><a href="signout.php">Sign Out</a></li>
                       <?php }else{ ?> 
                            <li><a href="myaccount.php">My Account</a></li>
                            <!--<li><a href="br.php">Backup and Restore</a></li>-->
                            <li><a href="signout.php">Sign Out</a></li>
                        <?php } ?>
                        </ul>
                        </li></a></li>
                        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-bell"></span> Notifications</a>
                    
                    <ul class="dropdown-menu">
                    <?php

                        $query4 = "SELECT student_grade.grade, student_grade.end_date, student_grade.student_id, students.first_name, students.last_name, students.middle_name FROM student_grade, students WHERE students.student_id = student_grade.student_id";
                        $ret4 = mysqli_query($connection, $query4);
                        $num_results = mysqli_num_rows($ret4);

                        for($i = 0; $i < $num_results; $i++){
                            $row4 = mysqli_fetch_array($ret4);
                            if(strtotime($row4["end_date"]) < strtotime("90 days")) {
       
                    ?>
                    <li class="alert alert-warning alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <?php echo "<strong>" . $row4["first_name"] ." ". $row4["middle_name"] ." ". $row4["last_name"] . "'s </strong> end date for grade " . $row4["grade"] . " is in <strong>less than 90 days</strong> (" . $row4["end_date"] .")"; ?>
                    </li>
           
                <?php
                 }
}
?>  </li></ul>
                    </ul>
            </div>
        </div>
  

    
        
       
      

    

