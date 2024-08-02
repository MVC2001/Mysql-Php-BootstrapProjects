<?php
include("./connection/include.php");
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'caco_admin') {
    header('location:Error404.php');
    exit; // Ensure script execution stops after redirection
}

function updateUser($connect,$member_id, $status) {
   

    // Update user in the database
    $updateQuery = mysqli_query($connect, "UPDATE `membership_tbl` SET  `status`='$status' WHERE `member_id`='$member_id'");
    if ($updateQuery) {
        return "User updated successfully.";
    } else {
        return "Failed to update user.";
    }
}

// Usage example
if (isset($_POST['update-function'])) {
    $member_id = $_GET['member_id']; 
     $status = $_POST['status'];
   
    

    

    $result = updateUser($connect,$member_id, $status);
    if (strpos($result, 'successfully') !== false) {
        $_SESSION['success_message'] = $result;
    } else {
        $_SESSION['error_message'] = $result;
    }
    header("Location: approvedMembers.php");
    exit();
}
?>

 


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>update user </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <!-- Custom Stylesheet -->
    <link href="./css/style.css" rel="stylesheet">

</head>

<body>



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
                <nav class="navbar navbar-expand" style="background-color:#032B58">
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
        <div class="quixnav" style="background-color:#032B58">
            <div class="quixnav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label first"></li><hr>
                    <!-- <li><a href="index.html"><i class="icon icon-single-04"></i><span class="nav-text">Dashboard</span></a>
                    </li> -->
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="fa fa-hand-o-right"></i><span class="nav-text">Back-home</span></a>
                        <ul aria-expanded="false">
                            <li><a href="./newMembers.php">Back-now</a></li>
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
                            <h4>Review and Approve a member</h4>
                                <!-- Success message -->
 
                        </div>
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-xl-6 col-xxl-12">
                                <div class="basic-form">
                                    <form class="form-inline" action="" method="POST">
                                    <?php
                $select_user = "select * from membership_tbl where member_id = '" .$_GET['member_id']. "'";
                $result = mysqli_query($connect, $select_user);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) { ?>
                        </div>


                        <div class="card">
                            <div class="card-header">
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                
                                        <div class="form-row">
    
                                            <div class="col-sm-6 mt-2 mt-sm-0">
                                            <label for="name"> Member Name</label>
                                                <input name="name" value="<?php echo $row['name']; ?>" required type="text" class="form-control" placeholder="" readonly>
                                            </div>
                                             <div class="col-sm-6 mt-2 mt-sm-0">
                                             <label for="name">Member Address</label>
                                                <input name="address" value="<?php echo $row['address']; ?>" required type="text"  class="form-control" placeholder="" readonly>
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
                                          <div class="col-sm-6">
                                             <label for="gender">Gender</label>
                                            <input name="gender" value="<?php echo $row['gender']; ?>" required type="text" class="form-control" placeholder="" readonly>
</div>

 <div class="col-sm-6">
    <label for="phone">Contact/Phone</label>
                                         <input name="phone" value="<?php echo $row['phone']; ?>" required type="text" class="form-control" placeholder="" readonly>
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
                                          <div class="col-sm-6">
                                             <label for="birth_date">Date of birth</label>
                                            <input name="birth_date" value="<?php echo $row['birth_date']; ?>" required type="text" class="form-control" placeholder="" readonly>
</div>

 <div class="col-sm-6">
    <label for="name">Religion</label>
                                         <input name="religion" value="<?php echo $row['religion']; ?>" required type="text" class="form-control" placeholder="" readonly>
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
                                          <div class="col-sm-6">
                                             <label for="education_level">Education level</label>
                                            <input name="education_level" value="<?php echo $row['education_level']; ?>" required type="text" class="form-control" placeholder="" readonly>
</div>

 <div class="col-sm-6">
    <label for="place">Place/Location of a member</label>
                                         <input name="place" value="<?php echo $row['place']; ?>" required type="text" class="form-control" placeholder="" readonly>
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
                                          <div class="col-sm-6">
                                             <label for="city">City/Region</label>
                                            <input name="city" value="<?php echo $row['city']; ?>" required type="text" class="form-control" placeholder="" readonly>
</div>

 <div class="col-sm-6">
    <label for="place">District</label>
                                         <input name="district" value="<?php echo $row['district']; ?>" required type="text" class="form-control" placeholder="" readonly>
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
                                          <div class="col-sm-6">
                                             <label for="city">Ward/Village</label>
                                            <input name="ward" value="<?php echo $row['ward']; ?>" required type="text" class="form-control" placeholder="" readonly>
</div>

 <div class="col-sm-6">
    <label for="place">Member comment</label>
                                         <input name="comment" value="<?php echo $row['comment']; ?>" required type="text" class="form-control" placeholder="" readonly>
</div>

                                            
                                        </div>
                            
                                </div>
                            </div>
                        </div>



                      
                       <div class="card text-success">
                                    <div class="card-header"></div>
                                    <div class="card-body">
                                        <div class="basic-form">
                                            <div class="form-row">
                                                <div class="col-sm-12">
                                                    <select type="text" name="status" class="form-control">
                                                        <option value="None-user" class="text-warning">--Select To approve a member--</option>
                                                        <option value="approved">Approve</option>
                                                        <option value="">Not approve</option>
                                                        
                                                       
                                                    </select>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>

                    <?php }}?>
                       
                        <div class="card">
                            <div class="card-body">
                                <div class="basic-form">
                                        <button id="form_submit" type="submit" class="btn btn-dark"  name="update-function" style="background-color:#032B58" >Submt approve<i class="ti-arrow-right"></i></button>
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