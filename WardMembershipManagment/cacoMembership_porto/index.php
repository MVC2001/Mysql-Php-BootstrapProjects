<?php
session_start();
include './connection/include.php';

$errorMessage = ''; // Initialize error message variable

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    // Disable the login button
    echo '<script>document.getElementById("loginBtn").disabled = true;</script>';

    $query = mysqli_query($connect, "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'") or die(mysqli_connect_error());
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
            case 'caco_admin':
                $redirectUrl = 'caco_admin.php';
                break;
            case 'member':
                $redirectUrl = 'memberporto.php';
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auth-Page</title>
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
                        <img src="./cacoimgs/cacologo.jpg" style="height:100px;wdth:150px"></igm>
                        <h4 class="mt-1 mb-5 pb-1">CACO membership porto</h4>
                      </div>
      
                      <form method="POST" action="">
                        <p>Please login to your account</p>
                        <?php if (!empty($errorMessage)) { ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?php echo $errorMessage; ?>
                                    </div>
                                    <?php } ?>
      
                            
                        <div data-mdb-input-init class="form-outline mb-4">
                          <input type="email"   name="email" id="form2Example11" class="form-control"
                            placeholder="" />
                          <label class="form-label" for="form2Example11">Email</label>
                        </div>
      
                        <div data-mdb-input-init class="form-outline mb-4">
                          <input type="password" name="password" id="form2Example22" class="form-control" />
                          <label class="form-label" for="form2Example22">Password</label>
                        </div>
      
                        <div class="text-center pt-1 mb-5 pb-1">
                          <button  class="btn  btn-block fa-lg text-white mb-3" type="submit" name="login"  style="background-color:#032B58">Log
                            in</button>
                          <a class="text-muted" href="cangePassword.php">Forgot password?</a>
                        </div>
      
                        <div class="d-flex align-items-center justify-content-center pb-4">
                          <p class="mb-0 me-2">Don't have an account?</p>
                           <a href="./register.php"><button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-">Create new</button></a>
                        </div>
      
                      </form>
      
                    </div>
                  </div>
                  <div class="col-lg-6 d-flex align-items-center "  style="background-color:#032B58">
                    <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                      <h4 class="mb-4">MEMBERSHIP REGISTRATION SYSTEM</h4>
                      <p class="small mb-0">Welcome care and comfort organization, this page is for membership login.
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