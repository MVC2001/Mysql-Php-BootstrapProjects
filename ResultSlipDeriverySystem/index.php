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

            if ($role == 'admin') {
                echo "<script>alert('You are  Successfully! login')</script>";
                echo "<script>window.location='dashboard.php'</script>";
            } else if ($role == '') {
                echo "<script>alert('You are  Successfully! login')</script>";
                echo "<script>window.location='studentporto.php'</script>";
            } else if ($role == 'head_of_school') {
                echo "<script>alert('You are  Successfully! login')</script>";
                echo "<script>window.location='headOfSchool.php'</script>";
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

<body class="h-100">
    <div class="authincation h-100">
        <div class="container-fluid h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <?php if (!empty($errorMessage)) { ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?php echo $errorMessage; ?>
                                    </div>
                                    <?php } ?>
                                    <h4 class="text-center mb-4">Login in your account</h4>
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
                                        <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
                                        </div>
                                    </form>
                                    <div class="new-account mt-3">
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
