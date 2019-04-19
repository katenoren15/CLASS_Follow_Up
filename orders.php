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
            <div class= "text-right"><button type="button" class="button btn btn-primary">Add an Order</button></div>
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
                        <th>Order Number</th>
                        <th>Enrollment ID</th>
                        <th>Student Name</th>
                        <th>Order Details</th>
                        <th>Amount Paid</th>
                        <th>Shipping Details</th>
                        <th>Delivery Status</th>
                        <th colspan="2">Commands</th>
                    </tr>
                    <tr>
                        <td><?php echo $row["order_number"]; ?></a></td>
                        <td> <?php echo $row["enrollment_id"]; ?> </td>
                        <td> <?php echo $row["first_name"] . " ". $row["middle_name"] . " ".$row["last_name"]; ?> </td>
                        <td> <a href="uploads/<?php echo $row['order_details'];?>" target="_blank"><?php echo $row["order_details"];?> </a></td>
                        <td> <?php echo $row2["amount_paid"];?> </td>
                        <td> <?php echo $row["shipping_details"];?> </td>
                        <td> <?php echo $row["delivery_status"];?> </td>
                        <td> <button type="button" data-modal="mview" class="button btn btn-primary">View</button></td>
                        <td> <button type="button" data-modal="medit" class="button btn btn-default">Edit</button> </td>
                    </tr>
                </table>
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
      <input type="number" class="form-control" name= "ordernum" id="ordernum">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="enrollmentid">Enrollment ID:</label>
    <div class="col-sm-4"> 
      <input type="number" class="form-control" name="enrollmentid">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="file">Order Details:</label>
    <div class="col-sm-4">
      <input type="file" class="form-control" name="file" id="file">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="amountpaid">Amount Paid:</label>
    <div class="col-sm-4">
      <input type="text"  class="form-control" name="amountpaid">
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

<div class="modal" id="mview">
    <div class="modal-content">
      <div class="modal-header">
        <button data-dismiss="modal" class="close">&times;</button>
        <h2 class="text-center">Order Details</h2>
      </div>
      <div class="modal-body">
    <form class="form-horizontal" method="POST" action="#">
  <div class="form-group">
    <label class="control-label col-sm-2" for="ordernum">Order Number:</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="ordernum">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="enrollmentid">Enrollment ID:</label>
    <div class="col-sm-4"> 
      <input type="text" class="form-control" id="enrollmentid">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="orderdetails">Order Details:</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="orderdetails">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="amountpaid">Amount Paid:</label>
    <div class="col-sm-4">
      <input type="number" class="form-control" id="amountpaid">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="shipdetails">Shipping Details:</label>
    <div class="col-sm-4">
        <input type="text" class="form-control" id="shipdetails">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="deliverystat">Delivery Status:</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="deliverystat">
    </div>
  </div>
  <div class="modal-footer"> 
  <input type="hidden" name="purpose" value="vieworder">
    <button type="submit" data-dismiss="mview" class="btn btn-primary">Close</button>
  </div>
</form>
      </div>
    </div>
</div>

<div class="modal" id="medit">
    <div class="modal-content">
      <div class="modal-header">
        <span class="close">&times;</span>
        <h2 class="text-center">Edit Order</h2>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="modal-processing.php">
  <div class="form-group">
    <label class="control-label col-sm-2" for="ordernum">Order Number:</label>
    <div class="col-sm-4">
      <input type="text" readonly class="form-control" id="ordernum">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="enrollmentid">Enrollment ID:</label>
    <div class="col-sm-4"> 
      <input readonly type="text" class="form-control" id="enrollmentid">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="file">Order Details:</label>
    <div class="col-sm-4">
      <input type="file" class="form-control" name="file" id="file">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="amountpaid">Amount Paid:</label>
    <div class="col-sm-4">
      <input type="number" class="form-control" name="amountpaid">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="shipdetails">Shipping Details:</label>
    <div class="col-sm-4">
        <input type="text" class="form-control" name="shipdetails">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="deliverystat">Delivery Status:</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="deliverystat">
    </div>
  </div>
  <div class="modal-footer"> 
    <input type="hidden" name="purpose" value="editorder">
    <button type="submit" name="editorder" class="btn btn-primary">Save Changes</button>
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
    </div>        
</div>