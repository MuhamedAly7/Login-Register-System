<?php

/**
 * 1- password_reset.html
 *  form(action => password_reset.php)
 *  email_address
 * 
 * 2- password_reset.php
 *  check email exists or not ?
 *  if yes create token , hash . hash
 *  link (password_recovery.php?email, token)
 *  email()
 * 
 * 3- password_recovery.php
 *  check email, token
 *  email, token select database 
 *  update password , email, token
 *  delete token  
 * 
 * 
*/

require_once '../Inc/connection.php';

// check if user is logged in

if(isset($_POST['email'], $_POST['submit']) && !empty($_POST['email']))
{
    if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
    {
        $stat = $pdo->prepare('SELECT * FROM users WHERE email=:email');
        $stat->execute([
            ':email' => $_POST['email']
        ]);
        if($stat->rowCount())
        {
            // Update token , generate link
            $stat = $pdo->prepare('UPDATE users SET reset_token=:reset_token WHERE email=:email');
            $stat->execute([
                ':email' => $_POST['email'],
                ':reset_token' => sha1(uniqid('',true)) . sha1(date('Y-m-d H:i'))
            ]);
            if($stat->rowCount())
            {
                $stat = $pdo->prepare('SELECT email,reset_token FROM users WHERE email=:email');
                $stat->execute([
                    ':email' => $_POST['email']
                ]);
                if($stat->rowCount())
                {
                    foreach($stat->fetchAll() as $value)
                    {
                        ?>
                        <a href="password_recovery.php?email=<?=$value['email'];?>&reset_token=<?=$value['reset_token'];?>">Click here to reset your password</a>
                        <?php
                    }
                }
            }
        }
        else
        {
            echo 'Email does not exists!';
        }
    }
    else
    {
        echo 'Please provide us a valid email';
    }
}
else
{
    echo 'Please fill up your form';
}