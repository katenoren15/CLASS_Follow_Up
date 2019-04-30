<?php
require_once ('includes/dbconnect.php');
$connection = db_connect();
session_start();
$s_id = $_SESSION["studentid"];
$purpose = $_POST["purpose"];

if($purpose == "addstudent"){
    $studentid = mysqli_real_escape_string($connection,$_POST["studentid"]);
    $fname = mysqli_real_escape_string($connection,$_POST["firstname"]);
    $midname = mysqli_real_escape_string($connection,$_POST["midname"]);
    $lname = mysqli_real_escape_string($connection,$_POST["lastname"]);
    $dob = mysqli_real_escape_string($connection,$_POST["dob"]);
    $gender = mysqli_real_escape_string($connection,$_POST["gender"]);
    $enrollmentstat = mysqli_real_escape_string($connection,$_POST["enrollmentstat"]);
    $studenttype = mysqli_real_escape_string($connection,$_POST["studenttype"]);
    $dod = mysqli_real_escape_string($connection,$_POST["dod"]);

    $query = "INSERT INTO students VALUES('$studentid', '$fname', '$midname', '$lname', '$dob', '$gender', '$enrollmentstat', '$studenttype', '$dod')";
    $ret = mysqli_query($connection, $query);
    if($ret){
        header("location:index1.php?page=students");
        echo "<div class='alert alert-success alert-dismissible'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Student added successful.</div>";
    }else{
        echo "<div class='alert alert-danger alert-dismissible'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Error" . mysqli_error($connection) ."</div>";
    }

}elseif($purpose == "editstudent"){
    $studentid = mysqli_real_escape_string($connection,$_POST["newstudentid"]);
    $fname = mysqli_real_escape_string($connection,$_POST["newfname"]);
    $midname = mysqli_real_escape_string($connection,$_POST["newmidname"]);
    $lname = mysqli_real_escape_string($connection,$_POST["newlname"]);
    $dob = mysqli_real_escape_string($connection,$_POST["newdob"]);
    $gender = mysqli_real_escape_string($connection,$_POST["newgender"]);
    $enrollmentstat = mysqli_real_escape_string($connection,$_POST["newenrollmentstat"]);
    $studenttype = mysqli_real_escape_string($connection,$_POST["newstudenttype"]);
    if(empty($_POST["newdod"])){
        $dod = "NULL";
        $query2 = "UPDATE students SET first_name ='$fname', middle_name ='$midname', last_name ='$lname', 
    date_of_birth ='$dob', gender ='$gender', enrollment_status ='$enrollmentstat', student_type ='$studenttype', date_of_departure = $dod WHERE student_id=\"$studentid\"";  
        $ret2 = mysqli_query($connection, $query2); 
    }else{
        $dod = mysqli_real_escape_string($connection, $_POST["newdod"]); 
        $query2 = "UPDATE students SET first_name ='$fname', middle_name ='$midname', last_name ='$lname', 
        date_of_birth ='$dob', gender ='$gender', enrollment_status ='$enrollmentstat', student_type ='$studenttype', date_of_departure ='$dod' WHERE student_id=\"$studentid\"";  
        $ret2 = mysqli_query($connection, $query2); 
    }
    if($ret2){
        header("location:index1.php?page=students");
        echo "<div class='alert alert-success alert-dismissible'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Student details edited successful.</div>";
    }else{
        echo "<div class='alert alert-danger alert-dismissible'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Error " . mysqli_error($connection) ."</div>";
    }

}elseif($purpose == "addenrollment"){
    $enrollmentid = mysqli_real_escape_string($connection,$_POST["enrollmentid"]);
    $studentid = mysqli_real_escape_string($connection,$_POST["studentid"]);
    $enrollmenttype = mysqli_real_escape_string($connection,$_POST["enrollmenttype"]);
    $enrollmentdate = mysqli_real_escape_string($connection,$_POST["enrollmentdate"]);
    $grade = mysqli_real_escape_string($connection,$_POST["grade"]);
    $catstatus = mysqli_real_escape_string($connection,$_POST["catstatus"]);
    $docsent = mysqli_real_escape_string($connection,$_POST["docsent"]);

    $query3 = "INSERT INTO enrollments VALUES('$enrollmentid', '$studentid', '$enrollmenttype', '$enrollmentdate', '$grade', '$catstatus', '$docsent')";
    $ret3 = mysqli_query($connection, $query3);
    if($ret3){
        header("location:index1.php?page=enrollments");
        echo "<div class='alert alert-success alert-dismissible'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Enrollement added successful.</div>";
    }else{
        echo "<div class='alert alert-danger alert-dismissible'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Error" . mysqli_error($connection) ."</div>";
    }

}elseif($purpose == "editenrollment"){
    $e_id = mysqli_real_escape_string($connection,$_POST["newenrollmentid"]);
    $enrollmenttype = mysqli_real_escape_string($connection,$_POST["newenrollmenttype"]);
    $enrollmentdate = mysqli_real_escape_string($connection,$_POST["newenrollmentdate"]);
    $grade = mysqli_real_escape_string($connection,$_POST["newgrade"]);
    $catstatus = mysqli_real_escape_string($connection,$_POST["newcatstatus"]);
    $docsent = mysqli_real_escape_string($connection,$_POST["newdocsent"]);

    $query4 = "UPDATE enrollments SET enrollment_type ='$enrollmenttype', enrollment_date ='$enrollmentdate', grade_of_enrollment ='$grade', 
    cat_status ='$catstatus', documentation_sent ='$docsent' WHERE enrollment_id=\"$e_id\"";
    $ret4 = mysqli_query($connection, $query4);
    if($ret4){
        header("location:index1.php?page=enrollments");
        echo "<div class='alert alert-success alert-dismissible'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Enrollment details edited successful.</div>";
    }else{
        echo "<div class='alert alert-danger alert-dismissible'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Error" . mysqli_error($connection) ."</div>";
    }

}elseif($purpose == "editorder"){
    $o_id = mysqli_real_escape_string($connection,$_POST["newordernum"]);
    $amountpaid = mysqli_real_escape_string($connection,$_POST["newamountpaid"]);
    $shipdetails = mysqli_real_escape_string($connection,$_POST["newshipdetails"]);
    $deliverystat = mysqli_real_escape_string($connection,$_POST["newdeliverystat"]);

    if(isset($_POST["file"])){
        $name= $_FILES['file']['name'];

        $tmp_name= $_FILES['file']['tmp_name'];

        $file_size = $_FILES['file']['size'];
        
        $file_type = $_FILES['file']['type'];

        $position= strpos($name, "."); 

        $fileextension= substr($name, $position + 1);

        $fileextension= strtolower($fileextension);

        $new_size = $file_size/1024;

        $name1= strtolower($name);

        $final_file=str_replace(' ','-',$name1);
    

        if (isset($final_file)) {
            $query5 = "UPDATE orders SET order_details = '$final_file', amount_paid = '$amountpaid', shipping_details = '$shipdetails', delivery_status = '$deliverystat' WHERE order_number =\"$o_id\"";
            $ret5 = mysqli_query($connection, $query5);
            
            $path = 'uploads/';

            if (!empty($final_file)){
                if (move_uploaded_file($tmp_name, $path.$final_file)) {
                    $query6 = "UPDATE uploads SET order_number= '$o_id', file_name= '$final_file' , file_type='$file_type', file_size= '$file_size' WHERE order_number= \"$o_id\"";
                    $ret6=  mysqli_query($connection, $query6);
                    if($ret6){
                        header("location:index1.php?page=orders");
                        echo "<div class='alert alert-success alert-dismissible'>
                        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Order details edited successful.</div>";
                    }else{
                        echo "<div class='alert alert-danger alert-dismissible'>
                        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Error" . mysqli_error($connection) ."</div>";
                    }
                }}}
    }else{
        $query5 = "UPDATE orders SET amount_paid = '$amountpaid', shipping_details = '$shipdetails', delivery_status = '$deliverystat' WHERE order_number =\"$o_id\"";
        $ret5 = mysqli_query($connection, $query5);
        if($ret5){
            header("location:index1.php?page=orders");
            echo "<div class='alert alert-success alert-dismissible'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Order details edited successful.</div>";
        }else{
            echo "<div class='alert alert-danger alert-dismissible'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Error" . mysqli_error($connection) ."</div>";
        }
    }

    

}elseif($purpose == "addcourse"){
    $courseid = mysqli_real_escape_string($connection,$_POST["courseid"]);
    $coursename = mysqli_real_escape_string($connection,$_POST["coursename"]);
    $grade = mysqli_real_escape_string($connection,$_POST["grade"]);
    $subject = mysqli_real_escape_string($connection,$_POST["subject"]);
    $comp = mysqli_real_escape_string($connection,$_POST["comp"]);
    $numtests = mysqli_real_escape_string($connection,$_POST["numtests"]);

    $query7 = "INSERT INTO courses VALUES('$courseid', '$coursename',  '$subject', '$grade', '$docsent', '$comp', '$numtests')";
    $ret7 = mysqli_query($connection, $query7);
    if($ret7){
        header("location:index1.php?page=courses");
        echo "<div class='alert alert-success alert-dismissible'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Student added successful.</div>";
    }else{
        echo "<div class='alert alert-danger alert-dismissible'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Error" . mysqli_error($connection) ."</div>";
    }


}elseif($purpose == "editcourse"){
    $c_id = mysqli_real_escape_string($connection,$_POST["newcourseid"]);
    $coursename = mysqli_real_escape_string($connection, $_POST["newcoursename"]);
    $grade = mysqli_real_escape_string($connection, $_POST["newgrade"]);
    $subject = mysqli_real_escape_string($connection, $_POST["newsubject"]);
    $comp = mysqli_real_escape_string($connection, $_POST["newcomp"]);
    $numtests = mysqli_real_escape_string($connection, $_POST["newnumtests"]);

        $query8 = "UPDATE courses SET course_name ='$coursename', subjects = '$subject', grade ='$grade',
        number_of_tests ='$numtests', components ='$comp' WHERE course_id=\"$c_id\"";
        $ret8 = mysqli_query($connection, $query8);
        if($ret8){
            header("location:index1.php?page=courses");
            echo "<div class='alert alert-success alert-dismissible'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Enrollment details edited successful.</div>";
        }else{
            echo "<div class='alert alert-danger alert-dismissible'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Error" . mysqli_error($connection) ."</div>";
        }
}elseif($purpose == "addgradeinfo"){
        $grade = mysqli_real_escape_string($connection, $_POST["grade"]);
        $enddate = mysqli_real_escape_string($connection, $_POST["enddate"]);
        $gcs = mysqli_real_escape_string($connection, $_POST["gcs"]);
        $rcs = mysqli_real_escape_string($connection, $_POST["rcs"]);
        $ds = mysqli_real_escape_string($connection, $_POST["ds"]);
    

    $query9 ="INSERT INTO student_grade VALUES('$s_id', '$grade', '$enddate', '$gcs', '$rcs', '$ds')";
    $ret9 = mysqli_query($connection, $query9);
    if($ret9){
        header("location:viewstudents.php?id=$s_id");
        echo "<div class='alert alert-success alert-dismissible'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Grade details added successful.</div>";
    }else{
        echo "<div class='alert alert-danger alert-dismissible'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Error" . mysqli_error($connection) ."</div>";
    }

}elseif($purpose == "editgradeinfo"){
    $grade = mysqli_real_escape_string($connection, $_POST["grade"]);
    $enddate = mysqli_real_escape_string($connection, $_POST["newendate"]);
    $gcs = mysqli_real_escape_string($connection, $_POST["newgcs"]);
    $rcs = mysqli_real_escape_string($connection, $_POST["newrcs"]);
    $ds = mysqli_real_escape_string($connection, $_POST["newds"]);


$query9 ="UPDATE student_grade SET end_date = '$enddate', grade_completion_status = '$gcs', report_card_status = '$rcs', diploma_status = '$ds' WHERE student_id = '$s_id' and grade = '$grade'";
$ret9 = mysqli_query($connection, $query9);
if($ret9){
    header("location:viewstudents.php?id=$s_id");
    echo "<div class='alert alert-success alert-dismissible'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Grade details edited successful.</div>";
}else{
    echo $query9;
    echo "<div class='alert alert-danger alert-dismissible'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Error" . mysqli_error($connection) ."</div>";
}
}elseif($purpose == "addcourseinfo"){    
        $courseid = mysqli_real_escape_string($connection, $_POST["courseid"]);
        $grade = mysqli_real_escape_string($connection, $_POST["grade"]);
        $testsent = mysqli_real_escape_string($connection, $_POST["testsent"]);
        $qss = mysqli_real_escape_string($connection, $_POST["qss"]);

        $query10 ="INSERT INTO student_course VALUES('$s_id', '$courseid', '$grade', '$testsent', '$qss')";
        $ret10 = mysqli_query($connection, $query10);
        if($ret10){
            header("location:viewstudents.php?id=$s_id");
            echo "<div class='alert alert-success alert-dismissible'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Course details added successful.</div>";
        }else{
            echo "<div class='alert alert-danger alert-dismissible'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Error" . mysqli_error($connection) ."</div>";
          
        }
}elseif($purpose == "editcourseinfo"){
    $courseid = mysqli_real_escape_string($connection, $_POST["courseid"]);
    $grade = mysqli_real_escape_string($connection, $_POST["newgrade"]);
    $testsent = mysqli_real_escape_string($connection, $_POST["newtestsent"]);
    $qss = mysqli_real_escape_string($connection, $_POST["newqss"]);


$query9 ="UPDATE student_course SET grade = '$grade', test_sent = '$testsent', quickscore_status = '$qss' WHERE student_id = '$s_id' and course_id = '$courseid'";
$ret9 = mysqli_query($connection, $query9);
if($ret9){
    header("location:viewstudents.php?id=$s_id");
    echo "<div class='alert alert-success alert-dismissible'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Student course details edited successful.</div>";
}else{
    echo "<div class='alert alert-danger alert-dismissible'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Error" . mysqli_error($connection) ."</div>";
}
}elseif($purpose == "edittransaction"){    
    $t_id = mysqli_real_escape_string($connection,$_POST["newtransactionid"]);
    $studentid = mysqli_real_escape_string($connection,$_POST["studentid"]);
    $date = mysqli_real_escape_string($connection,$_POST["newdate"]);
    $description = mysqli_real_escape_string($connection,$_POST["newdescription"]);
    $total = mysqli_real_escape_string($connection,$_POST["newtotal"]);

    if($_POST["file"]){
        $name= $_FILES['file']['name'];

        $tmp_name= $_FILES['file']['tmp_name'];
    
        $file_size = $_FILES['file']['size'];
            
        $file_type = $_FILES['file']['type'];
    
        $position= strpos($name, "."); 
    
        $fileextension= substr($name, $position + 1);
    
        $fileextension= strtolower($fileextension);
    
        $new_size = $file_size/1024;
    
        $name1= strtolower($name);
    
        $final_file=str_replace(' ','-',$name1);
    
            if (isset($final_file)) {
                $query11 = "UPDATE transactions SET transaction_details = '$final_file', total = '$total', trans_description = '$description', trans_date = '$date', student_id = '$studentid' WHERE transaction_id =\"$t_id\"";
                $ret11 = mysqli_query($connection, $query11);
                
                $path = 'uploads/';
    
                if (!empty($final_file)){
                    if (move_uploaded_file($tmp_name, $path.$final_file)) {
                        $query12 = "UPDATE uploads SET transaction_id= '$t_id', file_name= '$final_file' , file_type='$file_type', file_size= '$file_size' WHERE transaction_id= \"$t_id\"";
                        $ret12=  mysqli_query($connection, $query12);
                        if($ret12){
                            header("location:viewstudents.php?id=$studentid");
                            echo "<div class='alert alert-success alert-dismissible'>
                            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Order details edited successful.</div>";
                        }else{
                            echo "<div class='alert alert-danger alert-dismissible'>
                            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Error" . mysqli_error($connection) ."</div>";
                        }
                    }
                }
            }
    }else{
        $query11 = "UPDATE transactions SET total = '$total', trans_description = '$description', trans_date = '$date', student_id = '$studentid' WHERE transaction_id =\"$t_id\"";
        $ret11 = mysqli_query($connection, $query11);
        if($ret11){
            header("location:viewstudents.php?id=$studentid");
            echo "<div class='alert alert-success alert-dismissible'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Order details edited successful.</div>";
        }else{
            echo "<div class='alert alert-danger alert-dismissible'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Error" . mysqli_error($connection) ."</div>";
        }

    }
   
    }else{
        echo "nothing";
    }


?>