<?php
require_once ('includes/dbconnect.php');
$connection = db_connect();
session_start();
$userid = $_SESSION["user"];

$purpose = mysqli_real_escape_string($connection, $_POST["purpose"]);

if($purpose == "addstudent"){

    if(!empty($_POST)){   
        $output = ''; 
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
            $ret = mysqli_query($connection, $query); 
        }else{
            $dateod = mysqli_real_escape_string($connection, $_POST["newdod"]); 

            $query = "INSERT INTO students(student_id, first_name, middle_name, last_name, date_of_birth, gender, enrollment_status, student_type, date_of_departure) VALUES('$studentid', '$fname', '$midname', '$lname', '$dob', '$gender', '$enrollmentstat', '$studenttype', '$dateod')";  
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
                    <th colspan="2">Commands</th>
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
                    </tr>
                    ';
                }
            echo $output;
        }else{
         echo 'Data Not Found';
        }
    }
    }

}else if($purpose == "addenrollment"){
if(!empty($_POST)){   
    $output = ''; 
    $enrollmentid = mysqli_real_escape_string($connection, $_POST["enrollmentid"]);
    $studentid = mysqli_real_escape_string($connection, $_POST["studentid"]);
    $enrollmenttype = mysqli_real_escape_string($connection, $_POST["enrollmenttype"]);
    $enrollmentdate = mysqli_real_escape_string($connection, $_POST["enrollmentdate"]);
    $grade = mysqli_real_escape_string($connection, $_POST["grade"]);
    $catstatus= mysqli_real_escape_string($connection, $_POST["catstatus"]);
    $docsent = mysqli_real_escape_string($connection, $_POST["docsent"]);

    $query = "INSERT INTO `enrollments`(`enrollment_id`, `student_id`, `enrollment_type`, `enrollment_date`, `grade_of_enrollment`, `cat_status`, `documentation_sent`) VALUES('$enrollmentid', '$studentid', '$enrollmenttype', '$enrollmentdate', '$grade', '$catstatus', '$docsent')";  
    $ret = mysqli_query($connection, $query); 
    echo $query;
    if($ret){   
        if(isset($_POST["query"])){
            $search = mysqli_real_escape_string($connection, $_POST["query"]);
            $query1 = "SELECT * FROM `enrollments` WHERE (`enrollment_id` LIKE '".$search."%') or (`student_id` LIKE '".$search."%') or (`enrollment_type` LIKE '".$search."%') or (`enrollment_date` LIKE '".$search."%') or (`grade_of_enrollment` LIKE '".$search."%') or (`cat_status` LIKE '%".$search."%') or (`documentation_sent` LIKE '%".$search."%')";
        }else{
            $query1 = "SELECT enrollments.enrollment_id, enrollments.enrollment_type, enrollments.enrollment_date, enrollments.grade_of_enrollment, enrollments.cat_status, enrollments.documentation_sent, students.first_name, students.middle_name, students.last_name FROM enrollments, students WHERE enrollments.student_id = students.student_id";
        }
        $result = mysqli_query($connection, $query1);
    if(mysqli_num_rows($result) > 0){
        $output .= ' <div class="table-responsive">
       <table class="table table-bordered" id="student_table">
            <tr>
                <th>Enrollment ID</th>
                <th>Student Name</th>
                <th>Enrollment Type</th>
                <th>Enrollment Date</th>
                <th>Grade</th>
                <th>CAT Status</th>
                <th>Documentation Sent</th>
                <th colspan="2">Commands</th>
            </tr>';
            while($row = mysqli_fetch_array($result)){
                $output .= '
                <tr>
                <td contenteditable="true" data-old_value="' .$row["first_name"]. '" onBlur="saveToDatabase(this, "first_name","' . $row["enrollment_id"] .'")" onClick="showEdit(this);">' .$row["enrollment_id"]. '</td>
                <td contenteditable="true" data-old_value="'. $row["middle_name"]. '" onBlur="saveToDatabase(this, "middle_name", "' . $row["enrollment_id"] .'")" onClick="showEdit(this);">'. $row["first_name"] . " ". $row["middle_name"] . " ".$row["last_name"]. '</td>
                <td contenteditable="true" data-old_value="' .$row["last_name"]. '" onBlur="saveToDatabase(this, "last_name", "' . $row["enrollment_id"] .'")" onClick="showEdit(this);">' .$row["enrollment_type"]. '</td>
                <td contenteditable="true" data-old_value="' .$row["date_of_birth"]. '" onBlur="saveToDatabase(this, "date_of_birth","' . $row["enrollment_id"] .'")" onClick="showEdit(this);">' .$row["enrollment_date"]. '</td>
                <td contenteditable="true" data-old_value="' .$row["gender"]. '" onBlur="saveToDatabase(this, "gender","' . $row["enrollment_id"] .'")" onClick="showEdit(this);">' .$row["grade_of_enrollment"]. '</td>
                <td contenteditable="true" data-old_value="' .$row["enrollment_status"]. '" onBlur="saveToDatabase(this, "enrollment_status","' . $row["enrollment_id"] .'")" onClick="showEdit(this);">' .$row["cat_status"]. '</td>
                <td contenteditable="true" data-old_value="' .$row["student_type"].'" onBlur="saveToDatabase(this, "student_type","' . $row["enrollment_id"] .'")" onClick="showEdit(this);">' .$row["documentation_sent"].'</td>
                <td> <a href="viewstudents.php?id=' .$row['student_id']. '"><input type="button" class="btn btn-primary" value="View"></a></td>
                <td> <input type="button" class="button edit_data btn btn-default" id="' .$row["student_id"]. '" value="Edit" name="edit"></td>
                </tr>
                ';
            }
        echo $output;
    }else{
     echo 'Data Not Found';
    }
}
}
} else{

    if(!empty($_POST)){   
        $output = ''; 
        $courseid = mysqli_real_escape_string($connection, $_POST["courseid"]);
        $coursename = mysqli_real_escape_string($connection, $_POST["coursename"]);
        $grade = mysqli_real_escape_string($connection, $_POST["grade"]);
        $subject = mysqli_real_escape_string($connection, $_POST["subject"]);
        $comp= mysqli_real_escape_string($connection, $_POST["comp"]);
        $numtests = mysqli_real_escape_string($connection, $_POST["numtests"]);
    
        $query = "INSERT INTO `courses`(`course_id`, `course_name`, `subjects`, `grade`, `number_of_tests`, `components`) VALUES('$courseid', '$coursename', '$subject', '$grade', '$numtests', '$comp')";  
        $ret = mysqli_query($connection, $query); 
        echo $query;
        if($ret){   
            if(isset($_POST["query"])){
                $search = mysqli_real_escape_string($connection, $_POST["query"]);
                $query1 = "SELECT * FROM `courses` WHERE (`course_id` LIKE '".$search."%') or (`course_name` LIKE '".$search."%') or (`subjects` LIKE '".$search."%') or (`grade` LIKE '".$search."%') or (`number_of_tests` LIKE '".$search."%') or (`components` LIKE '".$search."%')";
            }else{
                $query1 = "SELECT * FROM courses";
            }
            $result = mysqli_query($connection, $query1);
        if(mysqli_num_rows($result) > 0){
            $output .= ' <div class="table-responsive">
           <table class="table table-bordered" id="course_table">
                <tr>
                    <th>Course ID</th>
                    <th>Course Name</th>
                    <th>Grade</th>
                    <th>Subject</th>
                    <th>Components</th>
                    <th>Number of Tests</th>
                    <th colspan="2">Commands</th>
                </tr>';
                while($row = mysqli_fetch_array($result)){
                    $output .= '
                    <tr>
                    <td contenteditable="true" data-old_value="' .$row["first_name"]. '" onBlur="saveToDatabase(this, "first_name","' . $row["enrollment_id"] .'")" onClick="showEdit(this);">' .$row["course_id"]. '</td>
        <td contenteditable="true" data-old_value="'. $row["middle_name"]. '" onBlur="saveToDatabase(this, "middle_name", "' . $row["enrollment_id"] .'")" onClick="showEdit(this);">'. $row["course_name"]. '</td>
        <td contenteditable="true" data-old_value="' .$row["last_name"]. '" onBlur="saveToDatabase(this, "last_name", "' . $row["enrollment_id"] .'")" onClick="showEdit(this);">' .$row["grade"]. '</td>
        <td contenteditable="true" data-old_value="' .$row["date_of_birth"]. '" onBlur="saveToDatabase(this, "date_of_birth","' . $row["enrollment_id"] .'")" onClick="showEdit(this);">' .$row["subjects"]. '</td>
        <td contenteditable="true" data-old_value="' .$row["date_of_birth"]. '" onBlur="saveToDatabase(this, "date_of_birth","' . $row["enrollment_id"] .'")" onClick="showEdit(this);">' .$row["components"]. '</td>
        <td contenteditable="true" data-old_value="' .$row["enrollment_status"]. '" onBlur="saveToDatabase(this, "enrollment_status","' . $row["enrollment_id"] .'")" onClick="showEdit(this);">' .$row["number_of_tests"]. '</td>
        <td> <input type="button" class="btn btn-primary" value="View"></td>
        <td> <input type="button" class="button edit_data btn btn-default" id="' .$row["student_id"]. '" value="Edit" name="edit"></td>
                    </tr>
                    ';
                }
            echo $output;
        }else{
         echo 'Data Not Found';
        }
    }
    }

}






?>


