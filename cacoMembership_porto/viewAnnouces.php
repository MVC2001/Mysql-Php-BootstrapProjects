<?php
session_start();
include("./connection/include.php");

// Check if user is not logged in or not a member, then redirect to 404 page
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'member') {
    header('location: Error404.php');
    exit;
}

// Fetch announcements ordered by announce_id DESC including updated_at as timestamp
$query = "SELECT *, UNIX_TIMESTAMP(updated_at) AS updated_timestamp FROM announcement ORDER BY announce_id DESC";
$result = mysqli_query($connect, $query);

// Check for errors in query execution
if (!$result) {
    die('Error retrieving announcements: ' . mysqli_error($connect));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Member Registration Panel</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <!-- Custom Stylesheet -->
    <link href="./css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            background-color: #0A2D54;
            color: white;
            padding: 20px;
            width: 250px;
            transition: all 0.3s ease;
            overflow-y: auto;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar ul li {
            margin-bottom: 10px;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 0;
                overflow: hidden;
            }

            .main-content {
                margin-left: 0;
            }
        }

        /* Custom alert style */
        .fade-in-out {
            animation: fadeInOut 2s ease-in-out infinite;
            display: none; /* Initially hide the alert */
        }

        @keyframes fadeInOut {
            0%, 100% {
                opacity: 0;
            }
            50% {
                opacity: 1;
            }
        }
    </style>
</head>

<body>

    <!-- Main wrapper start -->
    <div id="main-wrapper">

        <!-- Nav header start -->
        <div class="nav-header" style="background-color:#032B58">
            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!-- Nav header end -->

        <!-- Header start -->
        <div class="header" style="background-color:#032B58">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                        </div>
                        <ul class="navbar-nav header-right">
                            <li class="nav-item dropdown header-profile">
                                <b>Welcome: </b><a class="nav-link" href="#" role="button" data-toggle="dropdown"
                                    style="color:white">
                                    <?php
                                    $query = mysqli_query($connect, "SELECT * FROM `users` WHERE `user_id`='$_SESSION[user_id]'") or die(mysqli_connect_error());
                                    $fetch = mysqli_fetch_array($query);
                                    echo "" . $fetch['email'] . " ";
                                    ?><i class="mdi mdi-account"></i>
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
        <!-- Header end -->

        <!-- Sidebar start -->
        <div class="quixnav" style="background-color:#032B58">
            <div class="quixnav-scroll">
                <ul class="metismenu" id="menu">
                    <hr>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="fa fa-hand-o-right"></i><span class="nav-text">Back</span></a>
                        <ul aria-expanded="false">
                            <li><a href="./memberporto.php">Home</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Sidebar end -->

        <!-- Content body start -->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-12 p-md-0">
                        <div class="card shadow-lg">
                            <div class="card-body">
                                <div class="welcome-text">
                                    <h4 style="color:teal">Announcements from CARE AND COMFORT ADMINISTRATION</h4>
                                </div>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- row -->

                <div class="row">
                    <div class="col-xl-12 col-xxl-12">
                        <div class="container">
                            <h2 class="text-success">Announcements</h2>
                            <?php if (mysqli_num_rows($result) > 0): ?>
                                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                    <div class="card mb-4">
                                        <div class="card-header" style="background-color:#032B58; color:white;">
                                            Read now
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p class="card-text" style="color:#032B58">
                                                        <?php echo htmlspecialchars($row['comment']); ?>
                                                    </p>
                                                </div>
                                                <div class="col-md-4 text-right">
                                                    <small class="text-muted"
                                                        style="color:#032B58;font-weight:bold">
                                                        <?php echo htmlspecialchars($row['created_at']); ?>
                                                    </small>
                                                    <br>
                                                    <small class="text-muted"
                                                        style="color:#032B58;font-weight:bold">
                                                        Word Count: <?php echo str_word_count($row['comment']); ?>
                                                    </small>
                                                    <?php
                                                    $current_timestamp = time();
                                                    $announcement_timestamp = strtotime($row['updated_at']);
                                                    $difference = $current_timestamp - $announcement_timestamp;

                                                    // Check if updated within last 60 seconds (adjust as needed)
                                                    if ($difference < 60) {
                                                        // Display the alert if it's a new update and not dismissed
                                                        if (!isset($_SESSION['dismissed_update']) || $_SESSION['dismissed_update'] != $row['announce_id']) {
                                                            echo '<br><br>';
                                                            echo '<div id="update-alert-' . $row['announce_id'] . '" class="alert alert-success fade-in-out alert-dismissible fade show" role="alert" style="background-color:#032B58;color:white">';
                                                            echo '<i class="fas fa-bell mr-2"></i>';
                                                            echo 'New update! Announcement was recently updated.';
                                                            echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="dismissAlert(' . $row['announce_id'] . ')">';
                                                            echo '<span aria-hidden="true">&times;</span>';
                                                            echo '</button>';
                                                            echo '</div>';
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <p>No announcements found.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content body end -->

    </div>
    <!-- Main wrapper end -->

    <!-- Scripts -->
    <!-- Required vendors -->
    <script src="./vendor/global/global.min.js"></script>
    <script src="./js/quixnav-init.js"></script>
    <script src="./js/custom.min.js"></script>
    <script>
        // Function to dismiss alert and store in session storage
        function dismissAlert(announceId) {
            document.getElementById('update-alert-' + announceId).style.display = 'none';
            sessionStorage.setItem('dismissed_update', announceId);
        }

        // Check if there is a dismissed alert in session storage and hide it
        document.addEventListener('DOMContentLoaded', function () {
            <?php if (isset($_SESSION['dismissed_update'])): ?>
                var dismissedUpdate = <?php echo $_SESSION['dismissed_update']; ?>;
                if (dismissedUpdate) {
                    document.getElementById('update-alert-' + dismissedUpdate).style.display = 'none';
                }
            <?php endif; ?>
        });

        // Function to toggle alert display every 2 seconds
        function toggleAlert() {
            var alerts = document.querySelectorAll('.fade-in-out');
            alerts.forEach(function(alert) {
                setInterval(function() {
                    alert.style.display = (alert.style.display === 'none' || alert.style.display === '') ? 'block' : 'none';
                }, 2000); // Repeat every 2 seconds
            });
        }

        // Call toggleAlert function to start showing alerts
        toggleAlert();
    </script>
</body>

</html>
