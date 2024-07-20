<?php

require_once '../Inc/connection.php';
// require_once '../Views/navbar.php';

if(isset($_GET['email'],$_GET['reset_token']) && !empty($_GET['reset_token']) && !empty($_GET['email']))
{
    // check email and token
    $stat = $pdo->prepare('SELECT * FROM users WHERE email=:email AND reset_token=:reset_token');
    $stat->execute([
        ':email'       => $_GET['email'],
        ':reset_token' => $_GET['reset_token']
    ]);

    if($stat->rowCount())
    {
        ?>
        <form class="form-horizontal" action="" method="POST">
    
            <!-- Form Name -->
            <!-- <legend>Form Name</legend> -->
            
            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="password">New Password</label>
                <div class="col-md-5">
                    <input id="password" name="new_password" type="password" placeholder="Enter your password" class="form-control input-md" required="">
                    
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="username">Repeate Password</label>  
                <div class="col-md-5">
                    <input id="username" name="password_confirm" type="password" placeholder="Repeat your password" class="form-control input-md" required="">
                    
                </div>
            </div>
            
            <!-- Password input-->
            
            <!-- Button -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="submit">Login Button</label>
                <div class="col-md-4">
                    <button id="submit" name="submit" class="btn btn-default">Reset Password</button><br>
                </div>
            </div>
            
        </form>
      
        <?php
        if(isset($_POST['new_password'],$_POST['password_confirm']) && !empty($_POST['new_password']) && !empty($_POST['password_confirm']))
        {
            if($_POST['password_confirm'] === $_POST['new_password'])
            {
                $stat = $pdo->prepare('UPDATE users SET password=:password WHERE reset_token=:reset_token AND email=:email');
                $stat->execute([
                    ':password'    => password_hash($_POST['new_password'], PASSWORD_DEFAULT, ['cost' => 11]),
                    ':reset_token' => $_GET['reset_token'],
                    ':email'       => $_GET['email']
                ]);
                if($stat->rowCount())
                {
                    $stat = $pdo->prepare('UPDATE users SET reset_token=:reset_token WHERE email=:email');
                    $stat->execute([
                        'reset_token' => NULL,
                        'email'       => $_GET['email']
                    ]);
                    
                    if($stat->rowCount())
                    {
                        die('Password has been changed successfully!');
                    }
                    else
                    {

                    }
                }
                else
                {

                }
            }
            else
            {
                echo 'password does not match!!';
            }
        }
        else
        {
            echo 'Please fill up your form';
        }
    }
    else
    {
        die('Invalid Token');
    }
}