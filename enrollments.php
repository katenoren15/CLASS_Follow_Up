<?php
        require_once ('includes/dbconnect.php');
        $connection = db_connect();
        session_start();
        $userid = $_SESSION["user"];
        $query= "SELECT enrollments.enrollment_id, enrollments.enrollment_type, enrollments.enrollment_date, enrollments.grade_of_enrollment, enrollments.cat_status, enrollments.documentation_sent, students.first_name, students.middle_name, students.last_name FROM enrollments, students WHERE enrollments.student_id = students.student_id";
        $ret = mysqli_query($connection, $query);
        if(!$ret){
           echo "Error" . mysqli_error($connection);
        }
?>
<div class="row">
<div class="col-sm-12">
    <br>
        <div class="well well-lg"> 
            <h1>Enrollments</h1> 
            <div class= "text-right"><button type="button" class="button btn btn-primary">Add an Enrollment</button></div>
        </div>
        <button type="button" onclick="exportHTML();" class="btn btn-primary">Export to Microsoft Word</button>

        <form class="navbar-form navbar-right" role="search">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Search">
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
</div>
</div>
        <div class="row" id="source-html">
            <div class="col-sm-12">
            <br>
                <table border="1" class="table table-bordered">
                    <tr>
                        <th>Enrollment ID</th>
                        <th>Student Name</th>
                        <th>Enrollment Type</th>
                        <th>Enrollment Date</th>
                        <th>Grade</th>
                        <th>CAT Status</th>
                        <th>Documentation Sent</th>
                        <th colspan="2">Commands</th>
                    </tr>
                    <?php
                        while($row = mysqli_fetch_array($ret)){
                    ?>
                    <tr>
                        <td><?php echo $row["enrollment_id"]; ?></td>
                        <td> <?php echo $row["first_name"] . " ". $row["middle_name"] . " ".$row["last_name"]; ?> </td>
                        <td> <?php echo $row["enrollment_type"];?> </td>
                        <td> <?php echo $row["enrollment_date"];?> </td>
                        <td> <?php echo $row["grade_of_enrollment"];?> </td>
                        <td> <?php echo $row["cat_status"];?> </td>
                        <td> <?php echo $row["documentation_sent"];?> </td>
                        <td> <button type="button" data-modal="mview" class="button btn btn-primary">View</button></td>
                        <td> <button type="button" data-modal="medit" class="button btn btn-default">Edit</button> </td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </div>

<div class="modal" id="madd">
    <div class="modal-content">
      <div class="modal-header">
        <span class="close">&times;</span>
        <h2 class="text-center">Add an Enrollment</h2>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="post" action="modal-processing.php">
  <div class="form-group">
    <label class="control-label col-sm-2" for="enrollmentid">Enrollment ID:</label>
    <div class="col-sm-4">
      <input type="number" class="form-control" name="enrollmentid">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="studentid">Student ID:</label>
    <div class="col-sm-4">
      <input type="number" class="form-control" id="studentid">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="enrollmenttype">Enrollment Type:</label>
    <div class="col-sm-4"> 
    <select class="form-control" name="enrollmenttype">
            <option value="First">First</option>
            <option value="Re-enrollment">Re-enrollment</option>
        </select>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="enrollmentdate">Enrollment Date:</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="enrollmentdate" placeholder="use jQuery datepicker">
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
    <label class="control-label col-sm-2" for="catstatus">CAT Status:</label>
    <div class="col-sm-4">
    <textarea rows="4" cols="50" class="form-control" name="catstatus"></textarea>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="docsent">Documentation Sent:</label>
    <div class="col-sm-4">
      <textarea rows="4" cols="50" class="form-control" name="docsent"></textarea>
    </div>
  </div>
  <div class="modal-footer"> 
      <input type="hidden" name="purpose" value="addenrollment">
      <button type="submit" name="addenrollment" class="btn btn-primary">Add</button>
    </div>
</form>
                        </div>
    </div>
</div>

<div class="modal" id="mview">
    <div class="modal-content">
      <div class="modal-header">
        <span class="close">&times;</span>
        <h2 class="text-center">Enrollment Details</h2>
      </div>  
    <div class="modal-body">
        <form class="form-horizontal" action="#">
  <div class="form-group">
    <label class="control-label col-sm-2" for="enrollmentid">Enrollment ID:</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="enrollmentid">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="studentid">Student Name:</label>
    <div class="col-sm-4">
      <input type="number" class="form-control" id="studentid" value="id and student name">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="enrollmenttype">Enrollment Type:</label>
    <div class="col-sm-4"> 
      <input type="text" class="form-control" id="enrollmenttype">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="enrollmentdate">Enrollment Date:</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="enrollmentdate">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="grade">Grade:</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="grade">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="catstatus">CAT Status:</label>
    <div class="col-sm-4">
        <input type="text" class="form-control" id="catstatus">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="docsent">Documentation Sent:</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="docsent">
    </div>
  </div>
                        </form>
                        </div>
  <div class="modal-footer"> 
    <input type="hidden" name="purpose" value="viewstudent">
    <button type="submit" data-dismiss="mview" class="btn btn-primary">Close</button>
  </div>
    </div>
</div>

<div class="modal" id="medit">
    <div class="modal-content">
      <div class="modal-header">
        <span class="close">&times;</span>
        <h2 class="text-center">Edit Enrollment</h2>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" action="modal-processing.php">
  <div class="form-group">
    <label class="control-label col-sm-2" for="enrollmentid">Enrollment ID:</label>
    <div class="col-sm-4">
      <input readonly type="text" class="form-control" name="enrollmentid">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="studentid">Student ID:</label>
    <div class="col-sm-4">
      <input readonly type="number" class="form-control" name="studentid">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="enrollmenttype">Enrollment Type:</label>
    <div class="col-sm-4"> 
      <input type="text" class="form-control" name="enrollmenttype">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="enrollmentdate">Enrollment Date:</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="enrollmentdate">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="grade">Grade:</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="grade">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="catstatus">CAT Status:</label>
    <div class="col-sm-4">
        <input type="text" class="form-control" name="catstatus">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="docsent">Documentation Sent:</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="docsent">
    </div>
  </div>
  <div class="modal-footer"> 
    <input type="hidden" name="purpose" value="editstudent">
    <button type="submit" name="editenrollment" class="btn btn-primary">Save Changes </button>
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