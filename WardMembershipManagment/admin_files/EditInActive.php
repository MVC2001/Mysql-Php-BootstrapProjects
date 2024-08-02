<?php
session_start();
include("../include/connection.php");

//post citizen data
if (isset($_POST["ifpost_citizen_data"])) {
    $cit_id = $_GET['cit_id'];
  $fullname = $_POST['fullname'];
 $gender = $_POST['gender'];
  $occupation = $_POST['occupation'];
  $postal_codes = $_POST['postal_codes'];



    $update_citizen_data = "UPDATE  deletedcitizen_tbl SET fullname='$fullname',gender='$gender',occupation='$occupation',postal_codes ='$postal_codes'
    
    WHERE  cit_id='$cit_id'";

    if (mysqli_query($connect, $update_citizen_data)) {
        echo "<div class='alert alert-success' role='alert'><center>Citizen data Updated  Successfull</center></div>";
            header("location:InActiveMbembers.php");
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

    <title>UPDATE SHIFTED MEMBER DATA PANNEL</title>
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


            <!-----============---Search Bar-----------------==============================--------->
            <div class="search-bar">
                <form class="search-form d-flex align-items-center" method="POST" action="#">
                    <input type="text" name="query" placeholder="Search" title="Enter search keyword">
                    <button type="submit" title="Search"><i class="bi bi-search"></i></button>
                </form>
            </div>
            <nav class="header-nav ms-auto">
                <ul class="d-flex align-items-center">

                    <li class="nav-item d-block d-lg-none">
                        <a class="nav-link nav-icon search-bar-toggle " href="#">
                            <i class="bi bi-search"></i>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                    </li>
                    <!--======================== End seach  sectoion================== -->

                    <!--=================my side bard start here ======= Sidebar ======= -->
                    <aside id="sidebar" class="sidebar" style="background-color: #003e6a">
                        <ul class="sidebar-nav" id="sidebar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="bi bi-caret-down-square-fill"></i>
                                    <span>EDIT  NOW</span>
                                </a>
                            </li><br>
                            <hr>

                            <!---------=======Home Modal Here Now--===============================--->
                            <li class="nav-item">
                                <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse"
                                    href="#">
                                    <i class="bi bi-arrow-right-square-fill"></i><span>BACK HOME</span><i
                                        class="bi bi-chevron-down ms-auto"></i>
                                </a>
                                <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                                    <li>
                                        <a href="./Dashboard.php" style="color:darkgreen;">
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
            <center>EDIT SHIFTED MEMBER </center>
        </h3>
        <hr>
        <form action="" method="POST">
            <div class="container-fluid">
                <?php
                $select_student_data = "select * from deletedcitizen_tbl where cit_id='" .$_GET['cit_id']. "'" or die(mysqli_error($connect));
                $result = mysqli_query($connect, $select_student_data);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) { ?>

                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">Fullname</label>
                                <input class="form-control" type="text" name="fullname" value="<?php echo $row['fullname']; ?>" style="border-radius: 10px;height:50px;" autocomplete="off"><br>
                            </div>
                            <div class="col-md-6">
                               <div class="form-group">
                                <label class="form-label">Gender</label>
                                <input class="form-control" type="text" name="gender" value="<?php echo $row['gender']; ?>" style="border-radius: 10px;height:50px;" autocomplete="off"><br>
                     </div>
                        </div>


                     <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">Occupation</label>
                                <input class="form-control" type="text" name="occupation" value="<?php echo $row['occupation']; ?>" style="border-radius: 10px;height:50px;" autocomplete="off"><br>
                            </div>
                            
                            <div class="col-md-6">
                                  <div class="form-group">
                                     <label class="form-label">Postal Codes</label>
                                <input class="form-control" type="text" name="postal_codes" value="<?php echo $row['postal_codes']; ?>"  style="border-radius: 10px;height:50px;" autocomplete="off"><br>
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