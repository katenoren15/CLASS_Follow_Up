<?php
        require_once ('includes/dbconnect.php');
        $connection = db_connect();
        session_start();
        $userid = $_SESSION["user"];
        $query= "SELECT * FROM orders";
        $ret = mysqli_query($connection, $query);
        if(!$ret){
           echo "Error" . mysqli_error($connection);
        }
?>

<div class="col-sm-10">
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

        <div class="row">
            <div class="col-sm-10">
            <br>
                <table border="1" class="table table-bordered">
                    <tr>
                        <th>Order Number</th>
                        <th>Enrollment ID</th>
                        <th>Order Details</th>
                        <th>Amount Paid</th>
                        <th>Shipping Details</th>
                        <th>Delivery Status</th>
                        <th colspan="2">Commands</th>
                    </tr>
                    <?php
                        while($row = mysqli_fetch_array($ret)){
                    ?>
                    <tr>
                        <td><?php echo $row["order_number"]; ?></a></td>
                        <td> <?php echo $row["enrollment_id"]; ?> </td>
                        <td> <?php echo $row["order_details"];?> </td>
                        <td> <?php echo $row["amount_paid"];?> </td>
                        <td> <?php echo $row["shipping_details"];?> </td>
                        <td> <?php echo $row["delivery_status"];?> </td>
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
        <h2 class="text-center">Add an Order</h2>
        <form class="form-horizontal" action="#">
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
      <input type="file" class="form-control" id="orderdetails">
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
        <h2 class="text-center">Order Details</h2>
        <form class="form-horizontal" action="#">
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
</form>
    </div>
</div>

<div class="modal" id="medit">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2 class="text-center">Edit Order</h2>
        <form class="form-horizontal" action="#">
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