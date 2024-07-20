<?php

session_start();
require_once '../Inc/connection.php';

if(isset($_POST['username'], $_POST['password']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    

    if(preg_match('/^[a-z0-9-_. ]*$/i',$username))
    {
        if(strlen($password) >= 8 && strlen($password) <= 32)
        {
           $stat = $pdo->prepare('SELECT * FROM users WHERE username=:username OR email=:email');
           $stat->execute([':username' => $username, ':email' => $username]);
           
           if($stat->rowCount())
           {
                $stat = $pdo->prepare('SELECT * FROM users WHERE (username=:username OR email=:email) AND activated = 1');
                $stat->execute([':username' => $username, ':email' => $username]);
                if($stat->rowCount())
                {
                    foreach($stat->fetchAll() as $value)
                    {
                        // print_r($value);
                        if(password_verify($password, $value['password']))
                        {
                            echo 'Welcome User';
                            $_SESSION['loggedin'] = true;
                            $_SESSION['username'] = $value['username'];
                            $_SESSION['email']    = $value['email'];
                            $_SESSION['id']       = $value['id'];
                            $stat = $pdo->prepare('UPDATE users SET last_login=:last_login WHERE username=:username');
                            $stat->execute([
                                ':last_login' => date('Y-m-d H:i'),
                                ':username'   => $_SESSION['username']
                            ]);
                            
                        }
                        else
                        {
                            echo 'username/email or password incorrect';
                        }
                    }
                }
                else
                {
                    echo 'User is not activated';
                }
            }
            else
            {
                echo 'username/email not exists';
            }
        }
        else
        {
            echo 'Please Enter a valid password';
        }
    }
    else
    {
        echo 'Please provide a valid username';
    }
}
