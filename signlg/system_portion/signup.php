<?php
include("./connection/include.php");
session_start();

function addUser($connect, $name, $gender, $address, $date_of_birth, $phone, $genda, $email, $password, $role)
{
  // Validate email format
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    return "Invalid email format.";
  }

  // Check if the role is selected
  if ($role == "None-user") {
    return "Please select a role.";
  }

  // Check if email already exists
  $checkEmailQuery = mysqli_query($connect, "SELECT * FROM `users` WHERE `email` = '$email'");
  if (mysqli_num_rows($checkEmailQuery) > 0) {
    return "Email already exists.";
  }

  // Check if password already exists (optional, depends on your application logic)
  // For example, you can check the password uniqueness if needed

  // Hash the password
  $hashedPassword = md5($password);

  // Insert user into database
  $insertQuery = mysqli_query($connect, "INSERT INTO `users` (`name`,`gender`,`address`,`date_of_birth`,`phone`,`genda`,`email`,`password`) VALUES ('$name','$gender','$address','$date_of_birth','$phone','$genda','$email', '$hashedPassword')");
  if ($insertQuery) {
    return "User added successfully.";
  } else {
    return "Failed to add user.";
  }
}

// Usage example
if (isset($_POST['add-function'])) {
  $name = $_POST['name'];
  $gender = $_POST['gender'];
  $address = $_POST['address'];
  $date_of_birth = $_POST['date_of_birth'];
  $phone = $_POST['phone'];
  $genda = $_POST['genda'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $role = $_POST['role']; // Assuming role is passed via POST

  $result = addUser($connect, $name, $gender, $address, $date_of_birth, $phone, $genda, $email, $password, $role);
  if (strpos($result, 'successfully') !== false) {
    $_SESSION['success_message'] = $result;
  } else {
    $_SESSION['error_message'] = $result;
  }
  header("Location: {$_SERVER['PHP_SELF']}");
  exit();
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
      <a href="../index.php" style="color:white">
        <h4 style="font-family:italic"><i class="fa fa-lg fa-fw fa-user"></i>
        USER REGISTRATION</h1>
      </a>
    </div>
    <div>
      <?php if (isset($_SESSION['success_message'])) : ?>
        <div class="alert alert-success" role="alert">
          <?php echo $_SESSION['success_message']; ?>
        </div>
        <?php unset($_SESSION['success_message']); ?>
      <?php endif; ?>

      <!-- Error message -->
      <?php if (isset($_SESSION['error_message'])) : ?>
        <div class="alert alert-danger" role="alert">
          <?php echo $_SESSION['error_message']; ?>
        </div>
        <?php unset($_SESSION['error_message']); ?>
      <?php endif; ?>
    </div>
    <div class="login-box" style="width: 900px;height: 600px;">
      <h3 class="login-head">
      </h3>
      <form class="login-form" action="" method="post">
        <div class="container">
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label class="control-label">FullName</label>
                <input class="form-control" name="name" type="text" required placeholder="" autofocus>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label class="control-label">Gender</label>
                <select type="text" name="gender" class="form-control" required placeholder="" autofocus>
                  <option value="">--Select-----Gender--------</option>
                  <option value="male">male</option>
                  <option value="female">female</option>
                </select>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label class="control-label">Address</label>
                <input class="form-control" name="address" type="text" required placeholder="" autofocus>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label class="control-label">Date of birth</label>
                <input class="form-control" name="date_of_birth" type="date" name="date_of_birth" required placeholder="">
              </div>
            </div>
          </div>


          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label class="control-label">Phone</label>
                <input class="form-control" name="phone" type="text" required placeholder="" autofocus>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label class="control-label">Nature</label>
                <select type="text" name="genda" class="form-control" required placeholder="" autofocus>
                  <option value="">--Select-----Nature--------</option>
                  <option value="deal">Deaf</option>
                  <option value="none-deal">not-Deaf</option>
                </select>
              </div>
            </div>
          </div>


          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label class="control-label">Email</label>
                <input class="form-control" type="email" name="email" required placeholder="" autofocus>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label class="control-label">PASSWORD</label>
                <input class="form-control" name="password" type="password" placeholder="" autofocus>
              </div>
            </div>
          </div>


          <div class="form-group">
            <div class="utility">
              <p class="semibold-text mb-2"><a href="./index.php">Sign in</a></p>
            </div>
          </div>
          <div class="form-group btn-container">
            <button type="submit" class="btn btn-primary btn-block" name="add-function" style="background-color:#094469"><i class="fa fa-sign-in fa-lg fa-fw"></i>SIGN UP</button>
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