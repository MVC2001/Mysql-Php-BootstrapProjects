<?php
session_start();
include("./connection/include.php");

// Check if user is not logged in or not an admin, then redirect to login page
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'caco_admin') {
    header('location:Error404.php');
    exit; // Ensure script execution stops after redirection
}

// Initialize variables
$count = 1;

$select_all_announcements = "SELECT * FROM `announcement` ORDER BY announce_id DESC";
$result = mysqli_query($connect, $select_all_announcements);

// Check for errors in query execution
if (!$result) {
    die('Error retrieving announcements: ' . mysqli_error($connect));
}

$number = mysqli_num_rows($result); // Total number of announcements
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Announcements</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <!-- Datatable -->
    <link href="./vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom Stylesheet -->
    <link href="./css/style.css" rel="stylesheet">

    <style>
        .word-count-alert {
            display: none;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            padding: 10px;
            margin-top: 10px;
        }

        .word-change-alert {
            display: none;
            margin-top: 10px;
            padding: 10px;
            border: 1px solid #c3e6cb;
            background-color: #d4edda;
            color: #155724;
        }
    </style>
</head>

<body>

    <!-- Main wrapper start -->
    <div id="main-wrapper">

        <!-- Nav header -->
        <div class="nav-header" style="background-color:#032B58">
            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>

        <!-- Header -->
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
                                    <span class="ml-2">Logout</span>
                                </a>
                            </div>
                        </li>
                    </div>
                </nav>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="quixnav" style="background-color:#032B58">
            <div class="quixnav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label first"></li>
                    <hr>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="fa fa-hand-o-right" style="background-color:#273D55"></i><span class="nav-text">Back-home</span></a>
                        <ul aria-expanded="false">
                            <li><a href="./caco_admin.php">Back-now</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Content body -->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Announcements</h4>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <button class="btn btn-dark btn-block" style="width:150px;background-color:#032B58"><a href="addAnnounceMent.php">Add Announcement</a></button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example2" class="display table-bordered" style="width:100%">
                                        <thead style="color:white;background-color:#032B58">
                                            <tr>
                                                <th style="color:white">No#</th>
                                                <th style="color:white">Announcement</th>
                                                <th style="color:white">Created At</th>
                                                <th style="color:white">Word Count</th>
                                                <th style="color:white">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody style="color:#032B58">
                                            <?php 
                                            if ($number > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    // Count words in each announcement
                                                    $words = str_word_count($row['comment']);
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $count; ?></td>
                                                        <td class="announcement-text" data-original-text="<?php echo htmlspecialchars($row['comment']); ?>"><?php echo htmlspecialchars($row['comment']); ?></td>
                                                        <td><?php echo $row['created_at']; ?></td>
                                                        <td><?php echo $words; ?></td>
                                                        <td>
                                                            <a href="updateAnnouceMent.php?announce_id=<?php echo $row['announce_id']; ?>">
                                                                <button class="btn btn-warning btn-sm">Update</button>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    $count++;
                                                }
                                            } else {
                                                echo '<tr><td colspan="5">No announcements found.</td></tr>';
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div>Total number of announcements: <?php echo $number; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Main wrapper end -->

    <!-- Bootstrap JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Scripts -->
    <script src="./vendor/global/global.min.js"></script>
    <script src="./js/quixnav-init.js"></script>
    <script src="./js/custom.min.js"></script>

    <!-- Datatable -->
    <script src="./vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="./js/plugins-init/datatables.init.js"></script>

</body>

</html>
