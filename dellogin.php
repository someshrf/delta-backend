<?php include('delserver.php'); ?>
<!DOCTYPE html>
<html>
<head>
  <title>user login</title>
  <link rel="stylesheet" type="text/css" href="delstyle.css">
</head>
<body>
    <div class="header1">
        <h2>Login</h2>
    </div>

    <form method="post" action="dellogin.php">
         <!-- error messages -->
       <?php include('delerrors.php'); ?>
       
       <div class="formm">

       <div class="input-group3">
          <label>Username</label>
          <input type="text" name="username">
       </div>
       <div class="input-group3">
          <label>Password</label>
          <input type="password" name="password">
       </div>
       <div class="input-group3">
          <button type="submit" name="login" class="btn">Login</button>   
       </div>
       <p>
          Not yet a member? <a href="delregister.php"> Sign up</a>
       </p>
    </div>

    </form>

</body>
<html>