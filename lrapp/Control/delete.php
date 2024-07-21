<?php

session_start();

require_once '../Inc/connection.php';

if(isset($_POST['id'], $_POST['delete']) && !empty($_POST['id']) && !empty($_POST['delete']))
{
    if(preg_match('/^[0-9]*$/',$_POST['id']))
    {
        $stat = $pdo->prepare('SELECT * FROM posts WHERE id=:id');
        $stat->execute([
            ':id' => $_POST['id'];
        ]);

        if($stat->rowCount())
        {
            foreach ($stat->fetchAll() as $value) 
            {
                if($value['user_id'] === $_SESSION['id'])
                {
                    $stat = $pdo->prepare('DELETE * FROM posts WHERE id=:id');
                    
                    $stat->execute([
                        ':id' => $_POST['id'];
                    ]);

                    if($stat->rowCount())
                    {
                        $_SESSION['successful'] = 'Post has been deleted successfully!';
                        header('refresh:0;url=index.php');
                    }
                }   
                else
                {
                    $_SESSION['error'] = 'You are not authorized to delete this post!';
                    header('refresh:0;url=../Views/index.php');
                } 
            }
        }
        else
        {
            $_SESSION['error'] = 'Post does not exists!';
            header('refresh:0;url=../Views/index.php');
        }
    }
    else
    {

    }
}
else
{

}