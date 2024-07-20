<?php

require_once './navbar.php';

if(!isset($_SESSION['loggedin']) && empty($_SESSION['loggedin']))
{
    header('refresh:0.5; url=login.php');
}

?>

<div class="container">
    <?php
    if(isset($_SESSION['error']) && !empty($_SESSION['error']))
    {
        ?>
        <div class="alert alert-danger">
            <?= $_SESSION['error'] ?>
        </div>
        <?php
        unset($_SESSION['error']);
    }
    elseif(isset($_SESSION['successful']) && !empty($_SESSION['successful']))
    {
        ?>
        <div class="alert alert-success">
            <?= $_SESSION['successful']; ?>
        </div>
        <?php
        unset($_SESSION['successful']);
    }
    ?>
    <form action="../Control/create.php" method="POST" autocomplete="off">   
        <div class="form-group">
            <label for="title">Post Title : </label>
            <input type="text" name="title" placeholder="Enter a title" class="form-control">
        </div>
        <div class="form-group">
            <label for="body">Post Body : </label>
            <textarea class="form-control" name="body" style="width:100%; height:100%" placeholder="Enter the post body"></textarea>
        </div>
        <div class="form-group">
            <input type="submit" name="submit" value="Create Post" class="form-control">
        </div>

    </form>
</div>
