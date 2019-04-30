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


?>
<br>
<div class="col-sm-4">
<br>
    <div class="well well-sm text-center">
        <h1><b><?php echo $row["COUNT(student_id)"]?></b></h1><br>total students
    </div>
</div>
<div class="col-sm-4">
<br>
    <div class="well well-sm text-center">
        <h1><b><?php echo $row2["COUNT(student_id)"]?></b></h1><br>total students enrolled in CLASS
    </div>
</div>
<div class="col-sm-4">
    <br>
    <div class="well well-sm text-center">
        <h1><b><?php echo $row3["COUNT(student_id)"]?></b></h1><br>total students with pending enrollments
    </div>
</div>
<div class="col-sm-12">
            <br>
            <h1 id="notifications"><u>Notifications/Alerts</u></h1>
            
            <p>This is where all notifications will appear. Use bahes from bootstrap to help. Also get help from myaccount.php in DW Assignment.</p>
            <ul class="list-group">
                <li class="list-group-item"><?php echo $row4["end_date"]; ?></li>
                <li class="list-group-item">Dapibus ac facilisis in</li>
                <li class="list-group-item">Morbi leo risus</li>
                <li class="list-group-item">Porta ac consectetur ac</li>
                <li class="list-group-item">Vestibulum at eros</li>
        </ul>
        </div>
</div>
</div>

<?php
    $query4 = "SELECT * FROM student_grade, students WHERE students.student_id = student_grade.student_id";
    $ret4 = mysqli_query($connection, $query4);
    

    while($row4 = mysqli_fetch_array($ret4)){
        $endDate = strtotime($row4["end_date"]);
        $now = time();
        $diff = $endDate - $now;
        if($diff == 7776000){
            echo $row4["first_name"] . $row["middle_name"] . $row4["last_name"] . "'s enddate for grade " . $row4["grade"] . " is in 90 days (" . $row["end_date"] .")";
        }
    }


?>