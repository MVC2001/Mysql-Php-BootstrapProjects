<?php
include("./connection/include.php");
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'administrator') {
  header('location:index.php');
  exit; // Ensure script execution stops after redirection
}

function updateUser($connect, $name, $gender, $address, $date_of_birth, $phone, $genda, $role, $email)
{


  // Update user in the database
  $updateQuery = mysqli_query($connect, "UPDATE `users` SET `name`='$name',`gender`='$gender',`address`='$address',`date_of_birth`='$date_of_birth',`phone`='$phone',`genda`='$genda',`role`='$role',`email`='$email' WHERE `email`='$email'");
  if ($updateQuery) {
    return "User Account updated successfully.";
  } else {
    return "Failed to update user.";
  }
}

// Usage example
if (isset($_POST['update-function'])) {
  $name = $_POST['name'];
  $gender = $_POST['gender'];
  $address = $_POST['address'];
  $date_of_birth = $_POST['date_of_birth'];
  $phone = $_POST['phone'];
  $genda = $_POST['genda'];
  $role = $_POST['role'];
  $email = $_POST['email'];


  $result = updateUser($connect, $name, $gender, $address, $date_of_birth, $phone, $genda, $role, $email);
  if (strpos($result, 'successfully') !== false) {
    $_SESSION['success_message'] = $result;
  } else {
    $_SESSION['error_message'] = $result;
  }
  header("Location: users.php");
  exit();
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
  <!-- Twitter meta-->
  <meta property="twitter:card" content="summary_large_image">
  <meta property="twitter:site" content="@pratikborsadiya">
  <meta property="twitter:creator" content="@pratikborsadiya">
  <!-- Open Graph Meta-->
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="Vali Admin">
  <meta property="og:title" content="Vali - Free Bootstrap 4 admin theme">
  <meta property="og:url" content="http://pratikborsadiya.in/blog/vali-admin">
  <meta property="og:image" content="http://pratikborsadiya.in/blog/vali-admin/hero-social.png">
  <meta property="og:description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
  <title>Form Samples - Vali Admin</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Main CSS-->
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <!-- Font-icon css-->
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body class="app sidebar-mini rtl">
  <!-- Navbar-->
  <header class="app-header" style="background-color: #094469;">
    <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
  </header>
  <!-- Sidebar menu-->
  <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
  <aside class="app-sidebar" style="background-color: #094469;">

    <ul class="app-menu">
      <li><a class="app-menu__item active" style="background-color: #094469;" href="./dashboard.php"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a>
      </li>
      <hr>


      <li class="treeview" style="background-color: #094469;"> <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label">Menu</span><i class="treeview-indicator fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
          <li><a class="treeview-item" href="passwordResert.php"><i class="icon fa fa-circle-o"></i>Resert_password</a></li>
          <li><a class="treeview-item" href="users.php"><i class="icon fa fa-circle-o"></i> Users</a></li>
          <li><a class="treeview-item" href="roles.php"><i class="icon fa fa-circle-o"></i> Roles</a></li>
          <li><a class="treeview-item" href="./viewVideo.php"><i class="icon fa fa-circle-o"></i> Videos</a>
          </li>
          <li><a class="treeview-item" href="./allSymbols.php"><i class="icon fa fa-circle-o"></i> Symbols</a>
          </li>
          <li><a class="treeview-item" href="./all_greetings.php"><i class="icon fa fa-circle-o"></i>
              Alphabet</a></li>

          <li><a class="treeview-item" href="../fontpage/viewmessage.php"><i class="icon fa fa-circle-o"></i>
              Message</a></li>
        </ul>
      </li>

    </ul>
  </aside>
  <main class="app-content">
    <div class="app-title">

      <div class="clearix"></div>
      <div class="col-md-12">
        <div class="tile">
          <h3 class="tile-title">Update User</h3>
          <hr>
          </hr>
          <div class="tile-body">
            <form class="row" style="margin-top: 50px;" action="" method="post">

              <?php
              $select_user = "select * from users where user_id = '" . $_GET['user_id'] . "'";
              $result = mysqli_query($connect, $select_user);
              if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) { ?>
                  <div class="form-group col-md-6">
                    <label class="control-label">Name</label>
                    <input class="form-control" name="name" value="<?php echo $row['name']; ?>" type="text" placeholder="">
                  </div>
                  <div class="form-group col-md-6">
                    <label class="control-label">Gender</label>
                    <input class="form-control" type="text" name="gender" value="<?php echo $row['gender']; ?>" required placeholder="" autofocus>
                  </div>


                  <div class="form-group col-md-6">
                    <label class="control-label">Address</label>
                    <input class="form-control" name="address" value="<?php echo $row['address']; ?>" type="text" required placeholder="" autofocus>
                  </div>

                  <div class="form-group col-md-6">
                    <label class="control-label">Date of birth</label>
                    <input class="form-control" name="date_of_birth" type="date" name="date_of_birth" value="<?php echo $row['date_of_birth']; ?>" required placeholder="">
                  </div>

                  <div class="form-group col-md-6">
                    <label class="control-label">Phone</label>
                    <input class="form-control" name="phone" value="<?php echo $row['phone']; ?>" type="text" required placeholder="" autofocus>
                  </div>
                  <div class="form-group col-md-6">
                    <label class="control-label">Nature</label>
                    <input class="form-control" type="text" name="genda" value="<?php echo $row['genda']; ?>" required placeholder="" autofocus>
                  </div>

                  <div class="form-group col-md-12">
                    <label class="control-label">Role</label>
                    <select type="text" name="role" class="form-control" required placeholder="" autofocus>
                      <option value="">--Select-----role-------</option>
                      <option value="guest">Guest</option>
                      <option value="normal_user">Normal User</option>
                      <option value="administrator"> System Administrator</option>
                    </select>
                  </div>

                  <div class="form-group col-md-12">
                    <label class="control-label">Email</label>
                    <input class="form-control" type="email" name="email" value="<?php echo $row['email']; ?>" value="<?php echo $row['email']; ?>" required placeholder="" autofocus>
                  </div>

              <?php }
              } ?>

              <div class="form-group col-md-4 align-self-end">
                <button class="btn btn text-white" type="text" name="update-function" style="background-color: #094469;"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update</button>
                <span>
                <button class="btn btn text-white" type="text" name="update-function" style="background-color: red;"><i class="fa fa-fw fa-lg fa-check-circle"></i>Delete</button>
                </span>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </main>
  <!-- Essential javascripts for application to work-->
  <script src="js/jquery-3.2.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
  <!-- The javascript plugin to display page loading on top-->
  <script src="js/plugins/pace.min.js"></script>
  <!-- Page specific javascripts-->
  <!-- Google analytics script-->
  <script type="text/javascript">
    if (document.location.hostname == 'pratikborsadiya.in') {
      (function(i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function() {
          (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
          m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
      })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
      ga('create', 'UA-72504830-1', 'auto');
      ga('send', 'pageview');
    }
  </script>
</body>

</html>