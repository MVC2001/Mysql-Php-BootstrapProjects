           
<?php
session_start();
include("./connection/include.php");

// Fetch data from the school_tbl
$query = "SELECT  school FROM school_tbl";
$result = mysqli_query($connect, $query);

// Check if query was successful
if (!$result) {
    die("Query failed: " . mysqli_error($connect));
}

// Fetch data and display options
$options = "";
while ($row = mysqli_fetch_assoc($result)) {
    $school = $row['school'];
    $options .= "<option value='{$school}'>{$school}</option>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Apply </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <!-- Custom Stylesheet -->
    <link href="./css/style.css" rel="stylesheet">

</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">


            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">

                        </div>

                        <ul class="navbar-nav header-right">

                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <i class="mdi mdi-account"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">

                                    <a href="./logout.php" class="dropdown-item">
                                        <i class="icon-key"></i>
                                        <span class="ml-2">Logout </span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="quixnav" style="background-color:#11517c;">
            <div class="quixnav-scroll">
                <ul class="metismenu" id="menu">
                   <br>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="icon icon-single-04"></i><span class="nav-text">Back-home</span></a>
                        <ul aria-expanded="false">
                            <li><a href="./studentporto.php">Back-now</a></li>
                    </li>

                        </ul>
                    </li>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Apply for result-slip</h4>
                            <!-- Error alert -->
                                      <!-- Success message -->
    <?php if(isset($_SESSION['success_message'])): ?>
    <div class="alert alert-success" role="alert">
        <?php echo $_SESSION['success_message']; ?>
    </div>
    <?php unset($_SESSION['success_message']); ?>
    <?php endif; ?>

    <!-- Error message -->
    <?php if(isset($_SESSION['error_message'])): ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $_SESSION['error_message']; ?>
    </div>
    <?php unset($_SESSION['error_message']); ?>
    <?php endif; ?>
                        </div>
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-xl-6 col-xxl-12">
                                <div class="basic-form">
                                    <form class="form-inline" action="application.php" method="POST" enctype="multipart/form-data">
                        </div>


                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title text-success">These field already filled*</h4>

                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                        <div class="form-row">

                                            <div class="col-sm-6 mt-2 mt-sm-0">
                                                <input name="fullName" required type="text" <?php 
                                          $select_all_roles = "select fullName from users  WHERE `user_id`='$_SESSION[user_id]'" or die(mysqli_error($connect));
                                          $result = mysqli_query($connect,$select_all_roles);
                                          $number = mysqli_num_rows($result);
                                             if ($number > 0) {
                                           while($row = mysqli_fetch_assoc($result)) { ?>
                                             value=
                                                "<?php echo $row['fullName']; ?>"
                                           <?php } } ?>
                                                
                                                class="form-control">
                                            </div>


                                             <div class="col-sm-6 mt-2 mt-sm-0">
                                                <input name="indexNo" required type="text" class="form-control" placeholder="Enter index number eg. 0551.0072.2018">
                                            </div>
                                        </div>

                                </div>
                            </div>
                        </div>

                         <div class="card">
                            <div class="card-header">
                                <h4 class="card-title text-danger">Please fil below inputs*</h4>

                            </div>
                            <div class="card-body">
                                <div class="basic-form">

                                        <div class="form-row">
                                            <div class="col-sm-12 mt-2 mt-sm-0">
                                                  <select type="text" class="form-control" id="school" name="school">
                                            <?php echo $options; ?>
                                                </select>
                                            </div>
                                        </div>

                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                
                            </div>
                            <div class="card-body">
                                <div class="basic-form">

                                        <div class="form-row">

                                            <div class="col-sm-6 mt-2 mt-sm-0">
                                               <input type="file" class="form-control" name="file_upload" placeholder="upload clearence form"> <!-- Changed attribute name to "clearanceForm" -->
                                            </div>
                                    
                                             <div class="col-sm-6 mt-2 mt-sm-0">
                                               <input type="text" class="form-control" name="wented_at" placeholder="Enter year of study eg. 2018"> <!-- Changed attribute name to "clearanceForm" -->
                                            </div>
                                        </div>

                                </div>
                            </div>
                        </div>

                        <div class="card">

                            <div class="card-body">
                                <div class="basic-form">

                                        <button type="submit" name="add-function" class="btn btn-primary mb-2">Apply now</button>
                                    </form>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->



    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="./vendor/global/global.min.js"></script>
    <script src="./js/quixnav-init.js"></script>
    <script src="./js/custom.min.js"></script>

</body>

</html>
