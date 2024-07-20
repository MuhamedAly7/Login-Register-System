<?php
require_once '../Views/navbar.php'
?>
<form class="form-horizontal" action="../Control/nickname.php" method="POST">
    
    <!-- Form Name -->
    <!-- <legend>Form Name</legend> -->
    
    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="nickname">Nickname</label>  
      <div class="col-md-5">
      <input name="nickname" type="text" placeholder="Enter your nickname" class="form-control input-md" required="">
        
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
        <button id="submit" name="submit" class="btn btn-default">Update your name</button><br>
      </div>
    </div>
      
  </form>
      