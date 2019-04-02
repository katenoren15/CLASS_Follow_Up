<?php
        require_once ('includes/dbconnect.php');
        $connection = db_connect();
        session_start();
        $userid = $_SESSION["user"];
        $query= "SELECT * FROM courses";
        $ret = mysqli_query($connection, $query);
        if(!$ret){
           echo "Error" . mysqli_error($connection);
        }
?>

<div class="col-sm-10">
<br>
        <div class="well well-lg"> 
            <h1>Courses</h1> 
            <div class= "text-right"><button type="button" class="button btn btn-primary">Add a Course</button></div>
        </div>
        <button type="button" onclick="exportHTML();" class="btn btn-primary">Export to Microsoft Word</button>
        
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
                        <th>Course ID</th>
                        <th>Course Name</th>
                        <th>Grade</th>
                        <th>Subject</th>
                        <th>Components</th>
                        <th>Number of Tests</th>
                        <th colspan="2">Commands</th>
                    </tr>
                    <?php
                        while($row = mysqli_fetch_array($ret)){
                    ?>
                    <tr>
                        <td><?php echo $row["course_id"]; ?></td>
                        <td> <?php echo $row["course_name"]; ?> </td>
                        <td> <?php echo $row["grade"];?> </td>
                        <td> <?php echo $row["subject"];?> </td>
                        <td> <?php echo $row["components"];?> </td>
                        <td> <?php echo $row["number_of_tests"];?> </td>
                        <td> <button type="button" data-modal="mview" class="button btn btn-primary">View</button></td>
                        <td> <button type="button" data-modal="medit" class="button btn btn-default">Edit</button> </td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </div>

<div class="modal" id="madd">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2 class="text-center">Add a Course</h2>
        <form class="form-horizontal" action="#">
  <div class="form-group">
    <label class="control-label col-sm-2" for="courseid">Course ID:</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="courseid">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="coursename">Course Name:</label>
    <div class="col-sm-4"> 
      <input type="text" class="form-control" id="coursename">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="coursetype">Course Type:</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="coursetype">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="subject">Subject:</label>
    <div class="col-sm-4">
      <input type="number" class="form-control" id="subject">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="comp">Components:</label>
    <div class="col-sm-4">
        <input type="text" class="form-control" id="comp">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="numtests">Number of Tests:</label>
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

<div class="modal" id="mview">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2 class="text-center">Course Details</h2>
        <form class="form-horizontal" action="#">
  <div class="form-group">
    <label class="control-label col-sm-2" for="courseid">Course ID:</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="courseid">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="coursename">Course Name:</label>
    <div class="col-sm-4"> 
      <input type="text" class="form-control" id="coursename">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="coursetype">Course Type:</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="coursetype">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="subject">Subject:</label>
    <div class="col-sm-4">
      <input type="number" class="form-control" id="subject">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="comp">Components:</label>
    <div class="col-sm-4">
        <input type="text" class="form-control" id="comp">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="numtests">Number of Tests:</label>
    <div class="col-sm-4">
      <input type="number" class="form-control" id="numtests">
    </div>
  </div>
</form>
    </div>
</div>

<div class="modal" id="medit">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2 class="text-center">Edit Course</h2>
        <form class="form-horizontal" action="#">
  <div class="form-group">
    <label class="control-label col-sm-2" for="courseid">Course ID:</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="courseid">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="coursename">Course Name:</label>
    <div class="col-sm-4"> 
      <input type="text" class="form-control" id="coursename">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="coursetype">Course Type:</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="coursetype">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="subject">Subject:</label>
    <div class="col-sm-4">
      <input type="number" class="form-control" id="subject">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="comp">Components:</label>
    <div class="col-sm-4">
        <input type="text" class="form-control" id="comp">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="numtests">Number of Tests:</label>
    <div class="col-sm-4">
      <input type="number" class="form-control" id="numtests">
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
    </div>        
</div>