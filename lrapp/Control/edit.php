<?php

session_start();
require_once '../Inc/connection.php';

if(count($_GET) > 0) // we did not isset here because it is return true even if my array is empty
{
    if(isset($_GET['id']) && !empty($_GET['id']))
    {
        if(preg_match('/^[0-9]*$/',$_GET['id']))
        {
            $stat = $pdo->prepare('SELECT * FROM posts WHERE id=:id');
            $stat->execute([
                ':id' => $_GET['id']
            ]);
            
            if($stat->rowCount())
            {
                foreach($stat->fetchAll() as $value)
                {
                    if($_SESSION['id'] === $value['user_id'])
                    {
                        $_SESSION['post'] = $value;
                        header('refresh:0;url=../Views/edit.php');
                    }
                    else
                    {
                        $_SESSION['error'] = 'You are not authorized to edit this post';
                        header('refresh:0;url=../Views/index.php');            
                    }
                }
            }
        }
        else
        {
            $_SESSION['error'] = 'Post id should only contain of numbers!';
            header('refresh:0;url=../Views/index.php');
        }
    }
    else
    {
        $_SESSION['error'] = 'Post id can not be empty!';
        header('refresh:0;url=../Views/index.php');
    }
}
elseif(count($_POST) > 0)
{
    $stat = $pdo->prepare('SELECT * FROM users WHERE username=:username');
    $stat->execute([
        ':username' => $_SESSION['username']
    ]);
    if($stat->rowCount())
    {
        foreach ($stat->fetchAll() as $value) 
        {
            if(password_verify($_POST['password'], $value['password']))
            {
                try
                {
                    $pdo->beginTransaction();
                    $stat = $pdo->prepare('SELECT * FROM posts WHERE id=:id');
                    $stat->execute([
                        ':id' => $_POST['id']
                    ]);
            
                    if($stat->rowCount())
                    {
                        // print_r($stat->fetchAll());
                        $stat = $pdo->prepare('UPDATE posts SET user_id=:user_id, username=:username, title=:title, updated_at=:updated_at, body=:body WHERE id=:id');
                        $stat->execute([
                            ':user_id'    => $_SESSION['id'],
                            'username'    => $_SESSION['username'],
                            ':title'      => $_POST['title'],
                            ':updated_at' => date('Y-m-d H:i'),
                            ':body'       => $_POST['body'],
                            ':id'         => $_POST['id']
                        ]);
            
                        if($stat->rowCount())
                        {
                            $_SESSION['successful'] = 'Post has beed updated successfully!';
                            header('refresh:0;url=../Views/index.php');
                        }
                    }
                    $pdo->commit();
                }
                catch(PDOException $e)
                {
                    $pdo->rollBack();
                    $_SESSION['error'] = 'Post title already exists';
                    header('refresh:0;url=../Views/index.php');
                }
            }
            else
            {
                $_SESSION['error'] = 'Password is incorrect';
                header('refresh:0;url=../Views/index.php');
            }
        }
    }
    
}

