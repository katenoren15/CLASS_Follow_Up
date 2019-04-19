<?php
require_once ('includes/dbconnect.php');
$connection = db_connect();
session_start();
$userid = $_SESSION["user"];

if(!empty($_POST)){   
    $output = '';
    $message = '';  
    $studentid = mysqli_real_escape_string($connection, $_POST["newid"]);
    $fname = mysqli_real_escape_string($connection, $_POST["newfname"]);
    $midname = mysqli_real_escape_string($connection, $_POST["newmidname"]);
    $lname = mysqli_real_escape_string($connection, $_POST["newlname"]);
    $dob = mysqli_real_escape_string($connection, $_POST["newdob"]);
    $gender = mysqli_real_escape_string($connection, $_POST["newgender"]);
    $enrollmentstat = mysqli_real_escape_string($connection, $_POST["newenrollmentstat"]);
    $studenttype = mysqli_real_escape_string($connection, $_POST["newstudenttype"]);
    if(empty($_POST["newdod"])){
        $dateod = "NULL";
        $query = "INSERT INTO students(student_id, first_name, middle_name, last_name, date_of_birth, gender, enrollment_status, student_type, date_of_departure) VALUES('$studentid', '$fname', '$midname', '$lname', '$dob', '$gender', '$enrollmentstat', '$studenttype', $dateod)";  
        $message = 'Data Inserted'; 
        $ret = mysqli_query($connection, $query); 
    }else{
        $dateod = mysqli_real_escape_string($connection, $_POST["newdod"]); 
        $query = "INSERT INTO students(student_id, first_name, middle_name, last_name, date_of_birth, gender, enrollment_status, student_type, date_of_departure) VALUES('$studentid', '$fname', '$midname', '$lname', '$dob', '$gender', '$enrollmentstat', '$studenttype', '$dateod')";  
        $message = 'Data Inserted'; 
        $ret = mysqli_query($connection, $query); 
    }
    if($ret){  
        $output .= '<label class="text-success">' . $message . '</label>';  
        if(isset($_POST["query"])){
            $search = mysqli_real_escape_string($connection, $_POST["query"]);
            $query1 = "SELECT * FROM `students` WHERE (`student_id` LIKE '".$search."%') or (`first_name` LIKE '".$search."%') or (`middle_name` LIKE '".$search."%') or (`last_name` LIKE '".$search."%') or (`date_of_birth` LIKE '%".$search."%') or (`gender` LIKE '".$search."%') or (`enrollment_status` LIKE '".$search."%') or (`student_type` LIKE '".$search."%') or (`date_of_departure` LIKE '%".$search."%')";
        }else{
            $query1 = "SELECT * FROM students";
        }
        $result = mysqli_query($connection, $query1);
    if(mysqli_num_rows($result) > 0){
        $output .= ' <div class="table-responsive">
       <table class="table table-bordered" id="student_table">
            <tr>
                <th>Student ID</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Last Name</th>
                <th>Date of Birth</th>
                <th>Gender</th>
                <th>Enrollment Status</th>
                <th>Current or Past</th>
                <th>Date of Departure</th>
                <th colspan="3">Commands</th>
            </tr>';
            while($row = mysqli_fetch_array($result)){
                $output .= '
                <tr>
                    <td id="id_val'. $row["student_id"]. '">' .$row["student_id"].'</td>
                    <td id="fname_val'. $row["student_id"]. '">' .$row["first_name"]. '</td>
                    <td id="midname_val'. $row["student_id"]. '">'. $row["middle_name"]. '</td>
                    <td id="lname_val'. $row["student_id"]. '">' .$row["last_name"]. '</td>
                    <td id="dob_val'. $row["student_id"]. '">' .$row["date_of_birth"]. '</td>
                    <td id="gender_val'. $row["student_id"]. '">' .$row["gender"]. '</td>
                    <td id="enrollmentstat_val'. $row["student_id"]. '">' .$row["enrollment_status"]. '</td>
                    <td id="studenttype_val'. $row["student_id"]. '">' .$row["student_type"].'</td>
                    <td id="dod_val'. $row['student_id']. '">' .$row["date_of_departure"]. '</td>
                    <td> <a href="viewstudents.php?id=' .$row['student_id']. '"><input type="button" class="btn btn-primary" value="View"></a></td>
                    <td> <input type="button" class="button edit_button btn btn-default" id="edit_button' .$row["student_id"]. '" value="Edit" onclick= "edit_row(' .$row["student_id"]. ')"></td>
                    <td> <input type="button" class="button save_button btn btn-default" id="save_button' .$row["student_id"]. '" value="Save" onclick= "save_row(' .$row["student_id"]. ')"></td>
                </tr>
                ';
            }
        echo $output;
    }else{
     echo 'Data Not Found';
    }
}
}
?>


