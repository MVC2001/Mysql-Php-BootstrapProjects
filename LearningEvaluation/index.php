<?php
session_start();
include './connection/include.php';

$errorMessage = ''; 

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
            case 'staff':
                $redirectUrl = 'staff.php';
                break;
            case 'student':
                $redirectUrl = 'student.php';
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
    <meta name="author" content="Kodinger">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>My Login Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/my-login.css">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            background-image: url('./assets/images/homeimg.png'); /* Add your background image here */
            background-size: cover; /* Ensure the image covers the container */
            background-position: center; /* Center the image */
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
        .login-wrp {
            max-width: 400px;
            width: 100%;
            margin: 50px auto;
        }
        .top {
            height: 300px;
            position: relative;
        }
        .logo {
            position: absolute;
            max-width: 100px;
            top: 28%;
            left: 50%;
            transform: translateX(-50%);
            -webkit-transform: translateX(-50%);
        }
        .bottom {
           
            height: 300px;
            position: relative;
        }
        .bottom .login-form {
            background: #fff;
            position: absolute;
            box-shadow: 1px 1px 10px #999;
            width: 90%;
            top: -38%;
            left: 5%;
            border-radius: 5px;
            padding: 50px 40px;
        }
        .btn {
            border-radius: 30px;
        }
        .btn-primary {
            background-color: #2E4053;
            border-color: #F8C407;
        }
        .btn-primary:hover, .btn-primary:focus {
            background-color: #2E4053;
            border-color: #F8C407;
        }
        .checkbox-inline {
            cursor: pointer;
        }
        .btn-link {
            color: #999;
            margin-top: 10px;
            display: block;
        }
        .btn-link:hover, .btn-link:focus {
            color: #777;
        }
    </style>
</head>

<body class="my-login-page">

    <div class="login-wrp">
        <?php if (!empty($errorMessage)) { ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo $errorMessage; ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
            </div>
        <?php } ?>
        <div class="top">
        <br>
<center><h4 style="color:#212F3D;font-weght:bold:font-size:30px">ARU KNOWLEDGE SHARING MANAGEMENT SYSTEM</h4></center>
            <div class="logo">
                <img class="logo-abbr shadow-lg" src="./assets/images/aruLogo.png" alt="" style="height:70px;width:90px">
            </div>
        </div>
        <div class="bottom">
            <form action="" method="POST" class="login-form">
                <div class="form-group">
                    <input type="email" required name="email" class="form-control" placeholder="Email">
                </div>
                <div class="form-group">
                    <input type="password" required name="password" class="form-control" placeholder="Password">
                </div>
                <button type="submit" name="login" class="btn btn-primary btn-block" id="loginBtn">Login</button>
                <p class="text-center"><small><a href="./register.php" class="btn-link">Already have an account? Register</a></small></p>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="js/my-login.js"></script>
</body>
</html>
