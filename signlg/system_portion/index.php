<?php
session_start();
include './connection/include.php';

$errorMessage = ''; // Initialize error message variable

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $query = mysqli_query($connect, "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'") or die(mysqli_connect_error());
    $fetch = mysqli_fetch_array($query);
    $row = mysqli_num_rows($query);

    if ($row > 0) {
        $_SESSION['user_id'] = $fetch['user_id'];
        $_SESSION['role'] = $fetch['role'];
        $role = $fetch['role'];

        if ($role == 'administrator') {
            echo "<script>window.location='dashboard.php'</script>";
        } else if ($role == 'normal_user') {
            echo "<script>window.location='all-lists.php'</script>";
        } 
    } else {
        $errorMessage = "Wrong! invalid username or password";
    }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Login - Vali Admin</title>
  </head>
  <body>
    <section class="material-half-bg">
      <div class="cover" style="background-color:#094469"></div>
    </section>
    <section class="login-content">
      <div class="logo">
        <a href="../index.php" style="color:white"><h1></h1></a>
      </div>
      <div>
        <?php if (!empty($errorMessage)) { ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?php echo $errorMessage; ?>
                                    </div>
                   <?php } ?>
      </div>
      <div class="login-box" style="height:400px">
        <form class="login-form" action="" method="post">
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user" style="color:#094469"></i>SIGN IN</h3>
          <div class="form-group">
            <label class="control-label">EMAIL</label>
            <input class="form-control" type="text" name="email" required placeholder="Email" autofocus>
          </div>
          <div class="form-group">
            <label class="control-label">PASSWORD</label>
            <input class="form-control" type="password" name="password" required placeholder="Password">
          </div>
          <div class="form-group">
            <div class="utility">
              <p class="semibold-text mb-2"><a href="signup.php" style="color:#094469">Sign up</a></p>
              <span><p class="semibold-text mb-2"><a href="../index.php" style="color:#094469">Back home</a></p></span>
            </div>
          </div>
          <div class="form-group btn-container">
            <button type="submit" name="login" class="btn btn-primary btn-block" style="background-color:#094469"><i class="fa fa-sign-in fa-lg fa-fw"></i>SIGN IN</button>
          </div>
        </form>
      </div>
    </section>
    <!-- Essential javascripts for application to work-->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="js/plugins/pace.min.js"></script>
    <script type="text/javascript">
      // Login Page Flipbox control
      $('.login-content [data-toggle="flip"]').click(function() {
        $('.login-box').toggleClass('flipped');
        return false;
      });
    </script>
  </body>
</html>
