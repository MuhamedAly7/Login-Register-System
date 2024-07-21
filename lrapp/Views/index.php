
<?php
require_once './navbar.php';

if(!isset($_SESSION['loggedin']) && empty($_SESSION['loggedin']))
{
    header('refresh:0.5; url=login.php');
}
?>

<div class="container">
    <div class="row">
        
        <?php
        if(isset($_SESSION['error']) && !empty($_SESSION['error']))
        {
            ?>
            <div class="alert alert-danger">
                <?=$_SESSION['error'];?>
            </div>
            <?php
            unset($_SESSION['error']);
        }
        elseif(isset($_SESSION['successful']) && !empty($_SESSION['successful']))
        {
            ?>
            <div class="alert alert-success">
                <?=$_SESSION['successful'];?>
            </div>
            <?php
            unset($_SESSION['successful']);
        }
        if(count($_SESSION['posts']) > 0)
        {
            ?>
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Body</th>
                    <th>status</th>
                    <th>Edit Post</th>
                    <th>Delete Post</th>
                </tr>
            <?php
            foreach($_SESSION['posts'] as $value)
            {
                ?>
                <tr>
                    <td><?= $value['id']; ?></td>
                    <td><?= $value['title'] ?></td>
                    <td><?= $value['body']?></td>
                    <td><?= ($value['approved'] === 0) ? 'Not Approved Yet!!' : 'Approved' ?></td>
                    <td><a href="../Control/edit.php?id=<?=$value['id'];?>" class="btn btn-primary">Edit Post</a></td>
                    <td><form action="../Control/delete.php" method="POST">
                        <input type="hidden" value="<?=$value['id'];?>" name="id">
                        <input type="submit" name="delete" value="Delete Post" class="btn btn-danger">
                    </form></td>
                </tr>
                <?php
            }
            ?>
            </table>
            <?php
        }
        else
        {
            echo 'No posts to view';
        }
        ?>
    </div>
</div>
