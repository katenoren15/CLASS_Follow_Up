<?php
    session_start();
    $form=$_POST["form"];
    require ('includes/dbconnect.php');
    $connection = db_connect();

    if ($form == "Register") {
        $fname= mysqli_real_escape_string($connection,$_POST["firstname"]);
        $sname=mysqli_real_escape_string($connection,$_POST["lastname"]);
        $ulevel=mysqli_real_escape_string($connection,$_POST["userlevel"]);
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
            $query="INSERT INTO users(first_name, last_name, user_level, username, pswrd) 
            VALUES ('$fname', '$lname', '$ulevel', '$user', '$hashpass')";
            $ret1= mysqli_query($connection,$query);
            if($ret1){ 
                    echo "<p>Account created! You can now <a href='login.php'>sign in</a></p>";
                }else{
                    echo "<p>Something went wrong: " . mysqli_error($connection); + "</p>"; 
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
                if(!empty($_POST["remember"])){  
                    setcookie ("username",$user,time()+ (10 * 365 * 24 * 60 * 60));  
                    setcookie ("psword",$passw,time()+ (10 * 365 * 24 * 60 * 60));
                    echo "Cookies Set Successfuly";
                }else {
                    setcookie("username","");
                    setcookie("psword","");
                    echo "Cookies Not Set";
                }
                $_SESSION["user"] = $row["user_id"];
                $_SESSION["username"] = $row["username"]; 
                $_SESSION["loggedin"] = true;
                header('location:index.php');
            }else{
                $_SESSION["loggedin"] = false;
                header('location:login.php');
                $_SESSION["attempts"] += 1;
                if($_SESSION["attempts"] >= 3){
                    setcookie("lock",$user,time() +180);
                    $_SESSION["attempts"] = 0;
                }
            }
        
    } 
?>