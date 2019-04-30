<?php
    require_once ('includes/dbconnect.php');
    $connection = db_connect();
    session_start();
    $userid = $_SESSION["user"];


$outputenrollment = '';
if(isset($_POST["query"])){
    $search = mysqli_real_escape_string($connection, $_POST["query"]);
    $query = "SELECT * FROM enrollments WHERE (`enrollment_id` LIKE '".$search."%') or (`student_id` LIKE '".$search."%') or (`enrollment_type` LIKE '".$search."%') or (`enrollment_date` LIKE '".$search."%') or (`grade_of_enrollment` LIKE '".$search."%') or (`cat_status` LIKE '%".$search."%') or (`documentation_sent` LIKE '%".$search."%')";
}else{
    if($_POST["request"]){
        $request = $_POST["request"];
        $query = "SELECT * FROM enrollments ORDER BY $request";
      }else{
        $query = "SELECT * FROM enrollments";
      }
}
$result = mysqli_query($connection, $query);
if(mysqli_num_rows($result) > 0){
 $outputenrollment .= ' <div class="table-responsive">
   <table class="table table-bordered" id="enrolllment_table">
    <tr>
        <th>Enrollment ID</th>
        <th>Student ID</th>
        <th>Enrollment Type</th>
        <th>Enrollment Date</th>
        <th>Grade</th>
        <th>CAT Status</th>
        <th>Documentation Sent</th>
        <th colspan="2">Commands</th>
    </tr>';
 while($row = mysqli_fetch_array($result))
 {
  $outputenrollment .= '
   <tr>
        <td>' .$row["enrollment_id"]. '</td>
        <td>' .$row["student_id"]. '</td>
        <td>' .$row["enrollment_type"]. '</td>
        <td>' .$row["enrollment_date"]. '</td>
        <td>' .$row["grade_of_enrollment"]. '</td>
        <td>' .$row["cat_status"]. '</td>
        <td>' .$row["documentation_sent"].'</td>
        <td> <input type="button" class="btn btn-primary" value="View"></td>
        <td> <form action="edit.php?id=' .$row['enrollment_id']. '" method="post"><input type="submit" class="button btn btn-default" id="' .$row["enrollment_id"]. '" value="Edit" name="editenrollment"></form></td>
   </tr>
  ';
 }

 echo $outputenrollment;
}else
{
 echo 'Data Not Found';
}
?>
