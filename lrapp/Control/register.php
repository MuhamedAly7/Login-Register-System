<?php

require_once '../Inc/connection.php';


if(isset($_POST['username'], $_POST['password'], $_POST['email'], $_POST['password_confirm']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];
    $email = $_POST['email'];

    if(preg_match('/^[a-z0-9-_. ]*$/i',$username))
    {
        if(strlen($password) >= 8 && strlen($password) <= 32)
        {
            if($password_confirm === $password)
            {
                if(filter_var($email, FILTER_VALIDATE_EMAIL))
                {
                    $stat = $pdo->prepare('INSERT INTO users (`username`, `password`, `email`) VALUES (?,?,?)');
                    $stat->execute([
                            $username,
                            password_hash($password, PASSWORD_DEFAULT, ['cost' => 11]),
                            $email
                    ]);

                    if($stat->rowCount())
                    {
                        echo 'Thanks for registering, Please go to activate your account';
                    }
                }
                else
                {
                    echo 'Please provide a valid email';
                }
            }
            else
            {
                echo 'Password confirmation does not match!!';

            }
        }
        else
        {
            echo 'Please provide a valid password';
        }
    }
    else
    {
        echo 'Please provide a valid username';
    }
}

?>