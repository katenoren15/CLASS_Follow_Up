<?php 
    $s_id = $_COOKIE["student_id"];
    require_once ('includes/dbconnect.php');
    $connection = db_connect();
    session_start();
    $userid = $_SESSION["user"];
    $query= "SELECT * FROM students WHERE student_id = '$s_id' ";
    $ret = mysqli_query($connection, $query);
    if(!$ret){
        echo "Error" . mysqli_error($connection);
        $row = mysqli_fetch_array($ret);
    }
    $query2= "SELECT * FROM enrollments WHERE student_id = '$s_id' ";
    $ret2 = mysqli_query($connection, $query);
    if(!$ret2){
        echo "Error" . mysqli_error($connection);
    }
    $query3= "SELECT * FROM student_grade WHERE student_id = '$s_id'";
    $ret3 = mysqli_query($connection, $query);
    if(!$ret3){
        echo "Error" . mysqli_error($connection);
    }
    $query4= "SELECT * FROM student_course WHERE student_id = '$s_id'";
    $ret4 = mysqli_query($connection, $query);
    if(!$ret4){
        echo "Error" . mysqli_error($connection);
    }
    $query5= "SELECT * FROM transactions WHERE student_id = '$s_id'";
    $ret5 = mysqli_query($connection, $query);
    if(!$ret5){
        echo "Error" . mysqli_error($connection);
    }
?>  
<div class="col-sm-10" id="source-html">
    <br>
    <div class="well well-lg"> 
        <h1><?php echo $row["first_name"] . $row["middle_name"] . $row["last_name"]; ?></h1> 
        <p>Student ID: <?php echo $row["student_id"];?></p>
        <p>Date of Birth: <?php echo $row["date_of_birth"];?></p>
        <p>Gender: <?php echo $rows["gender"];?></p>
        <p>Enrollment Status: <?php echo $rows["enrollment_status"];?></p>
    </div>
    <button type="button"  onclick="exportHTML();" class="btn btn-primary">Export to Microsoft Word</button>
    
    <div class="row">
        <div class="col-sm-10">
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
                        <td><?php echo $row2["enrollment_id"]; ?></td>
                        <td> <?php echo $row2["enrollment_type"];?> </td>
                        <td> <?php echo $row2["enrollment_date"];?> </td>
                        <td> <?php echo $row2["grade"];?> </td>
                        <td> <?php echo $row2["cat_status"];?> </td>
                        <td> <?php echo $row2["documentation_sent"];?> </td>
                        <td> <button type="button" class="button btn btn-primary">View</button></td>
                        <td> <button type="button" class="button btn btn-default">Edit</button> </td>
                    </tr>
                    <?php } ?>
            </table>
            <br>
            <h3><u>Grade Information</u></h3>
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
                    <td><?php echo $row3["grade"]; ?></a></td>
                    <td> <?php echo $row3["end_date"]; ?> </td>
                    <td> <?php echo $row3["grade_completion_status"];?> </td>
                    <td> <?php echo $row3["report_card_status"];?> </td>
                    <td> <?php echo $row3["diploma_status"];?> </td>
                    <td> <button type="button" class="btn btn-primary">View</button></td>
                    <td> <button type="button" class="button btn btn-default" data-modal="medit">Edit</button> </td>
                </tr>
                <?php } ?>
            </table>
            <br>
            <h3><u>Course Information</u></h3>
            <table border="1" class="table table-bordered">
                <tr>
                    <th>Course Name</th>
                    <th>Subject</th>
                    <th>Grade For</th>
                    <th>Number of Tests</th>
                    <th>Components</th>
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
                    <td> <?php echo $row4["quickscore_status"];?> </td>
                    <td> <button type="button" class="btn btn-primary">View</button></td>
                    <td> <button type="button" class="button btn btn-default" data-modal="medit">Edit</button> </td>
                </tr>
                <?php } ?>
            </table>
            <br>
            <h3><u>Account</u></h3>
            <div class= "navbar-right"><button type="button" class="button btn btn-primary" data-modal="madd">Add Transaction</button></div>
            <table border="1" class="table table-bordered">
                <tr>
                    <th>Transaction ID</th>
                    <th>Student ID</th>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Total</th>
                    <th>Notes</th>
                    <th colspan="2">Commands</th>
                </tr>
                <?php
                    while($row5 = mysqli_fetch_array($ret5)){
                ?>
                <tr>
                    <td><?php echo $row5["transaction_id"]; ?></td>
                    <td> <?php echo $row5["student_id"]; ?> </td>
                    <td> <?php echo $row5["date"];?> </td>
                    <td> <?php echo $row5["description"];?> </td>
                    <td> <?php echo $row5["total"];?> </td>
                    <td> <?php echo $row5["notes"];?> </td>
                    <td><button type="button" class="btn btn-primary">View</button></td>
                    <td> <button type="button" class="button btn btn-default" data-modal="medit">Edit</button> </td>
                </tr>
                <?php } ?>
            </table>
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
</script>

<div class="modal" id="madd">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2 class="text-center">Add a Transaction</h2>
        <form class="form-horizontal" action="#">
  <div class="form-group">
    <label class="control-label col-sm-2" for="courseid">Transaction ID:</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="courseid">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="coursename">Student ID:</label>
    <div class="col-sm-4"> 
      <input type="text" class="form-control" id="coursename">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="coursetype">Date:</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="coursetype">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="subject">Description:</label>
    <div class="col-sm-4">
      <input type="number" class="form-control" id="subject">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="comp">Total:</label>
    <div class="col-sm-4">
        <input type="text" class="form-control" id="comp">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="numtests">Notes:</label>
    <div class="col-sm-4">
      <input type="number" class="form-control" id="numtests">
    </div>
  </div>
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-4">
      <button type="submit" class="btn btn-primary">Add </button>
    </div>
  </div>
</form>
    </div>
</div>