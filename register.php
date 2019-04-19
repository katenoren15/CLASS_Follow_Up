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
        padding-top: 50px;
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
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <div class="well well-lg">
            <h1 class="text-center">Create an Account</h1>
            <form  method="post" action="db-login-register.php">
                <h3 class="text-center">Personal Information</h3>
                <br>
                <div class="form-group">
                    <label for="firstname">First Name</label><br>
                    <input class="form-control" type="text" name="firstname" required >
                </div>
                <div class="form-group">
                    <label for="lastname">Last name</label><br>
                    <input class="form-control" type="text" name="lastname" required >
                </div>
                <hr>
                <h3 class="text-center">Account Credentials</h3>
                <div class="form-group">
                    <label for="userlevel">User Level: </label>
                    <label class="radio-inline"><input type="radio" value="Administrator" name="userlevel"/>Administrator</label>
                    <label class="radio-inline"><input type="radio" value="User" name="userlevel"/>User</label>
                </div>
                <div class="form-group">
                <label for="firstname">Username:</label><input class="form-control " type="text" required  name="username"/>
                </div>
                <div class="form-group">
                <label for="password">Password:</label><input class="form-control" type="password" required name="password">
                </div>
                <input class="register" type="hidden" name="form" value="Register"> <br>
                <a href="login.php"><input class="btn text-center btn-default" value="Back"></a> 
                <input class="btn text-center btn-default" type="submit" value="Register"> 
            </form>
    </div>
            <br>
        </div>
        <div class="col-sm-3"></div>
    </div>
</div>
