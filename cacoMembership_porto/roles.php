<?php
session_start();
include("./connection/include.php");

// Check if user is not logged in or not an admin, then redirect to login page
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('location:index.php');
    exit; // Ensure script execution stops after redirection
}

//delete logic 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if user_id is set and not empty
    if (isset($_POST['role_id']) && !empty($_POST['role_id'])) {
        $role_id = $_POST['role_id'];
        
        // Delete the user from the database
        $deleteQuery = mysqli_query($connect, "DELETE FROM `role` WHERE `role_id` = $role_id");
        
        if ($deleteQuery) {
            // User deleted successfully
            header('Location: roles.php'); // Redirect to users page
            exit();
        } else {
            // Error deleting user
            echo "Error deleting user.";
        }
    } else {
        // user_id not set or empty
        echo "Invalid user ID.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Users </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <!-- Datatable -->
    <link href="./vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
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
        <div class="nav-header" style="background-color:#032B58">
        

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
        <div class="header" style="background-color:#032B58">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            </div>
    
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
        <div class="quixnav" style="background-color:#032B58">
            <div class="quixnav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label first"></li><hr>
                    <!-- <li><a href=""><i class="icon icon-single-04"></i><span class="nav-text">Dashboard</span></a>
                    </li> -->
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="fa fa-hand-o-right"></i><span class="nav-text">Back-home</span></a>
                        <ul aria-expanded="false">
                            <li><a href="./dashboard.php">Back-now</a></li>
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
                            <h4>Roles</h4>
                        </div>
                    </div>
                </div>
                <!-- row -->


                <div class="row">
                   
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <button class="btn btn-dark btn-block" style="width:150px;background-color:#032B58"><a href="addRole.php">AddNew-Role</a></button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example2" class="display table-bordered" style="width:100%">
                                        <thead style="color:white;background-color:#032B58">
                                            <tr>
                                               <th style="color:white">No#</th>
                                                <th style="color:white">Role</th>
                                                <th style="color:white">Description</th>
                                                <th style="color:white">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                         <?php 
                 $count=1;
                 $select_all = "SELECT * FROM `roles` ORDER BY role_id DESC";
                 $result = mysqli_query($connect,$select_all);
                 $number = mysqli_num_rows($result);
                 if ($number > 0) {
                     while($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                            <td><?php echo $count ?></td>
                                <td><?php echo $row['category']; ?></td>
                                <td><?php echo $row['description']; ?></td>
                                <td>
                                  
                                    <span>
                                    <form action="" method="POST">
                                       <input type="hidden" name="role_id" value="<?php echo $row['role_id']; ?>">
                                                 <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this role?')">
                                  <i class="fa fa-trash"></i>
                              </button>
                              </span>
                            </form>
</td>

                                    </span>
                                </td>
                            </tr>
                            <?php $count++?>
                        <?php }} ?>
                                        </tbody>             
                                    </table>
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
    


    <!-- Datatable -->
    <script src="./vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="./js/plugins-init/datatables.init.js"></script>

</body>

</html>