<?php include('delserver.php'); ?>

<!DOCTYPE html>
<html>
<head>
  <title>user register</title>
  <link rel="stylesheet" type="text/css" href="delstyle.css">
</head>
<body>
    <div class="header1">
        <h2>Register</h2>
    </div>

  
    <form method="post" action="delregister.php">
       
     <!-- error messages -->
     <?php
      include('delerrors.php'); ?>
      <div class="formm">

       <div class="input-group3">
          <label>Username</label>
          <input type="text" name="username" value="<?php echo $username; ?>">
       </div>
       <div class="input-group3">
          <label>Password</label>
          <input type="password" name="password_1">
       </div>
       <div class="input-group3">
          <label>Confirm Password</label>
          <input type="password" name="password_2">
       </div>

       <div class="input-group3">
          <button type="submit" name="register" class="btn">Register</button>   
       </div>
       <p>
          Already a member? <a href="dellogin.php"> Sign in</a>
       </p>
    </div>
 </form>
          
</body>
</html>