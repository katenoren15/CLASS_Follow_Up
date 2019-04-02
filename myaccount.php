<?php 
include ('includes/header.php');
?>


<div class="col-sm-6" id="details">
            <h1>My Account</h1>
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
                        <td><?php echo $row["surname"]?></td>
                    </tr>
                </table>
            </div>
            <h3>Account Settings</h3>
            <div class="table-responsive">
                <table class="account">
                    <tr>
                        <td>Username:</td>
                        <td><?php echo $row["username"]?></td>
                        <td><button class="button btn btn-default" data-modal="muser">Edit</button></td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td><?php echo preg_replace("/./", "*", $row["passw"])?></td>
                        <td><button class="button btn btn-default" data-modal="mpass">Change</button></td>
                    </tr>
                </table>
            </div>
            <?php include ('includes/footer.php')?> 