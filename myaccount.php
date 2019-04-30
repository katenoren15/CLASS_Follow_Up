<?php 
include ('includes/header.php');
require_once ('includes/dbconnect.php');
$connection = db_connect();
session_start();
$userid = $_SESSION["user"];

$query = "SELECT * FROM users WHERE user_id" . "= \"$userid\"";
 $ret = mysqli_query($connection, $query);
 $row = mysqli_fetch_array($ret);
?>
</div>
<?php
$change = $_POST["form"];

if($change == "user"){
    if(isset($_POST["newuser"])){
        $user = mysqli_real_escape_string($connection,$_POST["newuser"]);
        $query= "UPDATE users SET username='$user' WHERE user_id=\"$userid\"";
        $ret = mysqli_query($connection, $query);
        if($ret){
            header("location:myaccount.php");
            echo "<div class='alert alert-success alert-dismissible'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Change successful.</div>";
        }else{
            echo "<div class='alert alert-danger' role='alert'>Error" . mysqli_error($connection) ."</div>";
        }
    }
}else{
    if(isset($_POST["newpass"])){
        $currpass = mysqli_real_escape_string($connection,$_POST["currpass"]);
        $validpass = password_verify($currpass, $row['pswrd']);
        if($validpass){
            $newpass = mysqli_real_escape_string($connection,$_POST["newpass"]);
            $hashpass = password_hash($newpass, PASSWORD_BCRYPT);
            $query= "UPDATE users SET pswrd='$hashpass' WHERE user_id=\"$userid\"";
            $ret = mysqli_query($connection, $query);
            if($ret){
                header("location:myaccount.php");
                echo "<div class='alert alert-success alert-dismissible'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Change successful.</div>";
            }else{
                echo "<div class='alert alert-danger' role='alert'>Error" . mysqli_error($connection) ."</div>";
            }
        }
        
    }
}

?>


<div class="col-sm-12" id="details">
            <u><h1 class="text-center">My Account</h1></u>
            <h3>Personal Information</h3>
            <br>
            <div class="table-responsive">
                <table class="account">
                    <tr>
                        <td>First Name:</td>
                        <td><?php echo $row["first_name"] ?></td>
                    </tr>
                    <tr>
                        <td>Surname:</td>
                        <td><?php echo $row["last_name"]?></td>
                    </tr>
                </table>
            </div>
            <h3>Account Settings</h3>
            <div class="table-responsive">
                <table class="account">
                    <tr>
                        <td>Access Level:</td>
                        <td><?php echo $row["user_level"]?></td>
                    </tr>
                    <tr>
                        <td>Username:</td>
                        <td><?php echo $row["username"]?></td>
                        <td><button class="button btn btn-default" data-modal="muser">Edit</button></td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td><button class="button btn btn-default" data-modal="mpass">Change</button></td>
                    </tr>
                </table>
            </div>
            <br>
            <?php include ('includes/footer.php')?> 
    
<div class="modal" id="muser">
    <div class="modal-content">
        <div class="modal-header">
            <span class="close">&times;</span>
            <h2 class="text-center">Change Username</h2>
        </div> 
        <div class="modal-body">   
            <form class="form-horizontal" method="post" action="#">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="newpass">Enter new username:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="newuser" required="required">
                    </div>
                </div>    
                <div class="modal-footer">
                    <input type="hidden" name="form" value="user">
                    <input type="submit" class="btn btn-primary" value="Save">
                </div>    
            </form>
       </div>
    </div>
</div>

<div class="modal" id="mpass">
    <div class="modal-content">
        <div class="modal-header">
            <span class="close">&times;</span>
            <h2 class="text-center">Change Password</h2>
        </div> 
        <div class="modal-body">   
            <form class="form-horizontal" method="post" action="#">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="currpass">Enter current password:</label>
                    <div class="col-sm-4">
                        <input type="password" class="form-control" name="currpass" >
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="newpass">Enter new password:</label>
                    <div class="col-sm-4">
                        <input type="password" class="form-control" name="newpass" required="required">
                    </div>
                </div>      
                <div class="modal-footer">
                    <input type="hidden" name="form" value="pass">
                    <input type="submit" class="btn btn-primary" value="Save">
                </div>    
            </form>
       </div>
    </div>

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

    window.onclick = function(event) {
        if(event.target == modal[0]) {
            modal[0].style.display = "none";
        }
        if(event.target == modal[1]) {
            modal[1].style.display = "none";
        }
    }
    
</script>