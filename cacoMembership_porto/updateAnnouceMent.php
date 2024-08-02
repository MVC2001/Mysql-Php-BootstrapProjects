<?php
// Include your database connection file
include("./connection/include.php");

// Start the session
session_start();

// Redirect if user is not logged in as caco_admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'caco_admin') {
    header('location: Error404.php');
    exit; // Ensure script execution stops after redirection
}

// Function to update announcement
function updateUser($connect, $announce_id, $comment) {
    // Use mysqli_real_escape_string to sanitize inputs
    $comment = mysqli_real_escape_string($connect, $comment);
    $announce_id = mysqli_real_escape_string($connect, $announce_id);

    // Update query with updated_at field using NOW() to set current timestamp
    $updateQuery = mysqli_query($connect, "UPDATE `announcement` SET `comment`='$comment', `updated_at`=NOW() WHERE `announce_id`='$announce_id'");
    if ($updateQuery) {
        return "Announcement updated successfully.";
    } else {
        return "Failed to update announcement.";
    }
}

// Handle form submission
if (isset($_POST['update-function'])) {
    // Get announce_id from GET or POST, depending on your form
    $announce_id = $_GET['announce_id']; // Ensure to sanitize this value as needed
    $comment = $_POST['comment']; // Assume 'comment' is the name of your textarea

    // Call updateUser function
    $result = updateUser($connect, $announce_id, $comment);

    // Handle success or failure messages using session variables
    if (strpos($result, 'successfully') !== false) {
        $_SESSION['success_message'] = $result;
    } else {
        $_SESSION['error_message'] = $result;
    }

    // Redirect back to announcements.php after processing
    header("Location: announcements.php");
    exit(); // Ensure script execution stops after redirection
}
?>

 


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Update 	announce</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <!-- Custom Stylesheet -->
    <link href="./css/style.css" rel="stylesheet">
 <style>
        .form-control {
            width: 100%;
            box-sizing: border-box;
        }
    </style>
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
                            <li><a href="./users.php">Back-now</a></li>
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
                            <h4>Edit AnnounceMent</h4>
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
                $select = "select * from announcement where announce_id = '" .$_GET['announce_id']. "'";
                $result = mysqli_query($connect, $select);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) { ?>
                        </div>


                        <div class="card">
                            <div class="card-header">
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                
                                        <div class="form-row">
    
                                            <div class="col-sm-12 mt-2 mt-sm-0">
        <p>Your message goes here</p>
        <textarea id="comment" name="comment" required class="form-control" placeholder="Enter your comment here" style="height:200px; overflow:auto;" oninput="autoExpand(this)"><?php echo $row['comment']; ?></textarea>
    </div>
                                        </div>
                            
                                </div>
                            </div>
                        </div>

                    <?php }}?>
                       
                        <div class="card">
                            <div class="card-body">
                                <div class="basic-form">
                                        <button id="form_submit" type="submit" class="btn btn-dark"  name="update-function" style="background-color:#032B58" >Update AnnounceMent<i class="ti-arrow-right"></i></button>
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
     <script>
        function autoExpand(textarea) {
            // Reset textarea height
            textarea.style.height = 'auto';
            // Set the height based on the scroll height
            textarea.style.height = (textarea.scrollHeight) + 'px';
        }

        // Initial call to adjust height based on content
        document.addEventListener('DOMContentLoaded', function() {
            var textarea = document.getElementById('comment');
            autoExpand(textarea);
        });
    </script>
</body>

</html>