<?php
session_start();
include("./connection/include.php");

// Check if user is not logged in or not an admin, then redirect to login page
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('location:Error404.php');
    exit; // Ensure script execution stops after redirection
}

//delete logic 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if user_id is set and not empty
    if (isset($_POST['question_id']) && !empty($_POST['question_id'])) {
        $question_id = $_POST['question_id'];
        
        // Delete the question from the database
        $deleteQuery = mysqli_query($connect, "DELETE FROM `questions` WHERE `question_id` = $question_id");
        
        if ($deleteQuery) {
            // Question deleted successfully
            header('Location: allQuestions.php'); // Redirect to questions page
            exit();
        } else {
            // Error deleting question
            echo "Error deleting question.";
        }
    } else {
        // question_id not set or empty
        echo "Invalid question ID.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Questions</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
 <style>
        .navbar-custom {
            background-color: #2E4053;
        }
        .navbar-custom .navbar-nav .nav-link {
            color: white;
        }
        .navbar-custom .navbar-brand {
            color: white;
        }
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 1000;
            padding: 48px 0 0; /* Height of navbar */
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, 0.1);
        }
        .sidebar-sticky {
            position: -webkit-sticky;
            position: sticky;
            top: 0; /* Height of navbar */
            height: calc(100vh - 48px);
            padding-top: 0.5rem;
            overflow-x: hidden;
            overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
        }
        .sidebar .nav-link {
            font-weight: 500;
            color: #333;
        }
        .sidebar .nav-link .feather {
            margin-right: 4px;
            color: #999;
        }
        .sidebar .nav-link.active {
            color: #007bff;
        }
        .sidebar .nav-link:hover .feather,
        .sidebar .nav-link.active .feather {
            color: inherit;
        }
    </style>
</head>
<body>
    <!-- Top Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <a class="navbar-brand" href="./staff.php">Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#topNavbar" aria-controls="topNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="topNavbar">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <?php   $query = mysqli_query($connect, "SELECT * FROM `user` WHERE `user_id`='$_SESSION[user_id]'") or die(mysqli_connect_error());
                                   $fetch = mysqli_fetch_array($query);
                                  echo "" . $fetch['email'] . " "; ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="./changePasswordV1.php">Change Password</a>
                        <a class="dropdown-item" href="./logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="d-flex">
        <nav class="sidebar sidebar-sticky" style="background-color: #2E4053; color: white;">
           <ul class="nav flex-column" style="margin-top: 70px;">
                <li class="nav-item">
                    <a class="nav-link active text-white" href="./dashboard.php">
                        <i class="fa fa-list"></i> Back home
                    </a>
                </li>
            </ul>
        </nav>


    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h1 class="mb-4">All Responses/Answers</h1>
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>No#</th>
                            <th>Staff ID</th>
                             <th>Course Code</th>
                              <th>Question ID</th>
                            <th>Answer</th>
                            <th>Created At</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $count = 1;
                        $select = "SELECT *  from answers  ORDER BY answer_id DESC";
                        $result = mysqli_query($connect, $select);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td><?php echo $count ?></td>
                                    <td><?php echo $row['user_id']; ?></td>
                                    <td><?php echo $row['courseCode']; ?></td>
                                    <td><?php echo $row['question_id']; ?></td>
                                    <td><?php echo $row['answer']; ?></td>
                                    <td><?php echo $row['created_at']; ?></td>
                                   
                                </tr>
                                <?php $count++;
                            }
                        } else {
                            echo "<tr><td colspan='5'>No answers found.</td></tr>";
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
