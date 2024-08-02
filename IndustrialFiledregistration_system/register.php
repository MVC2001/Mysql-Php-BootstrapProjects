<?php
include "connection.php";

if(isset($_POST["submit_student_data"])) {
   $name = $_POST["name"];
   $phoneNumber = $_POST["phoneNumber"];
   $course = $_POST["course"];
   $program = $_POST["program"];
   $email = $_POST["email"];
   $password = md5($_POST["password"]);


   $submit_students_data = "INSERT INTO students(name,phoneNumber,course,program,email,password) VALUES('$name','$phoneNumber','$course','$program','$email','$password');";

   if(mysqli_query($conn,$submit_students_data)){

    echo "You have successfully create an account";
   } else{
    echo "Wrong! registration";
   }



}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>student registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
        

          <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <!--------register for placed here----->
               <div class="card"   style="margin-left:400px;margin-top:30px;width:470px">

                 <div class="card-header" style="background-color:teal">
                 <h3>Student registration</h3>
                 </div>

                 <div class="card-body">
                  <form method="POST"  action="">

                   <div class="form-group">
                   <label for="name">Fullname</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter your name" required>
                   </div>

                    <div class="form-group">
                   <label for="phoneNumber">Phone number</label>
                    <input type="number" name="phoneNumber" class="form-control" placeholder="Enter your phoneNumber" required>
                   </div>

                    <div class="form-group">
                   <label for="course">Course</label>
                    <input type="text" name="course" class="form-control" placeholder="Enter your course" required>
                   </div>
                   
                    <div class="form-group">
                   <label for="program">Program</label>
                    <input type="text" name="program" class="form-control" placeholder="Enter your program" required>
                   </div>
                   
                   <div class="form-group">
                   <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                   </div>

                   <div class="form-group">
                   <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
                   </div>
                    
                    <div class="form-group" style="margin-top:40px">
                     <button type="submit" name="submit_student_data" class="btn btn-success">Register</button>
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