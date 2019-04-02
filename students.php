    <?php
        require_once ('includes/dbconnect.php');
        $connection = db_connect();
        session_start();
        $userid = $_SESSION["user"];
        $query= "SELECT * FROM students";
        $ret = mysqli_query($connection, $query);
        if(!$ret){
           echo "Error" . mysqli_error($connection);
        }
        ?>
    <div class="col-sm-10" id="source-html">
    <br>
        <div class="well well-lg"> 
            <h1>Students</h1> 
            <div class= "text-right"><button type="button" class="button btn btn-primary" data-modal="madd">Add a Student</button></div>
        </div>
        <button type="button"  onclick="exportHTML();" class="btn btn-primary">Export to Microsoft Word</button>

        <form class="navbar-form navbar-right" role="search">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Search">
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
        
        <div class="row">
            <div class="col-sm-10">
            <br>
                <table border="1" class="table table-bordered">
                    <tr>
                        <th>Student ID</th>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Last Name</th>
                        <th>Date of Birth</th>
                        <th>Gender</th>
                        <th>Enrollment Status</th>
                        <th colspan="2">Commands</th>
                    </tr>
                    <?php
                        while($row = mysqli_fetch_array($ret)){
                    ?>
                    <tr>
                        <td><?php echo $row["student_id"]; ?></td>
                        <td> <?php echo $row["first_name"]; ?> </td>
                        <td> <?php echo $row["middle_name"]; ?> </td>
                        <td> <?php echo $row["last_name"];?> </td>
                        <td> <?php echo $row["date_of_birth"]; ?> </td>
                        <td> <?php echo $row["gender"];?> </td>
                        <td> <?php echo $row["enrollment_status"];?> </td>
                        <td> <a href="index1.php?page=viewstudents?id=<?php echo $row['student_id']; ?>"><button type="button" class="btn btn-primary">View</button></a></td>
                        <td> <button type="button" class="button btn btn-default" data-modal="medit">Edit</button> </td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
<div class="modal" id="madd">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2 class="text-center">Add a Student</h2>
        <form class="form-horizontal" action="#">
  <div class="form-group">
    <label class="control-label col-sm-2" for="studentid">Student ID:</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="studentid">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="firstname">First Name:</label>
    <div class="col-sm-4"> 
      <input type="text" class="form-control" id="firstname">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="lastname">Last Name:</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="lastname">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="dob">Date of Birth:</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="dob" placeholder="YYYY-MM-DD">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="gender">Gender:</label>
    <div class="col-sm-4">
        <select class="form-control" name="gender">
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="enrollmentstat">Enrollment Status:</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="enrollmentstat">
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

<div class="modal" id="medit">
<div class="modal-content">
        <span class="close">&times;</span>
        <h2 class="text-center">Edit Student Details</h2>
        <form class="form-horizontal" action="#">
  <div class="form-group">
    <label class="control-label col-sm-2" for="studentid">Student ID:</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="studentid">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="firstname">First Name:</label>
    <div class="col-sm-4"> 
      <input type="text" class="form-control" id="firstname">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="lastname">Last Name:</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="lastname">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="dob">Date of Birth:</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="dob" placeholder="YYYY-MM-DD">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="gender">Gender:</label>
    <div class="col-sm-4">
        <select class="form-control" name="gender">
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="enrollmentstat">Enrollment Status:</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="enrollmentstat">
    </div>
  </div>
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-4">
      <button type="submit" class="btn btn-primary">Save Changes</button>
    </div>
  </div>
</form>
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

    window.onclick = function(event) {
        if(event.target == modal[0]) {
            modal[0].style.display = "none";
        }
        if(event.target == modal[1]) {
            modal[1].style.display = "none";
        }
    }

</script>


    </div>        
</div>





