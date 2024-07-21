
<?php
require_once '../Views/navbar.php';

if(!isset($_SESSION['loggedin']))
{
    header('refresh:0;url=login.php');
}
if(isset($_SESSION['post']) && count($_SESSION['post']) > 0)
{
    ?>
    <form class="form-horizontal" action="../Control/edit.php" method="POST">
    
        <!-- Text input-->
        <div class="form-group">
        <label class="col-md-4 control-label" for="title">Title</label>  
        <div class="col-md-5">
        <input name="title" type="text" placeholder="Edit title" class="form-control input-md" required="" value="<?=$_SESSION['post']['title'];?>">
            
        </div>
        </div>
    
        <!-- Text Area -->
        <div class="form-group">
        <label class="col-md-4 control-label" for="title">Body</label>  
        <div class="col-md-5">
        <textarea name="body" placeholder="Edit body" class="form-control input-md" required=""><?=$_SESSION['post']['body'];?></textarea>
            
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
        <label class="col-md-4 control-label" for="submit"></label>
        <div class="col-md-4">
            <input type="hidden" name="id" value="<?=$_SESSION['post']['id'];?>">
            <button id="submit" name="submit" class="btn btn-default">Edit Post</button><br>
            <!-- <small><a href="./password_reset.php">Forget Password?</a></small> -->
        </div>
        </div>
      
  </form>
<?php
unset($_SESSION['post']);
}
else
{
    $_SESSION['error'] = 'You are not authorized to view this page through url';
    header('refresh:0;url=../Views/index.php');   
}
?>


    