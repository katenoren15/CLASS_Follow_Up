<?php
    include ('includes/header.php'); 
    require_once ('includes/dbconnect.php');
    $connection = db_connect();
    session_start();
    $s_id = $_GET["id"];
    $_SESSION["studentid"] = $s_id;
    $userid = $_SESSION["user"];
    $query= "SELECT * FROM students WHERE student_id = '$s_id'";
    $ret = mysqli_query($connection, $query);
    if(!$ret){
        echo "Error" . mysqli_error($connection);
        
    }
    $query2= "SELECT * FROM enrollments WHERE student_id = '$s_id' ";
    $ret2 = mysqli_query($connection, $query2);
    if(!$ret2){
        echo "Error" . mysqli_error($connection);
    }
    $query3= "SELECT * FROM student_grade WHERE student_id = '$s_id'";
    $ret3 = mysqli_query($connection, $query3);
    if(!$ret3){
        echo "Error" . mysqli_error($connection);
    }
    $row = mysqli_fetch_array($ret);
    $query4= "SELECT student_course.grade, student_course.test_sent, student_course.quickscore_status, courses.course_name, courses.subjects, courses.number_of_tests, courses.components FROM student_course, courses WHERE student_course.student_id = '$s_id' and courses.course_id=student_course.course_id";
    $ret4 = mysqli_query($connection, $query4);
    if(!$ret4){
        echo "Error" . mysqli_error($connection);
    }
    $query5= "SELECT * FROM transactions WHERE student_id = '$s_id'";
    $ret5 = mysqli_query($connection, $query5);
    if(!$ret5){
        echo "Error" . mysqli_error($connection);
    }
?>  
<div class="row">
<div class="col-sm-11" id="source-html">
    <br>
    <div class="well well-lg"> 
        <h1><?php echo $row["first_name"] . " " . $row["middle_name"] . " " . $row["last_name"]; ?></h1> 
        <p>Student ID: <?php echo $row["student_id"];?></p>
        <p>Date of Birth: <?php echo $row["date_of_birth"];?></p>
        <p>Gender: <?php echo $row["gender"];?></p>
        <p>Enrollment Status: <?php echo $row["enrollment_status"];?></p>
        <p>Student Type: <?php echo $row["student_type"];?></p>
        <p>Date of Departure: <?php echo $row["date_of_departure"];?></p>
    </div>
    <button type="button" onclick="exportHTML();" class="btn btn-primary">Export to Microsoft Word</button>
</div>
</div>
    <div class="row">
        <div class="col-sm-12">

            <br>
            <h3><u>Enrollment History</u></h3>
            <table border="1" class="table table-bordered">
                <tr>
                  <th>Enrollment ID</th>
                  <th>Enrollment Type</th>
                  <th>Enrollment Date</th>
                  <th>Grade</th>
                  <th>CAT Status</th>
                  <th>Documentation Sent</th>
                  <th colspan="2">Commands</th>
                </tr>
                    <?php
                        while($row2 = mysqli_fetch_array($ret2)){
                    ?>
                <tr>
                  <td> <?php echo $row2["enrollment_id"]; ?></td>
                  <td> <?php echo $row2["enrollment_type"];?> </td>
                  <td> <?php echo $row2["enrollment_date"];?> </td>
                  <td> <?php echo $row2["grade_of_enrollment"];?> </td>
                  <td> <?php echo $row2["cat_status"];?> </td>
                  <td> <?php echo $row2["documentation_sent"];?> </td>
                  <td> <button type="button" class="button btn btn-primary">View</button></td>
                  <td> <button type="button" class="button btn btn-default">Edit</button> </td>
                </tr>
                    <?php } ?>
            </table>
            <br>
            <h3><u>Grade Information</u></h3>
            <div class="text-right"><button type="button" class="button btn btn-primary" data-modal="maddc">Add Grade Information</button></div>
            <br>
            <table border="1" class="table table-bordered">
                <tr>
                    <th>Grade</th>
                    <th>End Date</th>
                    <th>Grade Completion Status</th>
                    <th>Report Card Status</th>
                    <th>Diploma Status</th>
                    <th colspan="2">Commands</th>
                </tr>
                <?php
                    while($row3 = mysqli_fetch_array($ret3)){
                ?>
                <tr>
                    <td> <?php echo $row3["grade"]; ?></td>
                    <td> <?php echo $row3["end_date"]; ?> </td>
                    <td> <?php echo $row3["grade"];?> </td>
                    <td> <?php echo $row3["grade_completion_status"];?> </td>
                    <td> <?php echo $row3["report_card_status"];?> </td>
                    <td> <?php echo $row3["test_sent"];?> </td>
                    <td> <?php echo $row3["diploma_status"];?> </td>
                    <td> <button type="button" class="btn btn-primary">View</button></td>
                    <td> <button type="button" class="button btn btn-default" data-modal="medit">Edit</button> </td>
                </tr>
                <?php } ?>
            </table>
            <br>
            <h3><u>Course Information</u></h3>
            <div class="text-right"><button type="button" class="button btn btn-primary" data-modal="maddc">Add Course Information</button></div>
            <br>
            <table border="1" class="table table-bordered">
                <tr>
                    <th>Course Name</th>
                    <th>Subject</th>
                    <th>Grade For</th>
                    <th>Number of Tests</th>
                    <th>Components</th>
                    <th>Tests Sent</th>
                    <th>QuickScore Status</th>
                    <th colspan="2">Commands</th>
                </tr>
                <?php
                    while($row4 = mysqli_fetch_array($ret4)){
                ?>
                <tr>
                    <td><?php echo $row4["course_name"]; ?></td>
                    <td> <?php echo $row4["subject"]; ?> </td>
                    <td> <?php echo $row4["grade"];?> </td>
                    <td> <?php echo $row4["number_of_tests"];?> </td>
                    <td> <?php echo $row4["components"];?> </td>
                    <td> <?php echo $row4["test_sent"];?> </td>
                    <td> <?php echo $row4["quickscore_status"];?> </td>
                    <td> <button type="button" class="btn btn-primary">View</button></td>
                    <td> <button type="button" class="button btn btn-default" data-modal="medit">Edit</button> </td>
                </tr>
                <?php } ?>
            </table>
            <br>
            <h3><u>Account</u></h3>
            <div class="text-right"><button type="button" class="button btn btn-primary" data-modal="maddc">Add Transaction</button></div>
            <br>
            <table border="1" class="table table-bordered">
                <tr>
                    <th>Transaction ID</th>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Total</th>
                    <th>Transaction Details</th>
                    <th colspan="2">Commands</th>
                </tr>
                <?php
                    while($row5 = mysqli_fetch_array($ret5)){
                ?>
                <tr>
                    <td><?php echo $row5["transaction_id"]; ?></td>
                    <td> <?php echo $row5["date"];?> </td>
                    <td> <?php echo $row5["description"];?> </td>
                    <td> <?php echo $row5["total"];?> </td>
                    <td> <a href="uploads/<?php echo $row5['transaction_details'];?>" target="_blank"><?php echo $row5["transaction_details"];?> </a></td>
                    <td><button type="button" class="btn btn-primary">View</button></td>
                    <td> <button type="button" class="button btn btn-default" data-modal="medit">Edit</button> </td>
                </tr>
                <?php } ?>
            </table>
            
        </div>
    </div>
    <?php include ('includes/footer.php'); ?>

    <div class="modal" id="maddg">
    <div class="modal-content">
      <div class="modal-header">
        <span class="close">&times;</span>
        <h2 class="text-center">Add Grade Information</h2>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="POST" action="modal-processing.php">
  <div class="form-group">
    <label class="control-label col-sm-2" for="grade">Grade:</label>
    <div class="col-sm-4">
        <select class="form-control" name="grade">
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="enddate">End Date:</label>
    <div class="col-sm-4"> 
      <input type="text" class="form-control" name="enddate" placeholder="use jquery datepicker YYYY-MM-DD">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="gcs">Grade Completion Status:</label>
    <div class="col-sm-4">
        <textarea rows="4" cols="50" class="form-control" name="gcs"></textarea>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="rcs">Report Card Status:</label>
    <div class="col-sm-4">
        <textarea rows="4" cols="50" class="form-control" name="rcs"></textarea>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="ds">Diploma Status:</label>
    <div class="col-sm-4">
        <textarea rows="4" cols="50" class="form-control" name="ds"></textarea>
    </div>
  </div>
  <div class="modal-footer"> 
    <input type="hidden" name="purpose" value="addgradeinfo">
    <button type="submit" name="addgradeinfo" class="btn btn-primary">Add</button>
  </div>
</form>
                    </div>
    </div>
</div> 

<div class="modal" id="maddc">
    <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h2 class="text-center">Add Course Information</h2>
    </div>
    <div class="modal-body">
        <form class="form-horizontal" method="POST" action="modal-processing.php">
  <div class="form-group">
    <label class="control-label col-sm-2" for="courseid">Course ID:</label>
    <div class="col-sm-4">
      <input type="number" class="form-control" id="courseid">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="grade">Grade:</label>
    <div class="col-sm-4">
        <select class="form-control" name="grade">
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="testsent">Tests Sent:</label>
    <div class="col-sm-4">
        <textarea rows="4" cols="50" class="form-control" name="testsent"></textarea>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="qss">QuickScore Status:</label>
    <div class="col-sm-4">
        <textarea rows="4" cols="50" class="form-control" name="qss"></textarea>
    </div>
  </div>
  <div class="modal-footer"> 
    <input type="hidden" name="purpose" value="addcourseinfo">
    <button type="submit" name="addcourseinfo" class="btn btn-primary">Add </button>
  </div>
</form>
                    </div>
    </div>
</div>

<div class="modal" id="maddt">
    <div class="modal-content">
      <div class="modal-header">
        <span class="close">&times;</span>
        <h2 class="text-center">Add a Transaction</h2>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="POST" action="upload.php" enctype="multipart/form-data">
  <div class="form-group">
    <label class="control-label col-sm-2" for="transacid">Transaction ID:</label>
    <div class="col-sm-4">
      <input type="number" class="form-control" name="transacid">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="date">Date:</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="date" placeholder="use datapicker jquery YYYY-MM-DD">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="description">Description:</label>
    <div class="col-sm-4">
        <textarea rows="4" cols="50" class="form-control" name="description"></textarea>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="total">Total:</label>
    <div class="col-sm-4">
        <input type="text" class="form-control" name="total">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="file">Transaction Details:</label>
    <div class="col-sm-4">
        <input type="file" class="form-control" name="file">
    </div>
  </div>
  <div class="modal-footer"> 
      <input type="hidden" name="purpose" value="addtransinfo">
      <button type="submit" name="btn-add-trans" class="btn btn-primary">Add </button>
  </div>
</form>
  </div>
    </div>
</div>

<script>
    function exportHTML(){
       var header = "<html xmlns:o='urn:schemas-microsoft-com:office:office' "+
            "xmlns:w='urn:schemas-microsoft-com:office:word' "+
            "xmlns='http://www.w3.org/TR/REC-html40'>"+
            "<head><meta charset='utf-8'><title>Export HTML to Word Document with JavaScript</title></head><body>";
       var footer = "</body></html>";
       var sourceHTML = header+document.getElementById("source-html").innerHTML;
       
       var source = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(sourceHTML);
       var fileDownload = document.createElement("a");
       document.body.appendChild(fileDownload);
       fileDownload.href = source;
       fileDownload.download = 'document.doc';
       fileDownload.click();
       document.body.removeChild(fileDownload);
    }
</script>

<script>
    var modal = document.getElementsByClassName("modal");
    var button = document.getElementsByClassName("button");
    var span = document.getElementsByClassName("close");

    button[0].onclick = function() {
        modal[0].style.display = "block";
    }
    span[0].onclick = function() {
        modal[0].style.display = "none";
    }

    button[1].onclick = function() {
        modal[1].style.display = "block";
    }
    span[1].onclick = function() {
        modal[1].style.display = "none";
    }

    button[2].onclick = function() {
        modal[2].style.display = "block";
    }
    span[2].onclick = function() {
        modal[2].style.display = "none";
    }

    window.onclick = function(event) {
        if(event.target == modal[0]) {
            modal[0].style.display = "none";
        }
        if(event.target == modal[1]) {
            modal[1].style.display = "none";
        }
        if(event.target == modal[2]) {
            modal[2].style.display = "none";
        }
    }

</script>