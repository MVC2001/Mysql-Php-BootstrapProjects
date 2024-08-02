<?php
include("./connection/include.php");
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'member') {
    header('location:Error404.php');
    exit; // Ensure script execution stops after redirection
}

$errorMessage = '';

if (isset($_POST['submit_memberinfo'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $birth_date = $_POST['birth_date'];
    $religion = $_POST['religion'];
    $nida = $_POST['nida'];
    $education_level = $_POST['education_level'];
    $place = $_POST['place'];
    $city = $_POST['city'];
    $district = $_POST['district'];
    $ward = $_POST['ward'];
    $comment = $_POST['comment'];
    
    // Check if the user is already registered
    $checkQuery = "SELECT * FROM membership_tbl WHERE 	name  = '$name'";
    $checkResult = mysqli_query($connect, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        $errorMessage = "You are already registered. Please contact us for approval.";
    } else {
        // Insert new membership information
        $query = "INSERT INTO membership_tbl (name, address, gender, phone, birth_date, religion,nida, education_level, place, city, district, ward, comment) 
                  VALUES ('$name', '$address', '$gender', '$phone', '$birth_date', '$religion','$nida', '$education_level', '$place', '$city', '$district', '$ward', '$comment')";
        
        if (mysqli_query($connect, $query)) {
            $_SESSION['success_message'] = "Membership information submitted successfully.";
            header('location: successMember.php');
            exit;
        } else {
            $errorMessage = "Failed to submit membership information.";
        }
    }
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Member registration panel </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <!-- Custom Stylesheet -->
    <link href="./css/style.css" rel="stylesheet">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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

                        <ul class="navbar-nav header-right">
                          
                           <li class="nav-item dropdown header-profile">
                                <b>Welcome: </b><a class="nav-link" href="#" role="button" data-toggle="dropdown" style="color:white">
                                    <?php   $query = mysqli_query($connect, "SELECT * FROM `users` WHERE `user_id`='$_SESSION[user_id]'") or die(mysqli_connect_error());
                                   $fetch = mysqli_fetch_array($query);
                                  echo "" . $fetch['email'] . " "; ?><i class="mdi mdi-account"></i>
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
                    <hr>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="fa fa-hand-o-right"></i><span class="nav-text">CACO-ANOUNCEMENT</span></a>
                        <ul aria-expanded="false">
                            <li><a href="viewAnnouces.php">View</a></li>
                        </ul>
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
                    <div class="col-sm-12 p-md-0">
                       
                        <div class="card shadow-lg">
                        <div class="card-body">
                           <span style="color:teal;">
            <h4 style="display:inline; color:teal;">Membership Status</h4>
            <?php
// Assuming $connect is your mysqli connection object and $_SESSION['user_id'] is properly sanitized

// SQL query to select users and their approval status
$select_all_users = "SELECT membership_tbl.member_id, membership_tbl.name, membership_tbl.status
                     FROM membership_tbl
                     JOIN users ON membership_tbl.name = users.name
                     WHERE users.user_id = $_SESSION[user_id]";

// Execute the query
$result = mysqli_query($connect, $select_all_users);

// Check if query executed successfully
if ($result) {
    $number = mysqli_num_rows($result);

    // Check if there are rows returned
    if ($number > 0) {
        while ($row = mysqli_fetch_assoc($result)) { 
            // Display different messages based on user's approval status
            if ($row['status'] == 'approved') { ?>
                <div class="stat-digit">
                    <i class="fa fa-check" style="color:green; font-size:30px;"></i>
                    <?php echo htmlspecialchars($row['status']); ?> Successfully
                </div>
            <?php } else { ?>
                <div class="stat-digit">
                    <i class="fa fa-hourglass" style="color:orange; font-size:30px;"></i>
                    <?php echo htmlspecialchars($row['name']); ?> Waiting for Approval
                </div>
            <?php }
        }
    } else { ?>
        <div class="stat-digit">
            <i class="fa fa-warning" style="color:red; font-size:30px;"></i>
            No users found
        </div>
    <?php }
} else {
    // Handle query execution error
    echo "Error: " . mysqli_error($connect);
}
?>
    
        </span>
                        </div>

                        </div>
                    </div>

                     <div class="welcome-text">
                            <h4 style="color:teal">Fill this form below to be a member of CARE AND CONFORT ORGANZATON</h4>
                        </div>
                        <br>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-xl-6 col-xxl-12">
                                <div class="basic-form">
                                    <form class="form-inline" action="" method="POST">
                        </div>


                        <div class="card">
                            <div class="card-header">
                  <?php if (isset($errorMessage)) { ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo $errorMessage; ?>
                                </div>
                            <?php } ?>

            <?php if (isset($successMessage)) { ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $successMessage; ?>
                </div>
            <?php } ?>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                
                                        <div class="form-row">
    
                                            <div class="col-sm-6 mt-2 mt-sm-0">
                                                     <label class="text-success" for="birth_data">Your name arleady filled</label>
                                                <input  name="name" type="text" class="form-control" placeholder="Enter fulllname eg. Mudhihir hamis Nyema" <?php 
                                          $select_all_roles = "select name from users  WHERE `user_id`='$_SESSION[user_id]'" or die(mysqli_error($connect));
                                          $result = mysqli_query($connect,$select_all_roles);
                                          $number = mysqli_num_rows($result);
                                             if ($number > 0) {
                                           while($row = mysqli_fetch_assoc($result)) { ?>
                                             value=
                                                "<?php echo $row['name']; ?>"
                                           <?php } } ?>
                                                
                                                class="form-control" readonly>
                                            </div>


                                             <div class="col-sm-6 mt-2 mt-sm-0">
                                             <label class="text-warning" for="birth_data">Start fill this attribute</label>
                                                <input name="address" type="text" class="form-control" placeholder="Enter address">
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
                                                
                                                 <select  type="text" name="gender" class="form-control" placeholder="Select gender">
                                                        <option value="None-user">--Select Gender--</option>
                                                        <option value="male">Male</option>
                                                        <option value="female">Female</option>
                                                        
                                                    </select>
                                            </div>
                                            <div class="col-sm-6 mt-2 mt-sm-0">
                                                <input type="number" class="form-control" name="phone" placeholder="Enter Phone number">
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
                                            <label for="birth_data">Enter age</label>
                                                 <input type="date" class="form-control" name="birth_date" placeholder="">
                                                 
                                            </div>
                                            <div class="col-sm-6 mt-2 mt-sm-0">
                                             <label for="religion">Enter religion</label>
                                                <input type="text" class="form-control" name="religion" placeholder="Enter religion">
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
                                            <label for="education_level">Select education level</label>
                                             
                                                  <select  type="text" name="education_level" class="form-control" placeholder="Select gender">
                                                        <option value="">--Select Educaton level--</option>
                                                        <option value="primary_school">Primary school</option>
                                                        <option value="secondary_schol">Secondary_school</option>
                                                        <option value="advanced_level">Advanced level</option>
                                                        <option value="under_graduate">Under_graduate</option>
                                                         <option value="post_graduate">Post Graduate</option>
                                                          <option value="mesters">Mesters</option>
                                                           <option value="doctor">Doctor</option>
                                                           <option value="php">Php</option>
                                                        
                                                    </select>
                                            </div>
                                            <div class="col-sm-6 mt-2 mt-sm-0">
                                             <label for="place">Current place/Location</label>
                                                <input type="text" class="form-control" name="place" placeholder="Enter place you come from">
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
                                                 <input type="text" class="form-control" name="city" placeholder="Enter city/region you come form">
                                                 
                                            </div>
                                            <div class="col-sm-6 mt-2 mt-sm-0">
                                             <label for="religion">District</label>
                                                <input type="text" class="form-control" name="district" placeholder="Enter district">
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
                                            <label for="ward">Village/Ward</label>
                                                 <input type="text" class="form-control" name="ward" placeholder="Enter ward">
                                                 
                                            </div>
                                            <div class="col-sm-6 mt-2 mt-sm-0">
                                             <label for="religion">Why do you join CACO</label>
                                                <textarea type="text" class="form-control" name="comment" placeholder="Enter reason here"></textarea>
                                            </div>
                                        </div>
                            
                                </div>
                            </div>
                        </div>

                        <div class="card">
                          
                            <div class="card-body">
                                <div class="basic-form">
                                
                                        <button type="submit" name="submit_memberinfo" class="btn btn-primary mb-2" style="background-color:#032B58">submit now</button>
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
    <script type="text/javascript">
    // JavaScript to handle loading indicator and show content after page load
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('loading').style.display = 'none';
        document.getElementById('content').style.display = 'block';
    });
</script>
    
</body>

</html>