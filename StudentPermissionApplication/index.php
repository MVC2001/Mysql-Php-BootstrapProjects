<?php
session_start();
include './connection/include.php';

$errorMessage = ''; // Initialize error message variable

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $confirmPassword = md5($_POST['conf-password']); // New line to get confirm password

    // Check if password and confirm password match
    if ($password !== $confirmPassword) {
        $errorMessage = "Password and Confirm Password do not match";
    } else {
        $query = mysqli_query($connect, "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'") or die(mysqli_connect_error());
        $fetch = mysqli_fetch_array($query);
        $row = mysqli_num_rows($query);

        if ($row > 0) {
            $_SESSION['user_id'] = $fetch['user_id'];
             $_SESSION['role'] = $fetch['role'];
            $role = $fetch['role'];

            if ($role == 'administrator') {
                echo "<script>alert('You are  Successfully! login')</script>";
                echo "<script>window.location='dashboard.php'</script>";
            }  
            else if ($role == 'directorOfstuService') {
                echo "<script>alert('You are  Successfully! login')</script>";
                echo "<script>window.location='directorOfstuService.php'</script>";
            }
            
             else if ($role == 'HOD') {
                echo "<script>alert('You are  Successfully! login')</script>";
                echo "<script>window.location='HOD.php'</script>";
            }
             else if ($role == 'DeanOfSchl') {
                echo "<script>alert('You are  Successfully! login')</script>";
                echo "<script>window.location='DeanOfSchl.php'</script>";
            }
            else if ($role == '') {
                echo "<script>alert('You are  Successfully! login')</script>";
                echo "<script>window.location='studentporto.php'</script>";
            }
        } else {
            $errorMessage = "Wrong! invalid username or password";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Login</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <link href="./css/style.css" rel="stylesheet">

</head>

<body class="h-100 " style="background-color: #0A2D54;">
    <div class="authincation h-100 w-90" style="margin-left:60px">
        <div class="container-fluid h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content" style="border-radius:8%">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                            <br>
                            <center><p class="text-secondary" style="box-shadow: rgba(17, 17, 26, 0.1) 0px 1px 0px;"><b>ONLINE STUDENT PERMISSION MANAGEMENT SYSTEM<b><br>
                             nyemamudhihir@gmail.com
                            </p></center>
                                <div class="auth-form">
                                    <?php if (!empty($errorMessage)) { ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?php echo $errorMessage; ?>
                                    </div>
                                    <?php } ?>
                                    <h4 class="mb-4 text-center">Login</h4>
                                    <form action="" method="POST">
                                        <div class="form-group">
                                            <label><strong>Email</strong></label>
                                            <input type="email" name="email" required class="form-control" value="">
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Password</strong></label>
                                            <input type="password" name="password" class="form-control" required value="">
                                        </div>
                                         <div class="form-group">
                                            <label><strong>Confirm-Password</strong></label>
                                            <input type="password" name="conf-password" class="form-control" required value="">
                                        </div>
                                        <div class="mt-4 mb-2 form-row d-flex justify-content-between">
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" name="login" class="btn btn-secondary btn-block" style="background-color: #0A2D54;">Login</button>
                                        </div>
                                    </form>
                                    <div class="mt-3 new-account">
                                        <p>Don't have an account? <a class="text-primary" href="./register.php">Register</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="./vendor/global/global.min.js"></script>
    <script src="./js/quixnav-init.js"></script>
    <script src="./js/custom.min.js"></script>

</body>

</html>
