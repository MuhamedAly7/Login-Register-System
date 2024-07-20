<?php

session_start();
require_once '../Inc/connection.php';

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true)
{
    if(isset($_POST['password'],$_POST['submit']) && !empty($_POST['nickname']) && !empty($_POST['password']))
    {
        if(preg_match('/^[a-z\s]*$/i', $_POST['nickname']))
        {
            if(strlen($_POST['password']) >= 8 && strlen($_POST['password']) <= 32)
            {
                $stat = $pdo->prepare('SELECT * FROM users WHERE email=:email');
                $stat->execute([
                    ':email' => $_SESSION['email']
                ]);

                if($stat->rowCount())
                {
                    foreach($stat->fetchAll() as $value)
                    {
                        if(password_verify($_POST['password'], $value['password']))
                        {
                            $stat = $pdo->prepare('UPDATE users SET nickname=:nickname WHERE email=:email');
                            $stat->execute([
                                ':nickname' => $_POST['nickname'],
                                ':email'    => $_SESSION['email']
                            ]);

                            if($stat->rowCount())
                            {
                                echo 'Hello ' . $_POST['nickname'];
                            }
                            else
                            {

                            }
                        }
                        else
                        {
                            echo 'Incorrect Password';
                        }
                    }
                }
                else
                {
                    echo 'Invalid Email';
                }
            }
            else
            {
                echo 'Please provide us a valid password';
            }
        }
        else
        {
            echo 'Letters and white spaces are only allowed';
        }
    }
    else
    {
        echo 'Please Enter nickname and password!';
    }
}
else
{
    die('You have to login');
}