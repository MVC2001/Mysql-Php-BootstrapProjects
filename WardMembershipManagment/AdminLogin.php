

<?php
session_start();
include("./include/connection.php");


if(isset($_POST['admin_data'])){
  $email = $_POST['email'];
  $password = md5($_POST['password']);


  $data_select = "select * from admin where email = '{$email}' and
    password = '{$password}';";
  $result = mysqli_query($connect,$data_select);
  $number = mysqli_num_rows($result);
if($number > 0){
  $row = mysqli_fetch_assoc($result);
  if($row['email']  === $email && $row['password'] === $password){

    session_start();
    $_SESSION['permmission']  = $row;
    $_SESSION['role'] = $row['role'];
    header("location:./admin_files/Dashboard.php");
    exit();
  } else {
    echo "<div class='alert alert-success' role='alert'>
  Hello Admin Your Are Successfull Login!!!
   </div>";  
}
}
else {
  echo "<div class='alert alert-danger' role='alert'>
  Hello Sory!!,Please Enter Valid Email And Password The Login
 </div>"; 
}
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USERS-HOME-PAGE</title>

    <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="./AllStyles.css" rel="stylesheet">
</head>
<body>

</body>
</html>