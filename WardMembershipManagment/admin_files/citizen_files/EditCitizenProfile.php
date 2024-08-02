<?php
session_start();
include("../include/connection.php");

//post citizen data
if (isset($_POST["ifpost_citizen_data"])) {
    $cit_id = $_GET['cit_id'];
  $fullname = $_POST['fullname'];
 $gender = $_POST['gender'];
 $date_OfBirth =$_POST['date_OfBirth'];
 $education_level= $_POST['education_level'];
  $health_status = $_POST['health_status'];
  $occupation = $_POST['occupation'];
  $phone = $_POST['phone'];
  $postal_codes = $_POST['postal_codes'];
  $house_ownership = $_POST['house_ownership'];
  $email = $_POST['email'];
  $password = md5($_POST['password']);

    $update_citizen_data = "UPDATE citizen_tbl SET fullname='$fullname',gender='$gender',date_OfBirth='$date_OfBirth',education_level='$education_level',health_status='$health_status',occupation='$occupation',phone='$phone',postal_codes='$postal_codes',house_ownership='$house_ownership',email='$email',password='$password'
    
    WHERE  cit_id='$cit_id'";

    if (mysqli_query($connect, $update_citizen_data)) {
        echo "<div class='alert alert-success' role='alert'><center>Student data Updated  Successfull</center></div>";
            header("location:CitizensAccount.php");
            exit();
    } else {
        echo "Error: " . $update_citizen_data. "<br>" . mysqli_error($connect);
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>UPDATE STUDENT DATA PANNEL</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Vendor CSS Files -->
    <link href="assets1/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets1/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets1/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets1/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets1/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets1/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets1/vendor/simple-datatables/style.css" rel="stylesheet">
    <!-- Template Main CSS File -->
    <link href="assets1/css/style.css" rel="stylesheet">
   
</head>

<body onload="myFunction()" style="margin:0;">
    <!-------Pre loader--------->
    <div id="loader"></div>
    <div style="display:none;" id="myDiv" class="animate-bottom">

        <!-- ======= Header ======= -->
        <header id="header" class="header fixed-top d-flex align-items-center">
            <div class="d-flex align-items-center justify-content-between">
             </div>
            <nav class="header-nav ms-auto">
                <ul class="d-flex align-items-center">

                  
                    <li class="nav-item dropdown">
                    </li>
                    <!--======================== End seach  sectoion================== -->

                    <!--=================my side bard start here ======= Sidebar ======= -->
                    <aside id="sidebar" class="sidebar" style="background-color:#003e6a">
                        <ul class="sidebar-nav" id="sidebar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="bi bi-caret-down-square-fill"></i>
                                    <span>EDIT CITIZEN DATA PANNEL</span>
                                </a>
                            </li><br>
                            <hr>

                            <!---------=======Home Modal Here Now--===============================--->
                            <li class="nav-item">
                                <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse"
                                    href="#">
                                    <i class="bi bi-arrow-right-square-fill"></i><span>Back  in dashboard</span><i
                                        class="bi bi-chevron-down ms-auto"></i>
                                </a>
                                <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                                    <li>
                                        <a href="../Dashboard.php" style="color:white;">
                                            <i
                                                class="bi bi-arrow-right-square-fill"></i><span>Back now</span>
                                        </a>
                                    </li>
                                </ul>
                           </li>
                            <!--==================== End Home Modal Here ================================= -->
                    </aside>
                    <!--=================================== End of Drop down Side Bar Links==========================================-->
    </div>



    <!-------- MAIN BODY=============================================-->
    <main id="main" class="main">
        <h3>
            <center>EDIT CITIZEN DATA DASHBOARD</center>
        </h3>
        <hr>
        <form action="" method="POST">
            <div class="container-fluid">
                <?php
                $select_student_data = "select * from citizen_tbl where cit_id='" .$_GET['cit_id']. "'" or die(mysqli_error($connect));
                $result = mysqli_query($connect, $select_student_data);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) { ?>

                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label">Fullname</label>
                                <input class="form-control" type="text" name="fullname" value="<?php echo $row['fullname']; ?>" style="border-radius: 10px;height:50px;" autocomplete="off"><br>
                            </div>
                            <div class="col-md-4">
                               <div class="form-group">
                                <label class="form-label">Gender</label>
                                <input class="form-control" type="text" name="gender" value="<?php echo $row['gender']; ?>" style="border-radius: 10px;height:50px;" autocomplete="off"><br>
                     </div>
                        </div>
                            <div class="col-md-4">
                                  <div class="form-group">
                                     <label class="form-label">Date OfBirth</label>
                                <input class="form-control" type="date" name="date_OfBirth" value="<?php echo $row['date_OfBirth']; ?>" style="border-radius: 10px;height:50px;" autocomplete="off"><br>
                           </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label">Education Level</label>
                                <input class="form-control" type="text" name="education_level" value="<?php echo $row['education_level']; ?>" style="border-radius: 10px;height:50px;" autocomplete="off"><br>
                            </div>
                            <div class="col-md-4">
                               <div class="form-group">
                                <label class="form-label">Health Status</label>
                                <input class="form-control" type="text" name="health_status" value="<?php echo $row['health_status']; ?>" style="border-radius: 10px;height:50px;" autocomplete="off"><br>
                     </div>
                        </div>
                            <div class="col-md-4">
                                  <div class="form-group">
                                     <label class="form-label">Occupation</label>
                                <input class="form-control" type="text" name="occupation" value="<?php echo $row['occupation']; ?>"  style="border-radius: 10px;height:50px;" autocomplete="off"><br>
                           </div>
                            </div>
                        </div>


                     <div class="row">
                            <div class="col-md-4">
                                <label class="form-label">Phone</label>
                                <input class="form-control" type="text" name="phone" value="<?php echo $row['phone']; ?>" style="border-radius: 10px;height:50px;" autocomplete="off"><br>
                            </div>
                            
                            <div class="col-md-4">
                                  <div class="form-group">
                                     <label class="form-label">Postal Codes</label>
                                <input class="form-control" type="text" name="postal_codes" value="<?php echo $row['postal_codes']; ?>"  style="border-radius: 10px;height:50px;" autocomplete="off"><br>
                           </div>
                            </div>
                             <div class="col-md-4">
                                  <div class="form-group">
                                     <label class="form-label">HouseOwnership</label>
                                <input class="form-control" type="text" name="house_ownership" value="<?php echo $row['house_ownership']; ?>"  style="border-radius: 10px;height:50px;" autocomplete="off"><br>
                           </div>
                            </div>
                        </div>


                     <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input class="form-control" type="text" name="email" value="<?php echo $row['email']; ?>" style="border-radius: 10px;height:50px;" autocomplete="off"><br>
                            </div>
                            
                            <div class="col-md-6">
                                  <div class="form-group">
                                     <label class="form-label">Password</label>
                                <input class="form-control" type="text" name="password" value="<?php echo $row['password']; ?>"  style="border-radius: 10px;height:50px;" autocomplete="off"><br>
                           </div>
                            </div>
                        </div>

                        </div>
                    <?php }
                } ?>
            </div>
            <br>
            <button name="ifpost_citizen_data" class="btn btn-warning" type="submit"
                style="width:150px;margin-left:400px;">Update</button>
        </form>
    </main>
    <!-----------Ends Here Now------------------------------>
    </div>
    </div>




    <!-----my script------------------------------------------------>
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
    <!------Script For----Pre Loader-------------------------------->
    <script>
        var myVar;

        function myFunction() {
            myVar = setTimeout(showPage, 80);
        }

        function showPage() {
            document.getElementById("loader").style.display = "none";
            document.getElementById("myDiv").style.display = "block";
        }
    </script>
    <!-----------------Ends Here------------------------------->

</body>

</html>