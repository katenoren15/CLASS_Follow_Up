<?php
    require_once ('includes/dbconnect.php');
    $connection = db_connect();
    session_start();
    $userid = $_SESSION["user"];

    $output = '';
if(isset($_POST["query"])){
    $search = mysqli_real_escape_string($connection, $_POST["query"]);
    $query = "SELECT * FROM `students` WHERE (`student_id` LIKE '".$search."%') or (`first_name` LIKE '".$search."%') or (`middle_name` LIKE '".$search."%') or (`last_name` LIKE '".$search."%') or (`date_of_birth` LIKE '%".$search."%') or (`gender` LIKE '".$search."%') or (`enrollment_status` LIKE '".$search."%') or (`student_type` LIKE '".$search."%') or (`date_of_departure` LIKE '%".$search."%')";
}else{
 $query = "SELECT * FROM students";
}
$result = mysqli_query($connection, $query);
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
 while($row = mysqli_fetch_array($result))
 {
  $output .= '
   <tr id="row'. $row["student_id"].'">
        <td>' .$row["student_id"].'</td>
        <td contenteditable="true" data-old_value="' .$row["first_name"]. '" onBlur="saveInlineEdit(this, "first_name","' . $row["student_id"] .'")" onClick="highlightEdit(this);">' .$row["first_name"]. '</td>
        <td contenteditable="true" data-old_value="'. $row["middle_name"]. '" onBlur="saveInlineEdit(this, "middle_name", "' . $row["student_id"] .'")" onClick="highlightEdit(this);">'. $row["middle_name"]. '</td>
        <td contenteditable="true" data-old_value="' .$row["last_name"]. '" onBlur="saveInlineEdit(this, "last_name", "' . $row["student_id"] .'")" onClick="highlightEdit(this);">' .$row["last_name"]. '</td>
        <td contenteditable="true" data-old_value="' .$row["date_of_birth"]. '" onBlur="saveInlineEdit(this, "date_of_birth","' . $row["student_id"] .'")" onClick="highlightEdit(this);">' .$row["date_of_birth"]. '</td>
        <td contenteditable="true" data-old_value="' .$row["gender"]. '" onBlur="saveInlineEdit(this, "gender","' . $row["student_id"] .'")" onClick="highlightEdit(this);">' .$row["gender"]. '</td>
        <td contenteditable="true" data-old_value="' .$row["enrollment_status"]. '" onBlur="saveInlineEdit(this, "enrollment_status","' . $row["student_id"] .'")" onClick="highlightEdit(this);">' .$row["enrollment_status"]. '</td>
        <td contenteditable="true" data-old_value="' .$row["student_type"].'" onBlur="saveInlineEdit(this, "student_type","' . $row["student_id"] .'")" onClick="highlightEdit(this);">' .$row["student_type"].'</td>
        <td contenteditable="true" data-old_value="' .$row["date_of_departure"]. '" onBlur="saveInlineEdit(this, "date_of_departure","' . $row["student_id"] .'")" onClick="highlightEdit(this);">' .$row["date_of_departure"]. '</td>
        <td> <a href="viewstudents.php?id=' .$row['student_id']. '"><input type="button" class="btn btn-primary" value="View"></a></td>
        <td> <input type="button" class="button edit_button btn btn-default" id="edit_button' .$row["student_id"]. '" value="Edit" onclick= "edit_row(' .$row["student_id"]. ')"></td>
        <td> <input type="button" class="button save_button btn btn-default" id="save_button' .$row["student_id"]. '" value="Save" onclick= "save_row(' .$row["student_id"]. ')"></td>
   </tr>
  ';
 }

 echo $output;
}else
{
 echo 'Data Not Found';
}




?>
