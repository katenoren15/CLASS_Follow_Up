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
            <?php if($_SESSION["level"] == 'Administrator'){?>
              <div class= "text-right"><button type="button" class="button btn btn-primary">Add a Course</button></div>
            <?php } ?>
        </div>
        <button type="button" onclick="exportHTML();" class="btn btn-primary">Export to Microsoft Word</button>
        
        <form class="navbar-form navbar-right">
            <div class="form-group">
                <input type="text" name="valueToSearchcourses" id="valueToSearchcourses"class="form-control" placeholder="Search">
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
</div>
</div>
<div class="row">
  <div class="col-sm-6">
    <br>
    <div class="col-sm-3" for="filtercourse">Filter Data By:</div><select class="col-sm-3" id="fetchval" name="filtercourse">
      <option value="course_id">Course ID</option>
      <option value="course_name">Course Name</option>
      <option value="grade">Grade</option>
      <option value="subjects">Subject</option>
      <option value="components">Components</option>
      <option value="number_of_tests">Number of Tests</option>
    </select>    <br><br>  
  </div>
</div>
<div class="row" id="source-html">
  <div class="col-sm-12" id="result">
    
              
  </div>
</div>

   <!--Add MOdal -->   
  <div class="modal" id="madd">
    <div class="modal-content">
      <div class="modal-header">
        <button data-dismiss="modal" class="close">&times;</button>
        <h2 class="modal-title text-center">Add a Course</h2>
      </div>   
      <div class="modal-body">
        <form class="form-horizontal" method="POST" id="insert_form">
          <div class="form-group">
            <label class="control-label col-sm-4" for="courseid">Course ID:</label>
            <div class="col-sm-6">
              <input type="number" class="form-control" name="courseid" required>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-4" for="coursename">Course Name:</label>
            <div class="col-sm-6"> 
              <input type="text" class="form-control" name="coursename" required>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-4" for="grade">Grade:</label>
            <div class="col-sm-6">
              <select class="form-control" name="grade" required>
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
      <input type="text" class="form-control" name="subject" required>
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
      <input type="number" class="form-control" name="numtests">
    </div>
  </div>
    <div class="modal-footer">
      <input type="hidden" name="purpose" value="addcourse">
      <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-primary">
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

    window.onclick = function(event) {
        if(event.target == modal[0]) {
            modal[0].style.display = "none";
        }
    }

</script>

<script>
$(document).ready(function(){

 load_data();

 function load_data(query)
 {
  $.ajax({
   url:"fetch-course.php",
   method:"POST",
   data:{query:query},
   beforeSend:function(){  
                          $('#result').html("Fetching Data...");  
                     },  
   success:function(data)
   {
    $('#result').html(data);
   }
  });
 }
 $('#valueToSearchcourses').keyup(function(){
  var search = $(this).val();
  if(search != '')
  {
   load_data(search);
  }
  else
  {
   load_data();
  }
 });
  
});
</script>
<script>
$(document).ready(function(){
  $('#add').click(function(){  
           $('#insert').val("Insert");  
           $('#insert_form')[0].reset();  
      });  
      $('#insert_form').on("submit", function(event){  
                $.ajax({  
                     url:"insert.php",  
                     method:"POST",  
                     data:$('#insert_form').serialize(),  
                     beforeSend:function(){  
                          $('#insert').val("Inserting");  
                     },  
                     success:function(data){  
                          $('#insert_form')[0].reset();  
                          $('#madd').modal('hide');  
                          $('#course_table').html(data); 
                          alert("Data Inserted!"); 
                     }  
                });  
      }); 
});

</script>
<script>
  $(document).ready(function(){
      $("#fetchval").on('change', function(){
          var value = $(this).val();
          $.ajax({
              url:"fetch-course.php",
              method:"POST",
              data:"request="+value,
              beforeSend:function(){
                  $("#result").html("Filtering...");
              },
              success:function(data){
                  $("#result").html(data);
              },

          });
      });
  });
</script>
