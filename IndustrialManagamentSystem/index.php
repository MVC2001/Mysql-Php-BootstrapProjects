<?php
session_start();
include './connection/include.php';

$errorMessage = ''; // Initialize error message variable

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    // Disable the login button
    echo '<script>document.getElementById("loginBtn").disabled = true;</script>';

    $query = mysqli_query($connect, "SELECT * FROM `user` WHERE `email` = '$email' AND `password` = '$password'") or die(mysqli_connect_error());
    $fetch = mysqli_fetch_array($query);
    $row = mysqli_num_rows($query);

    if ($row > 0) {
        $_SESSION['user_id'] = $fetch['user_id'];
        $_SESSION['role'] = $fetch['role'];
        $role = $fetch['role'];
      

        // Redirect based on role
        $redirectUrl = '';
        switch ($role) {
            case 'admin':
                $redirectUrl = 'dashboard.php';
                break;
            case 'IndustrialField_coordinator':
                $redirectUrl = 'IndustrialField_coordinator.php';
                break;
            case 'IndustrialField_trainer':
                $redirectUrl = 'IndustrialField_trainer.php';
                break;
                  case 'supervisor':
                $redirectUrl = 'supervisor.php';
                break;

            case 'student':
                $redirectUrl = 'studentPorto.php';
                break;
            default:
                $redirectUrl = 'gestPage.php';
                break;
        }

        // Redirect to appropriate page
        echo "<script>alert('You are Successfully logged in'); window.location='$redirectUrl';</script>";
        exit;
    } else {
        $errorMessage = "Wrong! invalid username or password";
    }

    // Re-enable the login button
    echo '<script>document.getElementById("loginBtn").disabled = false;</script>';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg" style="background-color:#0F5091 ">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block">
                               <img src="./img/img2.png" style="width:900px;height:400px"></img>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Login</h1>
                                         <?php if (!empty($errorMessage)) { ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?php echo $errorMessage; ?>
                                    </div>
                                    <?php } ?>
                                    </div>
                                    <form class="user" action="" method="post">
                                        <div class="form-group">
                                            <input type="email" required name="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" required name="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password">
                                        </div>
                                       
                                        <button type="submit" name="login" class="btn btn-user btn-block" style="background-color:#0F5091;color:white">
                                            Login
                                        </button>
                                       
                                    </form>
                                    <hr>
                                   
                                    <div class="text-center">
                                        <a class="small" href="register.php" style="color:white;font-sze:bold;font-size:20px">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <div class="row text-center text-white">
           <div class="col-md-12">
          <h4 style="font-size:bold">INDUSTRIAL FIELD MANAGEMENT SYSTEM</h4>
           </div>
        </dv>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>