<?php
include("./connection/include.php");
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'staff') {
    header('location:Error404.php');
    exit; // Ensure script execution stops after redirection
}

if (isset($_GET['question_id']) && !empty($_GET['question_id'])) {
    $questionId = $_GET['question_id'];

    // Retrieve question details from the database
    $getQuestionQuery = mysqli_query($connect, "SELECT * FROM `questions` WHERE `question_id`='$questionId'");
    $questionData = mysqli_fetch_assoc($getQuestionQuery);

    if (!$questionData) {
        // Question not found, handle error
        // You can redirect to an error page or display an error message
        echo "Question not found.";
        exit;
    }

    // Process form submission
    if (isset($_POST['update-function'])) {
        // Retrieve form data
        $newQuestion = $_POST['newQuestion'];
        $newDescription = $_POST['newDescription'];

        // Update question details in the database
        $updateQuery = mysqli_query($connect, "UPDATE `questions` SET `question`='$newQuestion', `description`='$newDescription' WHERE `question_id`='$questionId'");
        if ($updateQuery) {
            // Redirect to allQuestions.php after successful update
            header("Location: allQuestions.php");
            exit;
        } else {
            // Handle update error
            echo "Failed to update question.";
        }
    }
} else {
    // If question ID is not provided in the URL, handle error
    echo "Question ID not provided.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Form with Navbar</title>
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
        <a class="navbar-brand" href="./dashboard.php">Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#topNavbar" aria-controls="topNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="topNavbar">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php
                            include("./connection/include.php");
                            $query = mysqli_query($connect, "SELECT * FROM `user` WHERE `user_id`='$_SESSION[user_id]'") or die(mysqli_connect_error());
                            $fetch = mysqli_fetch_array($query);
                            echo "" . $fetch['email'] . " ";
                        ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Change Password</a>
                        <a class="dropdown-item" href="#">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="d-flex">
        <nav class="sidebar sidebar-sticky" style="background-color: #2E4053; color: white;height:700px">
            <ul class="nav flex-column" style="margin-top: 70px;">
                <li class="nav-item">
                    <a class="nav-link active text-white" href="#">
                        <i class="fa fa-list"></i> List Questions
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">
                        <i class="fa fa-comments"></i> Feedbacks
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Main Content -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 mt-5">
            <div class="container shadow-sm">
            <h1>Edit Question</h1>
        <form method="POST" action="">
            <div class="form-group">
                <label for="newQuestion">Question:</label>
                <input type="text" class="form-control" id="newQuestion" name="newQuestion" value="<?php echo $questionData['question']; ?>" required>
            </div>

            <div class="form-group">
                <label for="newDescription">Description:</label>
                <textarea class="form-control" id="newDescription" name="newDescription" rows="3" required><?php echo $questionData['description']; ?></textarea>
            </div>

            <button type="submit" class="btn btn" name="update-function" style="background-color:#2E4053;">Update</button>
        </form>
               
            </div>
        </main>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>