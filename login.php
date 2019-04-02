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
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>CLASS Follow Up</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./css/bootstrap.min.css">
  <script src="./js/jquery-3.3.1.js"></script>
  <script src="./js/bootstrap.min.js"></script>
  <style>
      body{
        background-color: #e3f2fd;
        padding-top: 200px;
      }
      img{
          height:200px;
          width:200px;
      }
      .well{
        background-color: white;
        border: 1px solid #1b7b9f;
      }
  </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4 text-center">
            <div class="well well-lg"> 
            <?php
                if(isset($_COOKIE["lock"])){
                    echo "<div class='alert alert-danger' role='alert'>3 wrong attempts. Please wait for 3 minutes.</div>";
                }else {
            ?>
                <form name="login" method="post" class="text-center" action="db-login-register.php">
                    <h1>Sign In</h1>
                    <br>
                            <input class="form-control " type="text" name="username" required="required" placeholder="Enter Username"/>
                            <br>
                            <input class="form-control " type="password" name="password" required="required" placeholder="Enter Password">
                            <div class="checkbox">
                                <label><input type="checkbox" name="remember"> Remember me</label>
                            </div>  
                      
                        <br>
                        <input type="hidden" name="form" value="Login">
                        <input class="btn btn-default" type="submit" value="Log In">
                </form>
                <br>

                <span> Don't have an account. <a href="register.php">Create one</a></span>
                <?php } ?>
            </div>
        </div>
        <div class="col-sm-4"></div>
    </div>
</div>
<?php } ?>