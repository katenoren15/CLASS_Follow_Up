<?php
    include ('includes/header.php'); 
    require_once ('includes/dbconnect.php');
    $connection = db_connect();
    session_start();
    $userid = $_SESSION["user"];

?>


<div class="row">
    <div class="col-sm-12">
        <br>
        <div class="well well-lg"> 
            <h1>Backup and Restore</h1> 
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <br>
        <h2>Backup</h2>
        <p>To backup the database, press the backup button and an sql will automatically be downloaded onto your computer.</p>
        <form action="functions.php" method="post">
            <input type="submit" name="backup" value="Backup" class="btn btn-primary"/>
        </form>
    </div>
    <div class="col-sm-6">
        <br>
        <h2>Restore</h2>
        <p>To restore the database, <br> 1- select the <b>.sql</b> file obtained from backing up the database, <br> 2- Create a database in phpMyAdmin and enter the name of the database in the which the file will be restored and <br> 3- press the restore button. </p>
        <form enctype="multipart/form-data" action="functions.php" method="post">
            <div class="form-group">
                <input type="file" class="form-control" name="backup_file" id="backup_file"/>
            </div>
            <input type="submit" name="restore" value="Restore" class="btn btn-primary"/>
        </form>
    </div>
</div>


<br>


<?php
include ('includes/footer.php'); 


?>