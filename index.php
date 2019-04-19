<?php
 session_start();
 $userid = $_SESSION["user"];
 
    $file = "check.txt";
    $text = file_get_contents($file);
    $values = preg_split('/[\n,]+/', $text);

    foreach($values as $value){
        //echo $value;
    }
    
    if($value == "No"){
       header('location:installer.php');
    }else{
        if($_SESSION["login"] = true){
            header("location:login.php");
        }else{
            header("location:index1.php?page=home");
        }
    }




        
   