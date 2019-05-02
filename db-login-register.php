<?php
    session_start();
    $form=$_POST["form"];
    require ('includes/dbconnect.php');
    $connection = db_connect();

    if ($form == "Register") {
        $fname= mysqli_real_escape_string($connection,$_POST["firstname"]);
        $lname=mysqli_real_escape_string($connection,$_POST["lastname"]);
        $user=mysqli_real_escape_string($connection,$_POST["username"]);
        $passw=mysqli_real_escape_string($connection,$_POST["password"]);
        $hashpass = password_hash($passw, PASSWORD_BCRYPT);
        $query = "SELECT username, pswrd FROM users";
        $ret = mysqli_query($connection, $query);
        $num_rows=mysqli_num_rows($ret);
        $found=0;
        
        for($i=0;$i < $num_rows;$i++){
            $row=mysqli_fetch_array($ret);
            if($row["username"]== $user) {
                echo "Username has been used.";
                $found = 1;
                break;
            }
        }
        if($found==0){
            if(isset($_POST["user_level"])){
                $ulevel = mysqli_real_escape_string($connection, $_POST["user_level"]);
                $query="INSERT INTO users(first_name, last_name, user_level, username, pswrd) 
                        VALUES ('$fname', '$lname', '$ulevel', '$user', '$hashpass')";
                 $ret1= mysqli_query($connection,$query);
                 if($ret1){ 
                     $last_id = mysqli_insert_id($connection);
                     $_SESSION["user"] = $last_id;
                     $query2 = "SELECT * FROM users WHERE user_id" . "= \"$last_id\"";
                     $result = mysqli_query($connection, $query2);
                     $row = mysqli_fetch_array($result);
                     $_SESSION["firstname"] = $row["first_name"]; 
                     $_SESSION["login"] = true;
                     header('location:index1.php?page=home');
                 }else{
                     echo "<p>Something went wrong: " . mysqli_error($connection); + "</p>"; 
                 } 
            }else{
                $query="INSERT INTO users(first_name, last_name, user_level, username, pswrd) 
                        VALUES ('$fname', '$lname', 'User', '$user', '$hashpass')";
                $ret1= mysqli_query($connection,$query);
                if($ret1){ 
                    $last_id = mysqli_insert_id($connection);
                    $_SESSION["user"] = $last_id;
                    $query2 = "SELECT * FROM users WHERE user_id" . "= \"$last_id\"";
                    $result = mysqli_query($connection, $query2);
                    $row = mysqli_fetch_array($result);
                    $_SESSION["firstname"] = $row["first_name"]; 
                    $_SESSION["login"] = true;
                    header('location:index1.php?page=home');
                }else{
                    echo "<p>Something went wrong: " . mysqli_error($connection); + "</p>"; 
                } 
            }
        }
            
    }elseif($form == "Login"){
            $user = mysqli_real_escape_string($connection,$_POST["username"]);
            $passw = mysqli_real_escape_string($connection,$_POST["password"]);

            $query = "SELECT * FROM users WHERE `username` " . "= \"$user\"";
            $ret = mysqli_query($connection,$query);
            $row=mysqli_fetch_array($ret);
            if($row){
                $validpass = password_verify($passw, $row['pswrd']);  
            }
            if($validpass){
                $_SESSION["login"] = true;  
                $_SESSION["user"] = $row["user_id"];
                $_SESSION["firstname"] = $row["first_name"]; 
                
                $_SESSION["level"] = $row["user_level"];
                header('location:index1.php?page=home');
            }else{
                $_SESSION["login"] = false;
                header('location:login.php');
                $_SESSION["attempts"] += 1;
                if($_SESSION["attempts"] >= 3){
                    setcookie("lock",$user,time() +180);
                    $_SESSION["attempts"] = 0;
                }
            }
        
    } 
?>