<?php
    require_once ('includes/dbconnect.php');
    $connection = db_connect();
    session_start();
    $userid = $_SESSION["user"];


$outputorder = '';
if(isset($_POST["query"])){
    $search = mysqli_real_escape_string($connection, $_POST["query"]);
    $query = "SELECT * FROM `orders` WHERE (`order_number` LIKE '".$search."%') or (`enrollment_id` LIKE '".$search."%') or (`order_details` LIKE '".$search."%') or (`amount_paid` LIKE '".$search."%') or (`shipping_details` LIKE '%".$search."%') or (`delivery_status` LIKE '%".$search."%')";
}else{
    if($_POST["request"]){
        $request = $_POST["request"];
        $query = "SELECT * FROM orders ORDER BY $request";
      }else{
        $query = "SELECT * FROM orders";
      }
}
$result = mysqli_query($connection, $query);
if(mysqli_num_rows($result) > 0){
 $outputorder .= ' <div class="table-responsive">
   <table class="table table-bordered" id="order_table">
    <tr>
        <th>Order Number</th>
        <th>Enrollment ID</th>
        <th>Order Details</th>
        <th>Amount Paid</th>
        <th>Shipping Details</th>
        <th>Delivery Status</th>
        <th colspan="2">Commands</th>
    </tr>';
 while($row = mysqli_fetch_array($result))
 {
  $outputorder .= '
   <tr>
        <td>' .$row["order_number"]. '</td>
        <td>'. $row["enrollment_id"]. '</td>
        <td> <a href="uploads/' . $row['order_details'] . '" target="_blank">' .$row["order_details"]. '</a></td>
        <td>' .$row["amount_paid"]. '</td>
        <td>' .$row["shipping_details"]. '</td>
        <td>' .$row["delivery_status"].'</td>
        <td> <input type="button" class="btn btn-primary" value="View"></td>
        <td> <form action="edit.php?id=' .$row['order_number']. '" method="post"><input type="submit" class="button edit_data btn btn-default" id="' .$row["student_id"]. '" value="Edit" name="editorder"></form></td>
   </tr>
  ';
 }

 echo $outputorder;
}else
{
 echo 'Data Not Found';
}
?>