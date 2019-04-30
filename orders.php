<?php
        require_once ('includes/dbconnect.php');
        $connection = db_connect();
        session_start();
        $userid = $_SESSION["user"];
        $query= "SELECT orders.order_number, orders.enrollment_id, orders.order_details, orders.amount_paid, orders.shipping_details, orders.delivery_status, students.first_name, students.middle_name, students.last_name FROM orders, students, enrollments WHERE orders.enrollment_id = enrollments.enrollment_id and enrollments.student_id = students.student_id";
        $ret = mysqli_query($connection, $query);
        if(!$ret){
           echo "Error" . mysqli_error($connection);
        }
        $row = mysqli_fetch_array($ret);
        $query2 = "SELECT * FROM uploads";
        $ret2 = mysqli_query($connection, $query);
        if(!$ret2){
          echo "Error" . mysqli_error($connection);
        }
      $row2 = mysqli_fetch_array($ret2);
?>
<div class="row">
<div class="col-sm-12">
<br>
        <div class="well well-lg"> 
            <h1>Orders</h1> 
            <?php if($_SESSION["level"] == 'Administrator'){?>
              <div class= "text-right"><button type="button" class="button btn btn-primary">Add an Order</button></div>
            <?php } ?> 
        </div>
        <button type="button" onclick="exportHTML();" class="btn btn-primary">Export to Microsoft Word</button>

        <form class="navbar-form navbar-right">
            <div class="form-group">
            <input type="text" name="valueToSearchorders" id="valueToSearchorders" class="form-control" placeholder="Search">
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
</div>
</div>
<div class="row">
  <div class="col-sm-6">
    <br>
    <div class="col-sm-3" for="filtercourse">Filter Data By:</div><select class="col-sm-3" id="fetchval" name="filtercourse">
      <option value="order_number">Order Number</option>
      <option value="enrollment_id">Enrollment ID</option>
      <option value="order_details">Order Details</option>
      <option value="amount_paid">Amount Paid</option>
      <option value="shipping_details">Shipping Details</option>
      <option value="delivery_status">Delivery Status</option>
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
        <h2 class="text-center">Add an Order</h2>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="upload.php">
  <div class="form-group">
    <label class="control-label col-sm-2" for="ordernum">Order Number:</label>
    <div class="col-sm-4">
      <input type="number" class="form-control" name= "ordernum" id="ordernum" required>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="enrollmentid">Enrollment ID:</label>
    <div class="col-sm-4"> 
      <input type="number" class="form-control" name="enrollmentid" required>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="file">Order Details:</label>
    <div class="col-sm-4">
      <input type="file" class="form-control" name="file" id="file" required>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="amountpaid">Amount Paid:</label>
    <div class="col-sm-4">
      <input type="text"  class="form-control" name="amountpaid" required>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="shipdetails">Shipping Details:</label>
    <div class="col-sm-4">
      <textarea rows="4" cols="50" class="form-control" name="shipdetails"></textarea>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="deliverystat">Delivery Status:</label>
    <div class="col-sm-4">
      <textarea rows="4" cols="50" class="form-control" name="deliverystat"></textarea>
    </div>
  </div>
  <div class="modal-footer">
    <input type="hidden" name="purpose" value="addorder">
    <button type="submit" name= "btn-add-order" class="btn btn-primary">Add </button>
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
      $("#fetchval").on('change', function(){
          var value = $(this).val();
          $.ajax({
              url:"fetch-order.php",
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
   url:"fetch-order.php",
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
 $('#valueToSearchorders').keyup(function(){
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
    </div>        
</div>