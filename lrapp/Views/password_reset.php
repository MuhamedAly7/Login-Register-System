<?php
  require_once '../Views/navbar.php';
  // session_start();
  if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true)
  {
    header('refresh:0.5;url=../Views/navbar.php');
  }
?>
<form class="form-horizontal" action="../Control/password_reset.php" method="POST">
    
    <!-- Form Name -->
    <!-- <legend>Form Name</legend> -->
    
    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="email">email</label>  
      <div class="col-md-5">
      <input id="email" name="email" type="text" placeholder="Enter your email" class="form-control input-md" required="">
        
      </div>
    </div>
    
    
    <!-- Button -->
    <div class="form-group">
      <div class="col-md-9 col-md-offset-4">
        <button id="submit" name="submit" class="btn btn-default">Generate Password</button>
      </div>
    </div>
    
    </form>
    