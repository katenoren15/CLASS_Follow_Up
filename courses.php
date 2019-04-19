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
<div class="row">
<div class="col-sm-12">
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
</div>
</div>
        <div class="row" id="source-html">
            <div class="col-sm-12">
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
                        <td> <?php echo $row["subjects"];?> </td>
                        <td> <?php echo $row["components"];?> </td>
                        <td> <?php echo $row["number_of_tests"];?> </td>
                        <td> <button type="button" data-modal="mview" class="button btn btn-primary">View</button></td>
                        <td> <button type="button" data-modal="medit" class="button btn btn-default">Edit</button></td> 
                        <?php } ?> 
                        </tr>
                </table>
            </div>
      </div>
  <div class="modal" id="madd">
    <div class="modal-content">
      <div class="modal-header">
        <button data-dismiss="modal" class="close">&times;</button>
        <h2 class="modal-title text-center">Add a Course</h2>
      </div>   
      <div class="modal-body">
        <form class="form-horizontal" method="POST" action="modal-processing.php">
          <div class="form-group">
            <label class="control-label col-sm-4" for="courseid">Course ID:</label>
            <div class="col-sm-6">
              <input type="number" class="form-control" id="courseid">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-4" for="coursename">Course Name:</label>
            <div class="col-sm-6"> 
              <input type="text" class="form-control" id="coursename">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-4" for="grade">Grade:</label>
            <div class="col-sm-6">
              <select class="form-control" name="grade">
                <option value="Male">8</option>
                <option value="Female">9</option>
                <option value="Female">10</option>
                <option value="Female">11</option>
                <option value="Female">12</option>
              </select>
            </div>
          </div>
  <div class="form-group">
    <label class="control-label col-sm-4" for="subject">Subject:</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="subject">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-4" for="comp">Components:</label>
    <div class="col-sm-6">
      <textarea rows="4" cols="50" class="form-control" name="comp"></textarea>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-4" for="numtests">Number of Tests:</label>
    <div class="col-sm-6">
      <input type="number" class="form-control" id="numtests">
    </div>
  </div>
    <div class="modal-footer">
      <input type="hidden" name="purpose" value="addcourse">
      <input type="submit" name="addcourse" id="add" value="Add" class="btn btn-success"/>
    </div>           
        </form> 
    </div>
</div>
                        </div>    
<!-- View Modal-->
<div class="modal" id="mview">
  <div class="modal-content">
    <div class="modal-header">
      <button data-dismiss="modal" class="close">&times;</button>
      <h2 class="text-center">Course Details</h2>
    </div>
    <div class="modal-body" id="course-details"></div>
    <div class="modal-footer">
      <input type="hidden" name="purpose" value="viewcourse">
    </div>
  </div> 
</div>

<!-- Edit Modal -->
<div class="modal" id="medit">
  <div class="modal-content">
    <div class="modal-header">
      <button data-dismiss="modal" class="close">&times;</button>
      <h2 class="modal-title text-center">Edit Course Details</h2>
    </div>   
    <div class="modal-body">
      <form class="form-horizontal" method="post" action="modal-processing.php">
          <div class="form-group">
            <label class="control-label col-sm-4" for="courseid">Course ID:</label>
            <div class="col-sm-6">
              <input type="number" readonly name="courseid" id="course-id" class="form-control" value="<?php echo $row["course_id"]?>">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-4" for="coursename">Course Name:</label>
            <div class="col-sm-6"> 
              <input type="text" name="coursename" id="coursename" class="form-control" value="<?php echo $row["course_name"]?>">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-4" for="grade">Grade:</label>
            <div class="col-sm-6">
              <select class="form-control" name="grade" id="grade" value="<?php echo $row["grade"]?>">
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-4" for="subject">Subject:</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="subject" id="subject" value="<?php echo $row["subject"]?>">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-4" for="comp">Components:</label>
            <div class="col-sm-6">
              <textarea rows="4" cols="50" class="form-control" name="comp" id="comp"><?php echo $row["components"]?></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-4" for="numtests">Number of Tests:</label>
            <div class="col-sm-6">
              <input type="number" class="form-control" name="numtests" id="numtests" value="<?php echo $row["number_of_tests"]?>">
            </div>
          </div>
          <div class="modal-footer"> 
            <input type="hidden" name="purpose" value="editcourse">
            <input type="submit" name="editcourse" id="edit" value="Save Changes" class="btn btn-success"/>
          </div>  
        </form>          
      </div>
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
  </div>        
</div>