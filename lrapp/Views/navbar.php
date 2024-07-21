<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
</head>
<body>
  <nav class="navbar navbar-default" role="navigation">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <?php
            session_start();
            if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true)
            {
                if(isset($_SESSION['nickname']) && !empty($_SESSION['nickname']))
                {
                    echo $_SESSION['nickname'];
                }
            }
            else
            {
                echo 'Hello Guest';
            }
            ?>
            <b class="caret"></b>
          </a>
          <ul class="dropdown-menu">
            <?php
                if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true)
                {

                    switch($_SESSION['privil'])
                    {
                        case $_SESSION['privil'] === 0:
                            ?>
                            <li><a href="../Views/create.php">Create A Post</a></li>
                            <?php
                            break;
                        case $_SESSION['privil'] === 1:
                            ?>
                            <li><a href="../Views/create.php">Create A Post</a></li>
                            <li><a href="../Control/index.php">List Newest Posts</a></li>
                            <?php
                            break;
                        default:
    
                            break;
                    }
                    ?>
                    <li class="divider"></li>
                    <li><a href="../Views/change_password.php">Change Your Password</a></li>
                    <li><a href="../Views/change_email.php">Change Your Email</a></li>
                    <li><a href="../Views/nickname.php">Update Your Nickname</a></li>
                    <li><a href="../Views/logout.php">Logout</a></li>
                    <?php
                }
                else
                {
                    ?>
                    <li><a href="../Views/login.php">Login</a></li>
                    <li><a href="../Views/register.php">Register</a></li>
                    <?php
                }
            ?>
            
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</body>
</html>
