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
            <h1>Enrollments</h1> 
            <?php if($_SESSION["level"] == 'Administrator'){?>
              <div class= "text-right"><button type="button" name="add" id="add" class="button btn btn-primary">Add an Enrollment</button></div>
            <?php } ?>
        </div>
        <button type="button" onclick="exportHTML();" class="btn btn-primary">Export to Microsoft Word</button>

        <form class="navbar-form navbar-right" action="index1.php?page=enrollments" method="post">
            <div class="form-group">
              <input type="text" name="valueToSearchenrollments" id="valueToSearchenrollments" class="form-control" placeholder="Search">
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
</div>
</div>
<div class="row">
  <div class="col-sm-6">
    <br>
    <div class="col-sm-3" for="filtercourse">Filter Data By:</div><select class="col-sm-3" id="fetchval" name="filterenrollment">
      <option value="enrollment_id">Enrollment ID</option>
      <option value="student_id">Student ID</option>
      <option value="enrollment_type">Enrollment Type</option>
      <option value="enrollment_date">Enrollment Date</option>
      <option value="grade_of_enrollment">Grade</option>
      <option value="cat_status">CAT Status</option>
      <option value="documentation_sent">Documentation Sent</option>
    </select>    <br><br>  
  </div>
</div>
        <div class="row" id="source-html">
            <div class="col-sm-12" id="result">
            <br>
            
            </div>
        </div>

<div class="modal" id="madd">
    <div class="modal-content">
      <div class="modal-header">
        <span class="close">&times;</span>
        <h2 class="text-center">Add an Enrollment</h2>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="post" id="insert_form">
  <div class="form-group">
    <label class="control-label col-sm-2" for="enrollmentid">Enrollment ID:</label>
    <div class="col-sm-4">
      <input type="number" class="form-control" name="enrollmentid" required>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="studentid">Student ID:</label>
    <div class="col-sm-4">
      <input type="number" class="form-control" name="studentid" required>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="enrollmenttype">Enrollment Type:</label>
    <div class="col-sm-4"> 
    <select class="form-control" name="enrollmenttype" required> 
            <option value="First">First</option>
            <option value="Re-enrollment">Re-enrollment</option>
        </select>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="enrollmentdate">Enrollment Date:</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="enrollmentdate" required placeholder="use jQuery datepicker">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="grade">Grade:</label>
    <div class="col-sm-4">
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
      <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-primary">
    </div>
</form>
                        </div>
    </div>
</div>


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
                          $('#enrollment_table').html(data); 
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
      $("#fetchval").on('change', function(){
          var value = $(this).val();
          $.ajax({
              url:"fetch-enrollment.php",
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
   url:"fetch-enrollment.php",
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
 $('#valueToSearchenrollments').keyup(function(){
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