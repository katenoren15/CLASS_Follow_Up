<?php
require_once ('includes/dbconnect.php');
$connection = db_connect();
session_start(); 
$s_id = $_SESSION["studentid"] ;

      if($_POST["requestc"]){
        $request = $_POST["requestc"];
        $query = "SELECT student_course.grade, student_course.test_sent, student_course.quickscore_status, courses.course_id, courses.course_name, courses.subjects, courses.number_of_tests, courses.components FROM student_course, courses WHERE student_course.student_id = '$s_id' and courses.course_id=student_course.course_id ORDER BY $request";
      
      $result = mysqli_query($connection, $query);
?>
        <table border="1" class="table table-bordered" id="studcourse_table">
                <tr>
                    <th>Course Name</th>
                    <th>Subject</th>
                    <th>Grade For</th>
                    <th>Number of Tests</th>
                    <th>Components</th>
                    <th>Tests Sent</th>
                    <th>QuickScore Status</th>
                    <th>Command</th>
                </tr>
                <?php
                    while($row = mysqli_fetch_array($result)){
                ?>
                <tr>
                    <td><?php echo $row["course_name"]; ?></td>
                    <td> <?php echo $row["subjects"]; ?> </td>
                    <td> <?php echo $row["grade"];?> </td>
                    <td> <?php echo $row["number_of_tests"];?> </td>
                    <td> <?php echo $row["components"];?> </td>
                    <td> <?php echo $row["test_sent"];?> </td>
                    <td> <?php echo $row["quickscore_status"];?> </td>
                    <td><form action="edit.php?cid=<?php echo $row["course_id"]; ?>&sid=<?php echo $s_id; ?>" method="post"><input type="submit" class=" btn btn-warning" name="editcourseinfo" value="Edit"></form></td>
                </tr>
                <?php } ?>
            </table>
                <?php } 
            
                if($_POST["requestt"]){
        $request = $_POST["requestt"];
        $query = "SELECT * FROM transactions WHERE student_id = '$s_id' ORDER BY $request";
      
      $result = mysqli_query($connection, $query);
?>
        <table border="1" class="table table-bordered" id="transaction_table">
                <tr>
                    <th>Transaction ID</th>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Total</th>
                    <th>Transaction Details</th>
                    <th>Command</th>
                </tr>
                <?php
                    while($row5 = mysqli_fetch_array($result)){
                ?>
                <tr>
                    <td><?php echo $row5["transaction_id"]; ?></td>
                    <td> <?php echo $row5["trans_date"];?> </td>
                    <td> <?php echo $row5["trans_description"];?> </td>
                    <td> <?php echo $row5["total"];?> </td>
                    <td> <a href="uploads/<?php echo $row5['transaction_details'];?>" target="_blank"><?php echo $row5["transaction_details"];?> </a></td>
                    <td> <form action="edit.php?id=<?php echo $row5["transaction_id"]; ?>" method="post"><input type="submit" class=" btn btn-warning" name="edittransaction" value="Edit"></form></td>
                </tr>
                <?php } ?>
            </table>
                <?php } 

                if($_POST["requeste"]){
        $request = $_POST["requeste"];
        $query = "SELECT enrollments.enrollment_id, enrollments.enrollment_type, enrollments.enrollment_date, enrollments.grade_of_enrollment, enrollments.cat_status, enrollments.documentation_sent, orders.amount_paid, orders.order_details, orders.delivery_status FROM enrollments,orders WHERE enrollments.student_id = '$s_id' and orders.enrollment_id = enrollments.enrollment_id ORDER BY $request";
      
      $result = mysqli_query($connection, $query);
?>
        <table border="1" class="table table-bordered" id="studenrolllment_table">
                <tr>
                  <th>Enrollment ID</th>
                  <th>Enrollment Type</th>
                  <th>Enrollment Date</th>
                  <th>Grade</th>
                  <th>Amount Paid</th>
                  <th>Order Details</th>
                  <th>CAT Status</th>
                  <th>Documentation Sent</th>
                  <th>Delivery Status</th>
                  <th>Command</th>
                </tr>
                    <?php
                        while($row2 = mysqli_fetch_array($result)){
                    ?>
                <tr>
                  <td> <?php echo $row2["enrollment_id"]; ?></td>
                  <td> <?php echo $row2["enrollment_type"];?> </td>
                  <td> <?php echo $row2["enrollment_date"];?> </td>
                  <td> <?php echo $row2["grade_of_enrollment"];?> </td>
                  <td> <?php echo $row2["amount_paid"];?> </td>
                  <td> <a href="uploads/<?php echo $row2['order_details'];?>" target="_blank"><?php echo $row2["order_details"];?> </a></td>
                  <td> <?php echo $row2["cat_status"];?> </td>
                  <td> <?php echo $row2["documentation_sent"];?> </td>
                  <td> <?php echo $row2["delivery_status"];?> </td>
                  <td><form action="edit.php?enrollment=<?php echo $row2["enrollment_id"];?>&sid=<?php echo $s_id; ?>" method="post"><input type="submit" class=" btn btn-warning" name="editenrollmenthist" value="Edit"></form></td>
                </tr>
                <?php } ?>
            </table>
                <?php } 

                if($_POST["requestg"]){
        $request = $_POST["requestg"];
        $query = "SELECT * FROM student_grade WHERE student_id = '$s_id' ORDER BY $request";
      
      $result = mysqli_query($connection, $query);
?>
        <table border="1" class="table table-bordered" id="studgrade_table">
                <tr>
                    <th>Grade</th>
                    <th>End Date</th>
                    <th>Grade Completion Status</th>
                    <th>Report Card Status</th>
                    <th>Diploma Status</th>
                    <th>Command</th>
                </tr>
                <?php
                    while($row3 = mysqli_fetch_array($result)){
                ?>
                <tr>
                    <td> <?php echo $row3["grade"]; ?></td>
                    <td> <?php echo $row3["end_date"]; ?> </td>
                    <td> <?php echo $row3["grade_completion_status"];?> </td>
                    <td> <?php echo $row3["report_card_status"];?> </td>
                    <td> <?php echo $row3["diploma_status"];?> </td>
                    <td><form action="edit.php?grade=<?php echo $row3["grade"]; ?>&sid=<?php echo $s_id; ?>" method="post"><input type="submit" class=" btn btn-warning" name="editgradeinfo" value="Edit"></form></td>
                </tr>
                <?php } ?>
            </table>
                <?php } ?>