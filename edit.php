<?php
include ('includes/header.php'); 
require_once ('includes/dbconnect.php');
$connection = db_connect();
session_start();
$userid = $_SESSION["user"];

if($_POST["editstudent"]){
    $s_id = $_GET["id"];
    $query= "SELECT * FROM students WHERE student_id = $s_id";
    $ret = mysqli_query($connection, $query);
    if(!$ret){
        echo "Error" . mysqli_error($connection);
    }else{
        $row = mysqli_fetch_array($ret);
    ?>
    <div class="row">
    <div class="col-sm-12">
    <h2 class="text-center">Edit Student Details</h2>
        <form class="form-horizontal" action="modal-processing.php" method="post" >
  <div class="form-group">
    <label class="control-label col-sm-2" for="newstudentid">Student ID:</label>
    <div class="col-sm-4">
      <input type="number" class="form-control" id="newstudentid" name="newstudentid" value="<?php echo $row["student_id"];?>" readonly>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="newfname">First Name:</label>
    <div class="col-sm-4"> 
      <input type="text" class="form-control" id="newfname" name="newfname" required value="<?php echo $row["first_name"];?>">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="newmidname">Middle Name:</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="newmidname" name="newmidname" value="<?php echo $row["middle_name"];?>">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="newlname">Last Name:</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="newlname" name="newlname" required value="<?php echo $row["last_name"];?>">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="newdob">Date of Birth:</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="newdob" name="newdob" required value="<?php echo $row["date_of_birth"];?>">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="newgender">Gender:</label>
    <div class="col-sm-4">
        <select class="form-control" id="newgender" name="newgender" required>
        <?php 
            if($row["gender"] == "Male"){
                echo "<option name='gender' value='Male' selected>Male</option> <option name='gender' value='Female'>Female</option>";
            }else{
                echo "<option name='gender' value='Female' selected>Female</option> <option name='gender' value='Male'>Male</option>";
            }
        ?>
        </select>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="newenrollmentstat">Enrollment Status:</label>
    <div class="col-sm-4">
      <select class="form-control" id="newenrollmentstat" name="newenrollmentstat" required> 
        <?php 
            if($row["enrollment_status"] == "Enrolled"){
                echo "<option name='enrollmentstat' value='Enrolled' selected>Enrolled</option>  <option name='enrollmentstat' value='Not enrolled'>Not enrolled</option>  <option name='enrollmentstat' value='Enrollment Pending'>Enrollment Pending</option>";
            }elseif($row["enrollment_status"] == "Not enrolled"){
                echo "<option name='enrollmentstat' value='Not enrolled' selected>Not enrolled</option>  <option name='enrollmentstat' value='Enrolled'>Enrolled</option>  <option name='enrollmentstat' value='Enrollment Pending'>Enrollment Pending</option>";
            }else{
                echo "<option name='enrollmentstat' value='Enrollment Pending' selected>Enrollment Pending</option>  <option name='enrollmentstat' value='Enrolled'>Enrolled</option>  <option name='enrollmentstat' value='Not enrolled'>Not enrolled</option>";
            }
        ?>       
      </select>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="newstudenttype">Student Type:</label>
    <div class="col-sm-4">
      <select class="form-control" id="newstudenttype" name="newstudenttype" required>
        <?php 
            if($row["student_type"] == "Current"){
                echo "<option name='studenttype' value='Current' selected>Current</option>  <option name='studenttype' value='Past'>Past</option>";
            }else{
                echo "<option name='studenttype' value='Past' selected>Past</option> <option name='studenttype' value='Current'>Current</option>";
            }
        ?>   
        </select>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="newdod">Date of departure:</label>
    <div class="col-sm-4">
      <input type="text" id="newdod" name="newdod" class="form-control" value="<?php echo $row["date_of_departure"];?>"/>
    </div>
  </div>
  <div class="modal-footer">
    <input type="hidden" name="purpose" value="editstudent">
    <input type="submit" name="edit" id="Edit" value="Edit" class="btn btn-primary">
  </div>
</form>
    </div>
    </div>
<?php
    }
}else if($_POST["editenrollment"]){
    $e_id = $_GET["id"];
    $query= "SELECT * FROM enrollments WHERE enrollment_id = '$e_id'";
    $ret = mysqli_query($connection, $query);
    if(!$ret){
        echo "Error" . mysqli_error($connection);
    }else{
        $row = mysqli_fetch_array($ret);
        ?>
        <div class="row">
        <div class="col-sm-12">
        <h2 class="text-center">Edit Enrollment Details</h2>
            <form class="form-horizontal" action="modal-processing.php" method="post" >
      <div class="form-group">
        <label class="control-label col-sm-2" for="newenrollmentid">Enrollement ID:</label>
        <div class="col-sm-4">
          <input type="number" class="form-control" id="newenrollmentid" name="newenrollmentid" value="<?php echo $row["enrollment_id"];?>" readonly>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="newstudentid">Student ID:</label>
        <div class="col-sm-4"> 
          <input type="text" class="form-control" id="newstudentid" name="newstudentid" required value="<?php echo $row["student_id"];?>">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="newenrollemnttype">Enrollment Type:</label>
        <div class="col-sm-4">
        <select class="form-control" required name="newenrollmenttype">
            <?php 
                if($row["enrollment_type"] == "First Time"){
                    echo "<option name='newenrollmenttype' value='First Time' selected>First Time</option>  <option name='newenrollmenttype' value='Re-enrollment'>Re-enrollment</option>";
                }else{
                    echo "<option name='newenrollmenttype' value='First Time'>First Time</option>  <option name='newenrollmenttype' value='Re-enrollment' selected>Re-enrollment</option>";
                }
            ?>   
        </select>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="newenrollmentdate">Enrollment Date:</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" id="newenrollemntdate" name="newenrollmentdate" required value="<?php echo $row["enrollment_date"];?>">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="newgrade">Grade:</label>
        <div class="col-sm-4">
        <select class="form-control" id="newgrade" name="newgrade" required>
            <?php 
                if($row["grade_of_enrollment"] == "8"){
                    echo "<option name='newgrade' value='8' selected>8</option>
                            <option name='newgrade' value='9'>9</option>
                            <option name='newgrade' value='10'>10</option>
                            <option name='newgrade' value='11'>11</option>
                            <option name='newgrade' value='12'>12</option>";
                }elseif($row["grade_of_enrollment"] == "9"){
                    echo "<option name='newgrade' value='8'>8</option>
                    <option name='newgrade' value='9' selected>9</option>
                    <option name='newgrade' value='10'>10</option>
                    <option name='newgrade' value='11'>11</option>
                    <option name='newgrade' value='12'>12</option>";
                }elseif($row["grade_of_enrollment"] == "10"){
                    echo "<option name='newgrade' value='8'>8</option>
                    <option name='newgrade' value='9' selected>9</option>
                    <option name='newgrade' value='10' selected>10</option>
                    <option name='newgrade' value='11'>11</option>
                    <option name='newgrade' value='12'>12</option>";
                }elseif($row["grade_of_enrollment"] == "11"){
                    echo "<option name='newgrade' value='8'>8</option>
                    <option name='newgrade' value='9' selected>9</option>
                    <option name='newgrade' value='10'>10</option>
                    <option name='newgrade' value='11' selected>11</option>
                    <option name='newgrade' value='12'>12</option>";
                }else{
                    echo "<option name='newgrade' value='8'>8</option>
                    <option name='newgrade' value='9' selected>9</option>
                    <option name='newgrade' value='10'>10</option>
                    <option name='newgrade' value='11'>11</option>
                    <option name='newgrade' value='12' selected>12</option>";
                }
            ?>       
        </select>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="newcatstatus">CAT Status:</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" name="newcatstatus" value="<?php echo $row["cat_status"];?>">  
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="newdocsent">Documentation Sent:</label>
        <div class="col-sm-4">
            <textarea rows="4" cols="50" class="form-control" name="newdocsent"><?php echo $row["documentation_sent"];?></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="purpose" value="editenrollment">
        <input type="submit" name="edit" id="Edit" value="Edit" class="btn btn-primary">
      </div>
    </form>
        </div>
        </div>
    <?php
        }
}else if($_POST["editorder"]){
    $o_id = $_GET["id"];
    $query= "SELECT * FROM orders WHERE order_number = '$o_id'";
    $ret = mysqli_query($connection, $query);
    if(!$ret){
        echo "Error" . mysqli_error($connection);
    }else{
        $row = mysqli_fetch_array($ret);
        ?>
        <div class="row">
        <div class="col-sm-12">
        <h2 class="text-center">Edit Order Details</h2>
        <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="modal-processing.php">
  <div class="form-group">
    <label class="control-label col-sm-2" for="newordernum">Order Number:</label>
    <div class="col-sm-4">
      <input type="text" readonly class="form-control" name="newordernum" value="<?php echo $row["order_number"];?>">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="newenrollmentid">Enrollment ID:</label>
    <div class="col-sm-4"> 
      <input readonly type="text" class="form-control" name="newenrollmentid" required value="<?php echo $row["enrollment_id"];?>">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="file">Order Details:</label>
    <div class="col-sm-4">
      <input type="file" class="form-control" name="file" id="file" value="<?php echo $row["order_details"];?>">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="newamountpaid">Amount Paid:</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="newamountpaid" required value="<?php echo $row["amount_paid"];?>">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="newshipdetails">Shipping Details:</label>
    <div class="col-sm-4">
        <input type="text" class="form-control" name="newshipdetails" value="<?php echo $row["shipping_details"];?>">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="newdeliverystat">Delivery Status:</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="newdeliverystat" value="<?php echo $row["delivery_status"];?>">
    </div>
  </div>
  <div class="modal-footer"> 
    <input type="hidden" name="purpose" value="editorder">
    <button type="submit" name="editorder" class="btn btn-primary">Edit</button>
  </div>
</form>
        </div>
        </div>
    <?php
        }
}else if($_POST["editcourse"]){
        $c_id = $_GET["id"];
        $query= "SELECT * FROM courses WHERE course_id = '$c_id'";
        $ret = mysqli_query($connection, $query);
        if(!$ret){
            echo "Error" . mysqli_error($connection);
        }else{
            $row = mysqli_fetch_array($ret);
        ?>
        <div class="row">
        <div class="col-sm-12">
        <h2 class="text-center">Edit Course Details</h2>
        <form class="form-horizontal" method="post" action="modal-processing.php">
          <div class="form-group">
            <label class="control-label col-sm-4" for="newcourseid">Course ID:</label>
            <div class="col-sm-6">
              <input type="number" readonly name="newcourseid" id="newcourseid" class="form-control" value="<?php echo $row["course_id"];?>">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-4" for="newcoursename">Course Name:</label>
            <div class="col-sm-6"> 
              <input type="text" name="newcoursename" id="newcoursename"  class="form-control" required value="<?php echo $row["course_name"];?>">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-4" for="newgrade">Grade:</label>
            <div class="col-sm-6">
              <select class="form-control" name="newgrade" required>
              <?php 
                if($row["grade"] == "8"){
                    echo "<option name='newgrade' value='8' selected>8</option>
                            <option name='newgrade' value='9'>9</option>
                            <option name='newgrade' value='10'>10</option>
                            <option name='newgrade' value='11'>11</option>
                            <option name='newgrade' value='12'>12</option>";
                }elseif($row["grade"] == "9"){
                    echo "<option name='newgrade' value='8'>8</option>
                    <option name='newgrade' value='9' selected>9</option>
                    <option name='newgrade' value='10'>10</option>
                    <option name='newgrade' value='11'>11</option>
                    <option name='newgrade' value='12'>12</option>";
                }elseif($row["grade"] == "10"){
                    echo "<option name='newgrade' value='8'>8</option>
                    <option name='newgrade' value='9' selected>9</option>
                    <option name='newgrade' value='10' selected>10</option>
                    <option name='newgrade' value='11'>11</option>
                    <option name='newgrade' value='12'>12</option>";
                }elseif($row["grade"] == "11"){
                    echo "<option name='newgrade' value='8'>8</option>
                    <option name='newgrade' value='9' selected>9</option>
                    <option name='newgrade' value='10'>10</option>
                    <option name='newgrade' value='11' selected>11</option>
                    <option name='newgrade' value='12'>12</option>";
                }else{
                    echo "<option name='newgrade' value='8'>8</option>
                    <option name='newgrade' value='9' selected>9</option>
                    <option name='newgrade' value='10'>10</option>
                    <option name='newgrade' value='11'>11</option>
                    <option name='newgrade' value='12' selected>12</option>";
                }
            ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-4" for="newsubject">Subject:</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="newsubject" id="newsubject" required value="<?php echo $row["subjects"];?>">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-4" for="newcomp">Components:</label>
            <div class="col-sm-6">
              <textarea rows="4" cols="50" class="form-control" name="newcomp" id="newcomp"><?php echo $row["components"];?></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-4" for="newnumtests">Number of Tests:</label>
            <div class="col-sm-6">
              <input type="number" class="form-control" name="newnumtests" id="newnumtests" value="<?php echo $row["number_of_tests"];?>">
            </div>
          </div>
          <div class="modal-footer"> 
            <input type="hidden" name="purpose" value="editcourse">
            <input type="submit" name="editcourse" id="edit" value="Edit" class="btn btn-primary"/>
          </div>  
        </form>     
        </div>
        </div>
        <?php
        }
    }else if($_POST["editgradeinfo"]){
        $studentid = $_GET["sid"];
        $grade = $_GET["grade"];
        $query= "SELECT * FROM student_grade WHERE student_id = '$studentid' and grade = '$grade' ";
        $ret = mysqli_query($connection, $query);
        if(!$ret){
            echo "Error" . mysqli_error($connection);
        }else{
            $row = mysqli_fetch_array($ret);
        ?>
        <div class="row">
        <div class="col-sm-12">
        <h2 class="text-center">Edit Grade Details</h2>
        <form class="form-horizontal" method="post" action="modal-processing.php">
          <div class="form-group">
            <label class="control-label col-sm-4" for="studentid">Student ID:</label>
            <div class="col-sm-6">
              <input type="number" readonly name="studentid" id="studentid" class="form-control" value="<?php echo $row["student_id"];?>">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-4" for="grade">Grade:</label>
            <div class="col-sm-6"> 
              <input type="number" readonly name="grade" id="grade" class="form-control" required value="<?php echo $row["grade"];?>">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-4" for="newendate">End Date:</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="newendate" id="newendate" required value="<?php echo $row["end_date"];?>">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-4" for="newgcs">Grade Completion Status:</label>
            <div class="col-sm-6">
            <textarea rows="4" cols="50" class="form-control" name="newgcs" id="newgcs"> <?php echo $row["grade_completion_status"];?></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-4" for="newrcs">Report Card Status:</label>
            <div class="col-sm-6">
              <textarea rows="4" cols="50" class="form-control" name="newrcs" id="newrcs"><?php echo $row["report_card_status"];?></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-4" for="newds">Diploma Status:</label>
            <div class="col-sm-6">
            <textarea rows="4" cols="50" class="form-control" name="newds" id="newds"><?php echo $row["diploma_status"];?></textarea>
            </div>
          </div>
          <div class="modal-footer"> 
            <input type="hidden" name="purpose" value="editgradeinfo">
            <input type="submit" name="editcourse" id="edit" value="Edit" class="btn btn-primary"/>
          </div>  
        </form>     
        </div>
        </div>
        <?php
        }
    }else if($_POST["editcourseinfo"]){
        $cid = $_GET["cid"];
        $sid = $_GET["sid"];
        $query= "SELECT student_course.grade, student_course.student_id, student_course.test_sent, student_course.quickscore_status, courses.course_id, courses.course_name, courses.subjects, courses.number_of_tests, courses.components FROM student_course, courses WHERE student_course.student_id = '$sid' and student_course.course_id = '$cid' and courses.course_id=student_course.course_id ";
        $ret = mysqli_query($connection, $query);
        if(!$ret){
            echo "Error" . mysqli_error($connection);
        }else{
            $row = mysqli_fetch_array($ret);
        ?>
        <div class="row">
        <div class="col-sm-12">
        <h2 class="text-center">Edit Course Details</h2>
        <form class="form-horizontal" method="post" action="modal-processing.php">
        <div class="form-group">
            <label class="control-label col-sm-4" for="newcourseid">Student ID:</label>
            <div class="col-sm-6">
              <input type="number" readonly name="newcourseid" id="newcourseid" class="form-control" value="<?php echo $row["student_id"];?>">
            </div>
          </div>  
        <div class="form-group">
            <label class="control-label col-sm-4" for="courseid">Course ID:</label>
            <div class="col-sm-6">
              <input type="number" readonly name="courseid" id="courseid" class="form-control" value="<?php echo $row["course_id"];?>">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-4" for="coursename">Course Name:</label>
            <div class="col-sm-6">
              <input type="text" readonly name="coursename" id="coursenmae" class="form-control" value="<?php echo $row["course_name"];?>">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-4" for="subject">Subject:</label>
            <div class="col-sm-6">
              <input type="text" readonly name="subject" id="subject" class="form-control" value="<?php echo $row["subjects"];?>">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-4" for="numtests">Number of Tests:</label>
            <div class="col-sm-6">
              <input type="number" readonly name="numtests" id="numtests" class="form-control" value="<?php echo $row["number_of_tests"];?>">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-4" for="newgrade">Grade:</label>
            <div class="col-sm-6"> 
              <select name="newgrade" id="newgrade" class="form-control" required> 
              <?php 
                if($row["grade"] == "8"){
                    echo "<option name='newgrade' value='8' selected>8</option>
                            <option name='newgrade' value='9'>9</option>
                            <option name='newgrade' value='10'>10</option>
                            <option name='newgrade' value='11'>11</option>
                            <option name='newgrade' value='12'>12</option>";
                }elseif($row["grade"] == "9"){
                    echo "<option name='newgrade' value='8'>8</option>
                    <option name='newgrade' value='9' selected>9</option>
                    <option name='newgrade' value='10'>10</option>
                    <option name='newgrade' value='11'>11</option>
                    <option name='newgrade' value='12'>12</option>";
                }elseif($row["grade"] == "10"){
                    echo "<option name='newgrade' value='8'>8</option>
                    <option name='newgrade' value='9' selected>9</option>
                    <option name='newgrade' value='10' selected>10</option>
                    <option name='newgrade' value='11'>11</option>
                    <option name='newgrade' value='12'>12</option>";
                }elseif($row["grade"] == "11"){
                    echo "<option name='newgrade' value='8'>8</option>
                    <option name='newgrade' value='9' selected>9</option>
                    <option name='newgrade' value='10'>10</option>
                    <option name='newgrade' value='11' selected>11</option>
                    <option name='newgrade' value='12'>12</option>";
                }else{
                    echo "<option name='newgrade' value='8'>8</option>
                    <option name='newgrade' value='9' selected>9</option>
                    <option name='newgrade' value='10'>10</option>
                    <option name='newgrade' value='11'>11</option>
                    <option name='newgrade' value='12' selected>12</option>";
                }
            ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-4" for="newtestsent">Tests Sent:</label>
            <div class="col-sm-6">
                <textarea rows="4" cols="50" class="form-control" name="newtestsent" id="newtestsent" ><?php echo $row["test_sent"];?></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-4" for="newqss">Quickscore Status:</label>
            <div class="col-sm-6">
              <textarea rows="4" cols="50" class="form-control" name="newqss" id="newqss"><?php echo $row["quickscore_status"];?></textarea>
            </div>
          </div>
          <div class="modal-footer"> 
            <input type="hidden" name="purpose" value="editcourseinfo">
            <input type="submit" name="editcourse" id="edit" value="Edit" class="btn btn-primary"/>
          </div>  
        </form>     
        </div>
        </div>
        <?php
        }
    }else if($_POST["edittransaction"]){
        $t_id = $_GET["id"];
        $query= "SELECT * FROM transactions WHERE transaction_id = '$t_id'";
        $ret = mysqli_query($connection, $query);
        if(!$ret){
            echo "Error" . mysqli_error($connection);
        }else{
            $row = mysqli_fetch_array($ret);
        ?>
        <div class="row">
        <div class="col-sm-12">
        <h2 class="text-center">Edit Transaction Details</h2>
        <form class="form-horizontal" method="post" enctype="multipart/form-data" action="modal-processing.php" >
          <div class="form-group">
            <label class="control-label col-sm-4" for="newtransactionid">Transaction ID:</label>
            <div class="col-sm-6">
              <input type="number" readonly name="newtransactionid" id="newtransactionid" class="form-control" value="<?php echo $row["transaction_id"];?>">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-4" for="studentid">Student ID:</label>
            <div class="col-sm-6"> 
              <input type="number" name="studentid" id="studentid" class="form-control" required value="<?php echo $row["student_id"];?>">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-4" for="newdate">Date:</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="newdate" id="newdate" required value="<?php echo $row["trans_date"];?>">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-4" for="newdescription">Description:</label>
            <div class="col-sm-6">
              <textarea rows="4" cols="50" class="form-control" name="newdescription" id="newdescription" required><?php echo $row["trans_description"];?></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-4" for="newtotal">Total:</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="newtotal" id="newtotal" value="<?php echo $row["total"];?>">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-4" for="file">Transaction Details:</label>
            <div class="col-sm-6">
              <input type="file" class="form-control" name="file" id="file" value="<?php echo $row["transaction_details"];?>">
            </div>
          </div>
          <div class="modal-footer"> 
            <input type="hidden" name="purpose" value="edittransaction">
            <input type="submit" name="editcourse" id="edit" value="Edit" class="btn btn-primary"/>
          </div>  
        </form>     
        </div>
        </div>
        <?php
        }
    }
    
        
    
?>
<?php include ('includes/footer.php'); ?>
