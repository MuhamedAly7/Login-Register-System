<?php

require_once '../Inc/connection.php';
session_start();

if(isset($_POST['submit'], $_POST['body'], $_POST['title']) && !empty($_POST['title']) && !empty($_POST['body']) && !empty($_POST['submit']))
{
    if(ctype_alpha($_POST['title']))
    {
        if(preg_match('/^[a-z0-9-_. ]*$/i',$_POST['body']))
        {
            $stat = $pdo->prepare('INSERT INTO posts (`user_id`,`username`,`title`,`body`) VALUES(:user_id,:username,:title,:body)');
            $stat->execute([
                ':user_id'  => $_SESSION['id'],
                ':username' => $_SESSION['username'],
                ':title'    => $_POST['title'],
                ':body'     => $_POST['body']
            ]);

            if($stat->rowCount())
            {
                $_SESSION['successful'] = 'Post has been added successfully';
                header('refresh:0.2; url=../Views/create.php');
            }
            else
            {

            }

        }
        else
        {
            $_SESSION['error'] = 'Body should only contain of letters, whitespaces and -_. characters';
            header('refresh:0.2; url = ../Views/create.php');   
        }
    }
    else
    {
        $_SESSION['error'] = 'title field should only contain of letters';
        header('refresh:0.2; url = ../Views/create.php');
    }
}
else
{
    $_SESSION['error'] = 'Body and title field are required';
    header('refresh:0.2; url = ../Views/create.php');
}