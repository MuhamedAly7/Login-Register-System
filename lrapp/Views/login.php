<?php
  require_once '../Views/navbar.php';
  // session_start();
  if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true)
  {
    header('refresh:0.5;url=../Views/navbar.php');
  }
?>

<form class="form-horizontal" action="../Control/login.php" method="POST">
    
  <!-- Text input-->
  <div class="form-group">
    <label class="col-md-4 control-label" for="username">Username</label>  
    <div class="col-md-5">
    <input id="username" name="username" type="text" placeholder="Enter your username" class="form-control input-md" required="">
      
    </div>
  </div>
  
  <!-- Password input-->
  <div class="form-group">
    <label class="col-md-4 control-label" for="password">Password</label>
    <div class="col-md-5">
      <input id="password" name="password" type="password" placeholder="Enter your password" class="form-control input-md" required="">
      
    </div>
  </div>
  
  <!-- Button -->
  <div class="form-group">
    <label class="col-md-4 control-label" for="submit">Login Button</label>
    <div class="col-md-4">
      <button id="submit" name="submit" class="btn btn-default">Login</button><br>
      <small><a href="./password_reset.php">Forget Password?</a></small>
    </div>
  </div>
    
</form>
    