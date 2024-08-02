<?php
include("./connection/include.php");
session_start(); 

function signUpUser($connect, $name,$role, $email, $password) {
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
    $insertQuery = mysqli_query($connect, "INSERT INTO `users` (`name`,`role`, `email`, `password`) VALUES ('$name','$role', '$email', '$hashedPassword')");
    if ($insertQuery) {
        return "You are successfully create account.";
    } else {
        return "Failed to add user.";
    }
}

// Usage example
if (isset($_POST['signup'])) {
    // Assuming $connect is your database connection
    $name = $_POST['name'];
    $role = $_POST['role'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = signUpUser($connect, $name,$role, $email, $password);
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .gradient-custom-2 {
        /* fallback for old browsers */
        background: #fccb90;
        
        /* Chrome 10-25, Safari 5.1-6 */
        background: -webkit-linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);
        
        /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        background: linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);
        }
        
        @media (min-width: 768px) {
        .gradient-form {
        height: 100vh !important;
        }
        }
        @media (min-width: 769px) {
        .gradient-custom-2 {
        border-top-right-radius: .3rem;
        border-bottom-right-radius: .3rem;
        }
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>
<body>
    
    <section class="h-100 gradient-form" style="background-color: #eee;">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-10">
              <div class="card rounded-3 text-black">
                <div class="row g-0">
                  <div class="col-lg-6">
                    <div class="card-body p-md-5 mx-md-4">
      
                      <div class="text-center">
                        <img src="./cacoimgs/cacologo.jpg"
                          style="width: 185px;heght:100px" alt="logo">
                        <h4 class="mt-1 mb-5 pb-1">CACO membership porto</h4>
                      </div>
      
                      <form action="" method="POST">
                        <p>Please login to your account</p>
                          <?php if(isset($errorMessages)): ?>
                                    <div class="alert alert-success" role="alert">
                                        <?php echo $errorMessages; ?>
                                    </div>
                                    <?php endif; ?>
      
                        <div data-mdb-input-init class="form-outline mb-4">
                            <input type="text" name="name" id="form2Example11" class="form-control"
                              placeholder="" />
                            <label class="form-label" for="form2Example11">FullName</label>
                          </div>

                          <div data-mdb-input-init class="form-outline mb-4">
                           
                               <select type="text" name="role" id="form2Example11" class="form-control">
                                                        <option value="None-user">--Select Role--</option>
                                                        <option value="member">Member</option>
                                                        
                                                        <option value="others">Others</option>
                                                    </select>
                            <label class="form-label" for="form2Example11">Member role</label>
                          </div>


                        <div data-mdb-input-init class="form-outline mb-4">
                          <input type="email" name="email" id="form2Example11" class="form-control"
                            placeholder="" />
                          <label class="form-label" for="form2Example11">Email</label>
                        </div>
                        
      
                        <div data-mdb-input-init class="form-outline mb-4">
                          <input type="password" name="password" id="form2Example22" class="form-control" />
                          <label class="form-label" for="form2Example22">Password</label>
                        </div>
                         
                        
                        <div class="text-center pt-1 mb-5 pb-1">
                          <button  class="btn  btn-block fa-lg text-white mb-3" type="submit" name="signup"  style="background-color:#032B58">Register</button>
                         
                        </div>
      
                        <div class="d-flex align-items-center justify-content-center pb-4">
                          <p class="mb-0 me-2">Arleady registered, have an account?</p>
                          <a href="./index.php"><button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-danger">Login</button></a>
                        </div>
      
                      </form>
      
                    </div>
                  </div>
                  <div class="col-lg-6 d-flex align-items-center "  style="background-color:#032B58">
                    <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                       <h4 class="mb-4">MEMBERSHIP REGISTRATION SYSTEM</h4>
                      <p class="small mb-0">Welcome care and comfort organization, this page is for membership account creation.
                        <br><hr>
                        <b>To be a member , follow this steps below:</b><br>
                        1.Login if already you have an account<br>
                        2.Register/Create an account,if you don't have an account<br>
                        3.After login, next page is for membership registration, so please provde valid detail ,to be a valid membership<br>
                        4. Membership announcement, this page provide you daily announcements from CACO administration, but for approved members
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    
      
</body>
</html>