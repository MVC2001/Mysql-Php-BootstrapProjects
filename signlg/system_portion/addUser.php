<?php
include("./connection/include.php");
session_start();

function addUser($connect, $name, $gender, $address, $date_of_birth, $phone, $genda, $role, $email, $password)
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
    $insertQuery = mysqli_query($connect, "INSERT INTO `users` (`name`,`gender`,`address`,`date_of_birth`,`phone`,`genda`,`role`,`email`,`password`) VALUES ('$name','$gender','$address','$date_of_birth','$phone','$genda','$role','$email', '$hashedPassword')");
    if ($insertQuery) {
        return "User Account created  successfully.";
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
    $role = $_POST['role'];
    $email = $_POST['email'];
    $password = $_POST['password'];


    $result = addUser($connect, $name, $gender, $address, $date_of_birth, $phone, $genda, $role, $email, $password);
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
                    <h3 class="tile-title">Fill this form below to create user</h3>
                    <hr>
                    </hr>
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
                    <div class="tile-body">
                        <form class="row" style="margin-top: 50px;" action="" method="post">
                            <div class="form-group col-md-6">
                                <label class="control-label">Name</label>
                                <input class="form-control" name="name" type="text" placeholder="">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">Gender</label>
                                <select type="text" name="gender" class="form-control" required placeholder="" autofocus>
                                    <option value="">--Select-----Gender--------</option>
                                    <option value="male">male</option>
                                    <option value="female">female</option>
                                </select>
                            </div>


                            <div class="form-group col-md-6">
                                <label class="control-label">Address</label>
                                <input class="form-control" name="address" type="text" required placeholder="" autofocus>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="control-label">Date of birth</label>
                                <input class="form-control" name="date_of_birth" type="date" name="date_of_birth" required placeholder="">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="control-label">Phone</label>
                                <input class="form-control" name="phone" type="text" required placeholder="" autofocus>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">Nature</label>
                                <select type="text" name="genda" class="form-control" required placeholder="" autofocus>
                                    <option value="">--Select-----Nature--------</option>
                                    <option value="deal">Deaf</option>
                                    <option value="none-deal">not-deaf</option>
                                </select>
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
                                <input class="form-control" type="email" name="email" required placeholder="" autofocus>
                            </div>

                            <div class="form-group col-md-12">
                                <label class="control-label">Password</label>
                                <input class="form-control" name="password" type="password" placeholder="" autofocus>
                            </div>

                            <div class="form-group col-md-4 align-self-end">
                                <button class="btn btn text-white" type="text" name="add-function" style="background-color: #094469;"><i class="fa fa-fw fa-lg fa-check-circle"></i>Create</button>
                                <span> 
                                <button class="btn btn text-white" type="text" name="add-function" style="background-color: red;"><i class="fa fa-fw fa-lg fa-check-circle"></i>Cancel</button>
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