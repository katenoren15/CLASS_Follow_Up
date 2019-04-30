<?php
    require_once ('includes/dbconnect.php');
    $connection = db_connect();
    session_start();
    $userid = $_SESSION["user"];


$outputorder = '';

if(isset($_POST["query"])){
    $search = mysqli_real_escape_string($connection, $_POST["query"]);
    $query = "SELECT * FROM `courses` WHERE (`course_id` LIKE '".$search."%') or (`course_name` LIKE '".$search."%') or (`subjects` LIKE '".$search."%') or (`grade` LIKE '".$search."%') or (`number_of_tests` LIKE '".$search."%') or (`components` LIKE '".$search."%')";
}else{
    if($_POST["request"]){
        $request = $_POST["request"];
        $query = "SELECT * FROM courses ORDER BY $request";
    }else{
        $query = "SELECT * FROM courses";
    }
}
$result = mysqli_query($connection, $query);
if(mysqli_num_rows($result) > 0){
 $outputorder .= ' <div class="table-responsive">
   <table class="table table-bordered" id="course_table">
    <tr>
        <th>Course ID</th>
        <th>Course Name</th>
        <th>Grade</th>
        <th>Subject</th>
        <th>Components</th>
        <th>Number of Tests</th>
        <th>Command</th>
    </tr>';
 while($row = mysqli_fetch_array($result))
 {
  $outputorder .= '
   <tr>
        <td>' .$row["course_id"]. '</td>
        <td>'. $row["course_name"]. '</td>
        <td>' .$row["grade"]. '</td>
        <td>' .$row["subjects"]. '</td>
        <td>' .$row["components"]. '</td>
        <td>' .$row["number_of_tests"]. '</td>
        <td> <form action="edit.php?id=' .$row['course_id']. '" method="post"><input type="submit" class="button edit_data btn btn-primary" id="' .$row["student_id"]. '" value="Edit" name="editcourse"></form></td>
   </tr>
  ';
 }

 echo $outputorder;
}else
{
 echo 'Data Not Found';
}
?>