<?php
include("./connection/include.php");
session_start(); 

function signUpUser($connect, $fullName, $email,$role,$course,$indexNo, $password) {
    // Initialize validation messages
    $validationErrors = array();

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $validationErrors[] = "Invalid email format.";
    }

    // Validate password strength
    if (strlen($password) < 8 || !preg_match("#[0-9]+#", $password) || !preg_match("#[A-Z]+#", $password)) {
        $validationErrors[] = "Password should be at least 8 characters long and contain at least one number and one uppercase letter.";
    }

    // Check if there are any validation errors
    if (!empty($validationErrors)) {
        return $validationErrors;
    }

    // Hash the password
    $hashedPassword = md5($password);

    // Insert user into database
    $insertQuery = mysqli_query($connect, "INSERT INTO `user` (`fullName`, `email`,`role`,`course`,`indexNo`, `password`) VALUES ('$fullName', '$email','$role','$course','$indexNo', '$hashedPassword')");
    if ($insertQuery) {
        return "You are successfully create account.";
    } else {
        return "Failed to add user.";
    }
}

// Usage example
if (isset($_POST['signup'])) {
    // Assuming $connect is your database connection
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $course = $_POST['course'];
    $indexNo = $_POST['indexNo'];
    $password = $_POST['password'];

    $result = signUpUser($connect, $fullName, $email,$role,$course,$indexNo, $password);
    if (is_array($result)) {
        // If result is an array, it contains validation errors
        $errorMessages = implode("<br>", $result);
    } else {
        // If result is a string, it contains success or failure message
        $errorMessages = $result;
    }
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
                               <img src="./img/img2.png" style="width:900px;height:450px"></img>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Login</h1>
                                    
                                    <?php if(isset($errorMessages)): ?>
                                    <div class="alert alert-success" role="alert">
                                        <?php echo $errorMessages; ?>
                                    </div>
                                    <?php endif; ?>

                                    </div>
                                    <form class="user" action="" method="post">
                                      <div class="form-group">
                                            <input type="text" required name="fullName" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="fullNamelHelp"
                                                placeholder="Enter fullName">
                                        </div>
                                        <div class="form-group">
                                            <input type="email" required name="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address...">
                                        </div>
                                         <div class="form-group">
                                           <select name="role" required  type="text" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp">
                            <option selected>Select Role</option>
                            <option value="">Guest</option>
                            <option value="student">Student</option>
                            <option value="IndustrialField_coordinator">Industrial Field coordinator</option>
                             <option value="IndustrialField_trainer">Industrial Field Trainer</option>
                            <option value="others">Others</option>
                        </select>
                                        </div>
                                         <div class="form-group">
                                            <input type="text" required name="course" class="form-control form-control-user"
                                                id="exampleInputcourse" aria-describedby="course"
                                                placeholder="Enter course eg. ISM,optional for others">
                                        </div>
                                         <div class="form-group">
                                            <input type="text" required name="indexNo" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="indexNolHelp"
                                                placeholder="Enter indexNo">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" required name="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password">
                                        </div>
                                       
                                        <button type="submit" name="signup" class="btn btn-user btn-block" style="background-color:#0F5091;color:white">
                                            Register
                                        </button>
                                       
                                    </form>
                                    <hr>
                                   
                                    <div class="text-center">
                                        <a class="small" href="index.php" style="color:white;font-sze:bold;font-size:20px">Already have an account, login Now!</a>
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