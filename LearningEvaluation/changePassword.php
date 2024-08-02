<?php
include("./connection/include.php");
session_start(); 

// Check if user is not logged in or not an admin, then redirect to login page
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'staff') {
    header('location:Error404.php');
    exit; // Ensure script execution stops after redirection
}

$errorMessage = "";
$successMessage = "";

if (isset($_POST['reset-function'])) {
    $email = $_POST['email'];
    $oldPassword = md5($_POST['old-password']);
    $newPassword = md5($_POST['new-password']);

    // Validate inputs (you can add more validation as needed)
    if (empty($email) || empty($oldPassword) || empty($newPassword)) {
        $errorMessage = "Please fill in all fields.";
    } else {
        // Check if the provided email and old password match an existing user
        $query = mysqli_query($connect, "SELECT * FROM `user` WHERE `email` = '$email' AND `password` = '$oldPassword'");
        $row = mysqli_fetch_assoc($query);

        if ($row) {
            // Update password with the new one
            $updateQuery = mysqli_query($connect, "UPDATE `user` SET `password` = '$newPassword' WHERE `email` = '$email'");
            if ($updateQuery) {
                $successMessage = "Password reset successfully.";
            } else {
                $errorMessage = "Failed to reset password. Please try again.";
            }
        } else {
            $errorMessage = "Invalid email or old password.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Form with Navbar</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        .navbar-custom {
            background-color: #2E4053;
        }
        .navbar-custom .navbar-nav .nav-link {
            color: white;
        }
        .navbar-custom .navbar-brand {
            color: white;
        }
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 1000;
            padding: 48px 0 0; /* Height of navbar */
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, 0.1);
        }
        .sidebar-sticky {
            position: -webkit-sticky;
            position: sticky;
            top: 0; /* Height of navbar */
            height: calc(100vh - 48px);
            padding-top: 0.5rem;
            overflow-x: hidden;
            overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
        }
        .sidebar .nav-link {
            font-weight: 500;
            color: #333;
        }
        .sidebar .nav-link .feather {
            margin-right: 4px;
            color: #999;
        }
        .sidebar .nav-link.active {
            color: #007bff;
        }
        .sidebar .nav-link:hover .feather,
        .sidebar .nav-link.active .feather {
            color: inherit;
        }
    </style>
</head>
<body>
    <!-- Top Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <a class="navbar-brand" href="./staff.php">Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#topNavbar" aria-controls="topNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="topNavbar">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php
                            include("./connection/include.php");
                            $query = mysqli_query($connect, "SELECT * FROM `user` WHERE `user_id`='$_SESSION[user_id]'") or die(mysqli_connect_error());
                            $fetch = mysqli_fetch_array($query);
                            echo "" . $fetch['email'] . " ";
                        ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="./changePassword.php">Change Password</a>
                        <a class="dropdown-item" href="./logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="d-flex">
        <nav class="sidebar sidebar-sticky" style="background-color: #2E4053; color: white;height:700px">
            <ul class="nav flex-column" style="margin-top: 70px;">
                <li class="nav-item">
                    <a class="nav-link active text-white" href="#">
                        <i class="fa fa-list"></i> List Questions
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">
                        <i class="fa fa-comments"></i> Feedbacks
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Main Content -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 mt-5">
            <div class="container shadow-sm">
             <?php if (!empty($errorMessage)) { ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php echo $errorMessage; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
                </div>
            <?php } ?>
            <?php if (!empty($successMessage)) { ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo $successMessage; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
                </div>
            <?php } ?>
             <!-- Form for Password Reset -->
<form id="resetPasswordForm" action="" method="POST">
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>

    <div class="form-group">
        <label for="old-password">Old Password:</label>
        <input type="password" class="form-control" id="old-password" name="old-password" required>
    </div>

    <div class="form-group">
        <label for="new-password">New Password:</label>
        <input type="password" class="form-control" id="new-password" name="new-password" required>
    </div>

    <button type="submit" class="btn btn-primary" name="reset-function" style="background-color:#2E4053;">Reset Password</button>
</form>

            </div>
        </main>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
