<?php
  require_once ('includes/dbconnect.php');
  $connection = db_connect();
  session_start();
  $userid = $_SESSION["user"];
 
    
  
?>
<div class="row">
    <div class="col-sm-12">
    <br>
        <div class="well well-lg"> 
            <h1>Students</h1> 
            <?php if($_SESSION["level"] == 'Administrator'){?>
            <div class= "text-right"><button type="button"  name="add" id="add" class="button btn btn-primary" >Add a Student</button></div>
            <?php } ?>
        </div>
        <button type="button"  onclick="exportHTML();" class="btn btn-primary">Export to Microsoft Word</button>

        <form class="navbar-form navbar-right" action="index1.php?page=students" method="post">
            <div class="form-group">
                <input type="text" name="valueToSearchstudents" id="valueToSearchstudents" class="form-control" placeholder="Search">
            </div>
            <button type="submit" name="search" class="btn btn-default">Submit</button>
        </form>
</div>
</div>
<div class="row">
  <div class="col-sm-6">
    <br>
    <div class="col-sm-3" for="filtercourse">Filter Data By:</div><select class="col-sm-3" id="fetchval" name="filterstudent">
      <option value="student_id">Student ID</option>
      <option value="first_name">First Name</option>
      <option value="middle_name">Middle Name</option>
      <option value="last_name">Last Name</option>
      <option value="date_of_birth">Date of Birth</option>
      <option value="gender">Gender</option>
      <option value="enrollment_status">Enrollment Status</option>
      <option value="student_type">Current of Past</option>
      <option value="date_of_departure">Date of Departure</option>
    </select>    <br><br>  
  </div>
</div>
        <div class="row" id="source-html">
            <div class="col-sm-12" id="result">
            <br>
            <span></span>
              <form><input type="hidden" name="type" value="student"></form>
            </div>
        </div>

<div class="modal" id="add_data_Modal">
    <div class="modal-content">
      <div class="modal-header">
        <span class="close">&times;</span>
        <h2 class="text-center">Add a Student</h2>
      </div>
   <div class="modal-body">
        <form class="form-horizontal" id="insert_form" method="post" >
  <div class="form-group">
    <label class="control-label col-sm-2" for="newid">Student ID:</label>
    <div class="col-sm-4">
      <input type="number" class="form-control" id="newid" name="newid" required>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="newfname">First Name:</label>
    <div class="col-sm-4"> 
      <input type="text" class="form-control" id="newfname" name="newfname" required>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="newmidname">Middle Name:</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="newmidname" name="newmidname">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="newlname">Last Name:</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="newlname" name="newlname" required>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="newdob">Date of Birth:</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="newdob" name="newdob" required placeholder=" use jQuery datepicker YYYY-MM-DD">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="newgender">Gender:</label>
    <div class="col-sm-4">
        <select class="form-control" required id="newgender" name="newgender">
            <option name="gender" value="Male">Male</option>
            <option name="gender" value="Female">Female</option>
        </select>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="newenrollmentstat">Enrollment Status:</label>
    <div class="col-sm-4">
      <select class="form-control" required id="newenrollmentstat" name="newenrollmentstat"> 
            <option name="enrollmentstat" value="Enrolled">Enrolled</option>
            <option name="enrollmentstat" value="Not enrolled">Not enrolled</option>
            <option name="enrollmentstat" value="Enrollment Pending">Enrollment Pending</option>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="newstudenttype">Student Type:</label>
    <div class="col-sm-4">
      <select class="form-control" required id="newstudenttype" name="newstudenttype">
            <option name="studenttype" value="Current">Current</option>
            <option name="studenttype" value="Past">Past</option>
        </select>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="newdod">Date of departure:</label>
    <div class="col-sm-4">
      <input type="text" id="newdod" name="newdod" class="form-control" placehoolder="use jQuery datepicker YYYY-MM-DD"/>
    </div>
  </div>
  <div class="modal-footer">
    <input type="hidden" name="student_id" id="student_id" />
    <input type="hidden" name="purpose" value="addstudent">
    <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-primary">
  </div>
</form>
                        </div>
    </div>

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
                          $('#add_data_Modal').modal('hide');  
                          $('#student_table').html(data);
                          alert("Data Inserted!");  
                     }  
                });  
      }); 
});

</script>


    
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
  $(document).ready(function(){
      $("#fetchval").on('change', function(){
          var value = $(this).val();
          $.ajax({
              url:"fetch.php",
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


<script>
$(document).ready(function(){

 load_data();

 function load_data(query)
 {
  $.ajax({
   url:"fetch.php",
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
 $('#valueToSearchstudents').keyup(function(){
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




