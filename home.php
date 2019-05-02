<?php
    if ($_SESSION["login"] == false){
        header('location:login.php');
    }else{
    ?>
<?php
session_start();
require_once ('includes/dbconnect.php');
$connection = db_connect();

$query = "SELECT COUNT(student_id) FROM students";
$ret = mysqli_query($connection, $query);
$row = mysqli_fetch_array($ret);
$query2 = "SELECT COUNT(student_id) FROM students WHERE enrollment_status = 'Enrolled'";
$ret2 = mysqli_query($connection, $query2);
$row2 = mysqli_fetch_array($ret2);
$query3 = "SELECT COUNT(student_id) FROM students WHERE enrollment_status = 'Enrollment Pending'";
$ret3 = mysqli_query($connection, $query3);
$row3 = mysqli_fetch_array($ret3);
$query4 = "SELECT COUNT(student_id) FROM students WHERE enrollment_status = 'Not enrolled'";
$ret4 = mysqli_query($connection, $query4);
$row4 = mysqli_fetch_array($ret4);


?>
<br>
<div class="jumbotron">
  <h1 class="text-center">Welcome to CLASS Follow Up</h1>
  <p class="text-center">Your tool for following up on all things CLASS</p>
</div>
<br><br><h2 class="text-center">Statistics</h2><hr>
<div class="col-sm-6">
    <br>
    <div class="well well-sm text-center">
        <h1><b><?php echo $row["COUNT(student_id)"]?></b></h1><br>total students
    </div>
</div>
<div class="col-sm-6">
    <br>
    <div class="well well-sm text-center">
        <h1><b><?php echo $row2["COUNT(student_id)"]?></b></h1><br>total students enrolled in CLASS
    </div>
</div>
<div class="col-sm-6">
    <br>
    <div class="well well-sm text-center">
        <h1><b><?php echo $row4["COUNT(student_id)"]?></b></h1><br>total students not enrolled in CLASS
    </div>
</div>
<div class="col-sm-6">
    <br>
    <div class="well well-sm text-center">
        <h1><b><?php echo $row3["COUNT(student_id)"]?></b></h1><br>total students with pending enrollments
    </div>
</div>

<div class="col-sm-12">
            <br>
            <br><br><h2 class="text-center">Notifications</h2><hr>


<?php

    $query4 = "SELECT student_grade.grade, student_grade.end_date, student_grade.student_id, students.first_name, students.last_name, students.middle_name FROM student_grade, students WHERE students.student_id = student_grade.student_id";
    $ret4 = mysqli_query($connection, $query4);
    
    $num_results = mysqli_num_rows($ret4);
    
    for($i = 0; $i < $num_results; $i++){
        $row4 = mysqli_fetch_array($ret4);
        if(strtotime($row4["end_date"]) < strtotime("90 days")) {
           
            ?>
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo "<strong>" . $row4["first_name"] ." ". $row4["middle_name"] ." ". $row4["last_name"] . "'s </strong> end date for grade " . $row4["grade"] . " is in <strong>less than 90 days</strong> (" . $row4["end_date"] .")"; ?>
            </div>
               
            <?php
            }
    }
?>
</div>
    <?php } ?>