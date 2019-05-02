<?php
    require_once ('includes/dbconnect.php');
    $connection = db_connect();
    session_start();
    $userid = $_SESSION["user"];



    $outputstudent = '';
if(isset($_POST["query"])){
    $search = mysqli_real_escape_string($connection, $_POST["query"]);
    $query = "SELECT * FROM `students` WHERE (`student_id` LIKE '".$search."%') or (`first_name` LIKE '".$search."%') or (`middle_name` LIKE '".$search."%') or (`last_name` LIKE '".$search."%') or (`date_of_birth` LIKE '%".$search."%') or (`gender` LIKE '".$search."%') or (`enrollment_status` LIKE '".$search."%') or (`student_type` LIKE '".$search."%') or (`date_of_departure` LIKE '%".$search."%')";
}else{
  if($_POST["request"]){
    $request = $_POST["request"];
    $query = "SELECT * FROM students ORDER BY $request";
  }else{
    $query = "SELECT * FROM students";
  }
}
$result = mysqli_query($connection, $query);
if(mysqli_num_rows($result) > 0){
 $outputstudent .= ' <div class="table-responsive">
   <table class="table table-bordered" id="student_table">
    <tr>
    <th>Student ID</th>
    <th>First Name</th>
    <th>Middle Name</th>
    <th>Last Name</th>
    <th>Date of Birth</th>
    <th>Gender</th>
    <th>Current Grade</th>
    <th>Enrollment Status</th>
    <th>Current or Past</th>
    <th>Date of Departure</th>
    <th colspan="2">Commands</th>
    </tr>';
 while($row = mysqli_fetch_array($result))
 {
  $outputstudent .= '
   <tr id="row'. $row["student_id"].'">
        <td>' .$row["student_id"].'</td>
        <td>' .$row["first_name"]. '</td>
        <td>'. $row["middle_name"]. '</td>
        <td>' .$row["last_name"]. '</td>
        <td>' .$row["date_of_birth"]. '</td>
        <td>' .$row["gender"]. '</td>
        <td>' .$row["current_grade"]. '</td>
        <td>' .$row["enrollment_status"]. '</td>
        <td>' .$row["student_type"].'</td>
        <td>' .$row["date_of_departure"]. '</td>
        <td> <a href="viewstudents.php?id=' .$row['student_id']. '"><input type="button" class="btn btn-primary" value="View"></a></td>
        <td> <form method="post" action="edit.php?id=' .$row['student_id']. '"><input type="submit" class="btn btn-default" id="' .$row["student_id"]. '" value="Edit" name="editstudent"></form></td>
   </tr>
  ';
 }

 echo $outputstudent;
}else
{
 echo 'Data Not Found';
}
 
?>
