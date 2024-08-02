

<?php
session_start();
include("./include/connection.php");


if(isset($_POST['citizen_data'])){
  $email = $_POST['email'];
  $password = md5($_POST['password']);


  $data_select = "select * from citizen_tbl where email = '{$email}' and
    password = '{$password}';";
  $result = mysqli_query($connect,$data_select);
  $number = mysqli_num_rows($result);
if($number > 0){
  $row = mysqli_fetch_assoc($result);
  if($row['email']  === $email && $row['password'] === $password){

    session_start();
    $_SESSION['permmission']  = $row;
    $_SESSION['role'] = $row['role'];
    header("location:./Chats/CitizenChatPannel.php");
    exit();
  } else {
    echo "<div class='alert alert-success' role='alert'>
  Hello Admin Your Are Successfull Login!!!
   </div>";  
}
}
else {
  echo "<div class='alert alert-danger' role='alert'>
  Please Enter Valid Email And Password The Login </div>"; 
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


    <link href="/styles1.css" rel="stylesheet">
    <!--ends here links------>
       <script src="https://cdn.tailwindcss.com"></script>
    <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="./AllStyles.css" rel="stylesheet">
     <!-- FONTAWESOME STYLES-->
    <link href="css/font-awesome.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <!---- Ends Here----->
</head>
<body>


<!-------header section---->
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<br>
<div class="card" style="padding:30px 30px;width:100%;height:30px;color:yellow;font-size:20px;background-color:#003e6a"><center>
ONLINE DIGITAL COMMUNITY ENGAGEMENT SYSTEM<br></center><p></div><p  data-bs-toggle="modal" data-bs-target="#myModal" style="margin-left:1000px"><b>Admin-Login</b></p>
</div>
</div>
<div class="row" style="margin-top:10px">
 <div class="col-md-12">
<div class="modal-for-user-button" style="width:600px;margin-left:260px;margin-top:80px;margin-left:330px;height:230px;box-shadow: rgba(0, 0, 0, 0.07) 0px 1px 1px, rgba(0, 0, 0, 0.07) 0px 2px 2px, rgba(0, 0, 0, 0.07) 0px 4px 4px, rgba(0, 0, 0, 0.07) 0px 8px 8px, rgba(0, 0, 0, 0.07) 0px 16px 16px;">
<!------login buttons-------------------->
<div clasa="card shadow-lg" style="width:700px;height:300px">
<button type="button" class="btn btn-primary box-shadow"  data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="color:yellow;background-color:#003e6a;width:200px;margin-top:50px;margin-left:100px;height:50px">Street Member login</button></span>
<button type="button" class="btn btn-primary box-shadow"  data-bs-toggle="modal" data-bs-target="#adminlogin" style="color:yellow;background-color:#003e6a;width:200px;margin-top:50px;height:50px">ChairPersion login</button></span>
</div>
</div>





<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">ADMIN LOGIN</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       <div class="card">

         <form action="./AdminLogin.php" method="POST">
   <div class="form-group">
   <label class="form-label">Email</label>
   <input class="form-control" type="email" required autocomplete="off" name="email" placeholder="" >
   </div>
   <div class="form-group">
   <label class="form-label">Password</label>
   <input class="form-control" type="password" required autocomplete="off" name="password" placeholder="" >
   </div>
     </div>
     <br>
     <button name="admin_data" class="btn btn-primary">Login</button>
   </div>
         </form>
</div>
    

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>


<!---------footer--->
<div class="container-fluid text-left  shadow" style="color:yellow;background-color:#003e6a;margin-top:100px;height:300px">
<hr>
<div class="row">
<div class="col-md-4">
<h4><b>DEVELOPERS TEAM</b><h4>
</div>
<div class="col-md-4">
</div>
<div class="col-md-4">
<h4><b>CONTACTS</b><h4>
</div>
</div>

<div class="row">
<div class="col-md-4">
<p>Mbunge</p>
</div>
<div class="col-md-4">
</div>
<div class="col-md-4">
<p>Mwenyekit+07884747473
</div>
</div>


<div class="row">
<div class="col-md-4">
<p>Anitha Anitha</p>
</div>
<div class="col-md-4">
</div>
<div class="col-md-4">
<p>Mjumbe +079685883383</p>
</div>
</div>


<div class="row">
<div class="col-md-4">
<p>Rose Rose</p>
</div>
<div class="col-md-4">
</div>
<div class="col-md-4">
<p>Mtendaji +0705848484</p>
</div>
</div>

<div class="row">
<div class="col-md-4">
<p>Pevison</p>
</div>
</div>

<div class="row">
<div class="col-md-4">
<p>Rusi</p>
</div>
</div>

<div class="row">
<div class="col-md-4">
<p>Oy Niga</p>
<hr>
</div>
</div>
  </div>
</div>
<!------ends-------->




<!---street member  login  modal----->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="border:3px solid #003e6a">
      <div class="modal-header" style="background-color:#003e6a">
        <h5 class="modal-title" id="staticBackdropLabel" style="color:white;margin-left:70px"><center>Street Member Login</center></h5>
      </div>
      <div class="modal-body" style="box-shadow: rgb(204, 219, 232) 3px 3px 6px 0px inset, rgba(255, 255, 255, 0.5) -3px -3px 6px 1px inset;">
    

    <!-----card for street mebmber login------------------>
    <div class="card">

         <form action="./StreetMLoginC.php" method="POST">
   <div class="form-group">
   <label class="form-label">Email</label>
   <input class="form-control" type="text" required autocomplete="off" name="email" placeholder="" >
   </div>
   <div class="form-group">
   <label class="form-label">Password</label>
   <input class="form-control" type="password" required autocomplete="off" name="password" placeholder="" >
   </div>
     </div>
     <br>
     <button name="post_citizen_user_and_pass" class="btn btn-primary">Login</button>
   </div>
         </form>

      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" style="color:darkgreen">Close</button>
      </div>
    </div>
  </div>
</div>
<!------------ends here------->





<!---ChairPersion login  modal----->
<div class="modal fade" id="adminlogin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="border:3px solid #003e6a">
      <div class="modal-header" style="background-color:#003e6a">
        <h5 class="modal-title" id="staticBackdropLabel" style="color:white;margin-left:70px"><center>CHAIR PERSON LOGIN</center></h5>
      </div>
      <div class="modal-body" style="box-shadow: rgb(204, 219, 232) 3px 3px 6px 0px inset, rgba(255, 255, 255, 0.5) -3px -3px 6px 1px inset;">
    
    <!--------card for  login------------->
    <div class="card">
         <form action="./AdminLogin.php" method="POST">
   <div class="form-group">
   <label class="form-label">Email</label>
   <input class="form-control" type="email" required autocomplete="off" name="email" placeholder="" >
   </div>
   <div class="form-group">
   <label class="form-label">Password</label>
   <input class="form-control" type="password" required autocomplete="off" name="password" placeholder="" >
   </div>
     </div>
     <br>
     <button name="admin_data" class="btn btn-primary">Login</button>
   </div>
         </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" style="color:darkgreen">Close</button>
      </div>
    </div>
  </div>
</div>
<!------------ends here------->


<!-------script cdn here below-------->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<!-------Pre Loader------------------>
</body>
</html>