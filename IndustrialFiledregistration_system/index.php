<?php
session_start();
include "connection.php";

if(isset($_POST["login_function"])){

  $email = $_POST["email"];
  $password = md5($_POST["password"]);



  $select_only_email_and_password ="SELECT student_id, email,password

   FROM students WHERE email = '$email' AND password = '$password'";

    $student_query = $conn->query($select_only_email_and_password);

    if ($student_query->num_rows > 0) {
        $row = $student_query->fetch_assoc();
      
        $_SESSION['student_id'] = $row['student_id'];
        $_SESSION['email'] = $row['email'];
        header("Location: studentDashboard.php");
        exit();
    } else {
        echo "Invalid email or password";
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
        <!------this is  my head---------------->
          <div class="card">
            <h3 style="color:teal;margin-left:400px;font-size:30px">STUDENTS FIELD ENROLLMENT</h3>
          </div>
          <!----ends ends here------------------>


          <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <!--------login for placed here----->
               <div class="card"   style="margin-left:400px;margin-top:30px;width:470px">

                 <div class="card-header" style="background-color:teal">
                 <h3>Student login</h3>
                 </div>

                 <div class="card-body">
                  <form method="post"  action="">
                   
                   <div class="form-group">
                   <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                   </div>

                   <div class="form-group">
                   <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
                   </div>
                    
                    <div class="form-group" style="margin-top:40px">
                     <button type="submit" name="login_function" class="btn btn-success">Login</button>
                    </div>


                    <br>
                    <p>Do you have an account? <a href="register.php">Register</a></p>
                  
                     <br>
                    <p>Admin <a href="adminLogin.php">Login</a></p>
                  </form>
                 </div>



               </div>
              </!------ends here------------------>
            </div>

          </div>
          </div>


</body>
</html>