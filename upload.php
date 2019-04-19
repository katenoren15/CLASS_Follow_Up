<?php
    require_once ('includes/dbconnect.php');
    $connection = db_connect();
    session_start();
    $s_id = $_SESSION["studentid"];
    

    if(isset($_POST['btn-add-order'])){  
        $ordernum = mysqli_real_escape_string($connection,$_POST["ordernum"]);

        $enrollementid = mysqli_real_escape_string($connection,$_POST["enrollmentid"]);

        $amountpaid = mysqli_real_escape_string($connection,$_POST["amountpaid"]);

        $shipdetails = mysqli_real_escape_string($connection,$_POST["shipdetails"]);

        $deliverystat = mysqli_real_escape_string($connection,$_POST["deliverystat"]);
    
        $name= $_FILES['file']['name'];

        $tmp_name= $_FILES['file']['tmp_name'];

        $file_size = $_FILES['file']['size'];
        
        $file_type = $_FILES['file']['type'];

        $position= strpos($name, "."); 

        $fileextension= substr($name, $position + 1);

        $fileextension= strtolower($fileextension);

        $new_size = $file_size/1024;

        $name1= strtolower($name);

        $final_file=str_replace(' ','-',$name1);

        if (isset($final_file)) {
            $query = "INSERT INTO orders VALUES('$ordernum', '$enrollementid', '$final_file', '$amountpaid', '$shipdetails', '$deliverystat')";
            $ret = mysqli_query($connection, $query);
            
            $path = 'uploads/';

            if (!empty($final_file)){
                if (move_uploaded_file($tmp_name, $path.$final_file)) {
                    //echo 'Uploaded!';
                    $sql = "INSERT INTO uploads(order_number, file_name, file_type, file_size) VALUES('$ordernum', '$final_file', '$file_type', '$file_size')";
                    $ret2=  mysqli_query($connection, $sql);
                    if ($ret2){
            ?>
            <script>
                alert('successfully uploaded');
                window.location.href='index1.php?page=orders';
            </script>
            <?php
                }else{
                    echo "Error" . mysqli_error($connection);
                }
            ?>
            <?php
        }
                }
            }
        }elseif(isset($_POST['btn-add-trans'])){
            $transacid = mysqli_real_escape_string($connection,$_POST["transacid"]);

            $date = mysqli_real_escape_string($connection,$_POST["date"]);

            $description = mysqli_real_escape_string($connection,$_POST["description"]);

            $total = mysqli_real_escape_string($connection,$_POST["total"]);
    
            $name= $_FILES['file']['name'];

            $tmp_name= $_FILES['file']['tmp_name'];

            $file_size = $_FILES['file']['size'];
        
            $file_type = $_FILES['file']['type'];

            $position= strpos($name, "."); 

            $fileextension= substr($name, $position + 1);

            $fileextension= strtolower($fileextension);

            $new_size = $file_size/1024;

            $name1= strtolower($name);

            $final_file=str_replace(' ','-',$name1); 

        if (isset($final_file)) {
            $query = "INSERT INTO transactions VALUES('$transacid', '$s_id', '$date', '$description', '$total', '$final_file')";
            $ret3 = mysqli_query($connection, $query);
            echo $transacid . $final_file . $s_id . $date . $description . $total;
            if($ret3){
                $path = 'uploads/';
                echo $final_file;
            if (!empty($final_file)){
                if (move_uploaded_file($tmp_name, $path.$final_file)) {
                    $sql = "INSERT INTO uploads(transaction_id, file_name, file_type, file_size) VALUES('$transacid', '$final_file', '$file_type', '$file_size')";
                    $ret4 =  mysqli_query($connection, $sql);
                    if($ret4){
            ?>
            <script>
                alert('successfully uploaded');
                window.location.href='viewstudents.php?id=<?php echo $s_id; ?>';
            </script>
            <?php
                }else{
                    echo "Error" . mysqli_error($connection);
                }
            ?>
            <?php
        }
                }
            }
            }
        
            
        }


?>