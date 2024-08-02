<?php
session_start();
include "connection.php";

if(isset($_POST["login_function"])){

  $email = $_POST["email"];
  $password = md5($_POST["password"]);



  $select_only_email_and_password ="SELECT id, email,password

   FROM admin_table WHERE email = '$email' AND password = '$password'";

    $admin_query = $conn->query($select_only_email_and_password);

    if ($admin_query->num_rows > 0) {
        $row = $admin_query->fetch_assoc();
      
        $_SESSION['id'] = $row['id'];
        $_SESSION['email'] = $row['email'];
        header("Location: AdminDashboard.php");
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
    <title>Admin login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
        

          <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <!--------login for placed here----->
               <div class="card"   style="margin-left:400px;margin-top:30px;width:470px">

                 <div class="card-header" style="background-color:teal">
                 <h3>Admin login</h3>
                 </div>

                 <div class="card-body">
                  <form method="POST"  action="">
                   
                   <div class="form-group">
                   <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                   </div>

                   <div class="form-group">
                   <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
                   </div>
                    
                    <div class="form-group" style="margin-top:40px">
                     <button type="submt"  name="login_function" class="btn btn-success">Login</button>
                    </div>


                    <br>
                    <p>Back <a href="index.php">home</a></p>
                
                  </form>
                 </div>



               </div>
              </!------ends here------------------>
            </div>

          </div>
          </div>


</body>
</html>