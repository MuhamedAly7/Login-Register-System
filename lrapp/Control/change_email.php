<?php


session_start();
require_once '../Inc/connection.php';

// now we have email, password, and session
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
{
    if(isset($_POST['email'], $_POST['password']) && !empty($_POST['password']) && !empty($_POST['email']))
    {
        if(strlen($_POST['password']) >= 8 && strlen($_POST['password']) <= 32)
        {
            if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
            {
                $stat = $pdo->prepare('SELECT * FROM users WHERE username=:username');
                $stat->execute([':username' => $_SESSION['username']]);
                if($stat->rowCount())
                {
                    foreach($stat->fetchAll() as $value)
                    {
                        if(password_verify($_POST['password'], $value['password']))
                        {
                            $stat = $pdo->prepare('SELECT * FROM users WHERE email=:email');
                            $stat->execute([":email" => $_POST['email']]);

                            if($stat->rowCount())
                            {
                                echo 'This email is already taken, pick up another one';
                            }
                            else
                            {
                                $stat = $pdo->prepare('UPDATE users SET email=:email WHERE username=:username AND id=:id');
                                $stat->execute([
                                    ":email"    => $_POST['email'],
                                    ":username" => $_SESSION['username'],
                                    ":id"       => $_SESSION['id']
                                ]);
    
                                if($stat->rowCount())
                                {
                                    echo 'Email has been changed';
                                }
                                else
                                {
                                    
                                }
                            }
                        }
                        else
                        {
                            echo 'Password incorrect';
                        }
                    }
                }
            }
            else
            {
                echo 'Please provide us a valid email';
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