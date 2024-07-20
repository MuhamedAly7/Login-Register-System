<?php


session_start();
require_once '../Inc/connection.php';

// now we have email, password, and session
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
{
    if(isset($_POST['current_password'], $_POST['new_password'], $_POST['new_password_confirm']) && !empty($_POST['current_password']) && !empty($_POST['new_password']) && !empty($_POST['new_password_confirm']))
    {
        // We have to take strong password from user like must have (one upper case, one lower case, one special character, 8 chars minimum and 32 chars maximum, numeric values, repeatitive characters)
        if(strlen($_POST['current_password']) >= 8 && strlen($_POST['current_password']) <= 32)
        {
            if(strlen($_POST['new_password']) >= 8 && strlen($_POST['new_password']) <= 32)
            {
                if($_POST['new_password'] === $_POST['new_password_confirm'])
                {
                    $stat = $pdo->prepare('SELECT * FROM users WHERE username=:username OR email=:email');
                    $stat->execute([
                        ':username' => $_SESSION['username'],
                        ':email'    => $_SESSION['email']
                    ]);

                    if($stat->rowCount())
                    {
                        foreach($stat->fetchAll() as $value)
                        {
                            if(password_verify($_POST['current_password'], $value['password']))
                            {
                                $stat = $pdo->prepare('UPDATE users SET password=:password WHERE username=:username');
                                $stat->execute([
                                    ':password' => password_hash($_POST['new_password'], PASSWORD_DEFAULT),
                                    ':username' => $_SESSION['username']
                                ]);
                                if($stat->rowCount())
                                {
                                    echo 'Password has been changed';
                                }
                                else
                                {
                                    echo 'An error has occured';
                                }
                            }
                            else
                            {
                                echo 'Incorrect password';
                            }
                        }
                    }
                }
                else
                {
                    echo 'Privided new passwords does not match!!';
                }
            }
        }
        else
        {
            echo 'Your password is weak';
        }
    }
    else
    {
        echo 'Please fill up your form';
    }
}
else
{
    die('You have to loggedin');
}