<?php
include("./connection/include.php");
session_start(); 



function addUser($connect, $fullName, $role, $school, $department, $program,$email, $password) {
    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "Invalid email format.";
    }

    // Check if the role is selected
    if ($role == "None-user") {
        return "Please select a role.";
    }

    // Check if email already exists
    $checkEmailQuery = mysqli_query($connect, "SELECT * FROM `user` WHERE `email` = '$email'");
    if (mysqli_num_rows($checkEmailQuery) > 0) {
        return "Email already exists.";
    }

    // Hash the password
    $hashedPassword = md5($password);

    // Insert user into database
    $insertQuery = mysqli_query($connect, "INSERT INTO `user` (`fullName`, `role`, `school`, `department`, `program`, `email`, `password`) VALUES ('$fullName', '$role', '$school', '$department', '$program', '$email', '$hashedPassword')");
    if ($insertQuery) {
        return "User Account created successfully.";
    } else {
        return "Failed to add user.";
    }
}

// Usage example
if (isset($_POST['add-function'])) {
    // Assuming $connect is your database connection
    $fullName = $_POST['fullName'];
    $role = $_POST['role'];
    $school = $_POST['school'];
    $department = $_POST['department'];
    $program = $_POST['program'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = addUser($connect, $fullName, $role, $school, $department, $program, $email, $password);
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
        <a class="navbar-brand" href="./index.php">User regstration</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#topNavbar" aria-controls="topNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="topNavbar">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="./index.php">Logout</a>
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
                    <a class="nav-link active text-white" href="./index.php">
                        <i class="fa fa-list" style="color:white"></i> BACK HOME
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Main Content -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 mt-5">
            <div class="container shadow-sm">
                <!-- Success message -->
                <?php if(isset($_SESSION['success_message'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo $_SESSION['success_message']; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
                </div>
                <?php unset($_SESSION['success_message']); ?>
                <?php endif; ?>

                <!-- Error message -->
                <?php if(isset($_SESSION['error_message'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php echo $_SESSION['error_message']; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
                </div>
                <?php unset($_SESSION['error_message']); ?>
                <?php endif; ?>

                <!-- Form for Adding Users -->
                <form id="dynamicForm" action="" method="POST">
                    <div class="form-group">
                        <label for="fullName">Full Name:</label>
                        <input type="text" class="form-control" id="fullName" name="fullName" required>
                    </div>

                    <div class="form-group">
                        <label for="role">Select role:</label>
                        <select name="role" class="form-control" required>
                            <option selected>Select role</option>
                             
                            <option value="student">Student</option>
                            <option value="not-student">Others</option>
                            <option value="">Staff</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="school">School:</label>
                        <select name="school" class="form-control" required>
                            <option value="None-user">--Select School--</option>
                            <option value="SACEM">SACEM</option>
                            <option value="SSPSS">SSPSS</option>
                            <option value="SERBI">SERBI</option>
                            <option value="SEES">SEES</option>
                            <option value="others">Others</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="department">Department:</label>
                        <select name="department" class="form-control" required>
                            <option value="Building_Economics">Building-Economics</option>
                            <option value="Architecture">Architecture</option>
                            <option value="Interior_Design">Interior-Design</option>
                            <option value="Geospatial_Sciences_and_Technology">Geospatial-Sciences and Technology</option>
                            <option value="Computer_Systems_and_Mathematics">Computer-Systems and Mathematics</option>
                            <option value="Business_Studies">Business Studies</option>
                            <option value="Land_Management_and_Valuation">Land-Management and Valuation</option>
                            <option value="Civil_and_Environmental_Engineering">Civil and Environmental-Engineering</option>
                            <option value="Environmental_Science_and_Management">Environmental-Science and Management</option>
                            <option value="Urban_and_Regional_Planning">Urban and Regional-Planning</option>
                            <option value="Economics_and_Social_Studies">Economics and Social-Studies</option>
                            <option value="Others">Others</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="program">Program/Course:</label>
                        <input type="text" class="form-control" id="program" placeholder+.eg ISM,CSN name="program" required>
                    </div>

                    

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>

                    <button type="submit" class="btn btn-primary" name="add-function" style="background-color:#2E4053;">Submit</button>
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
