<?php
session_start();
include("./connection/include.php");

// Check if user is not logged in or not an admin, then redirect to login page
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'staff') {
    header('location:Error404.php');
    exit; // Ensure script execution stops after redirection
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
        <a class="navbar-brand" href="#">Dashboard</a>
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
                        <a class="dropdown-item" href="./changePassword.php">Change Password</a>
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
                    <a class="nav-link active text-white" href="./allQuestions.php" style="font-size:21px">
                        <i class="fa fa-users"></i> Questions here
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="./yourResponse.php" style="font-size:21px">
                        <i class="fa fa-comments"></i>Responses here
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Main Content -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 mt-5">
            <div class="container shadow-sm">
            <div class="row">
            <div class="col-md-6">
            <div class="card text-center" style="height:100px;box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
                          <hr><a href="./allQuestions.php"><i class="fa fa-users"></i>Your Questins</a>
                             <?php
                           $countv = mysqli_query($connect,"SELECT questions.question_id, questions.user_id, questions.question, questions.description, questions.created_at, user.user_id  FROM questions JOIN user ON questions.user_id = user.user_id  WHERE questions.user_id = $_SESSION[user_id] order by question_id desc") or die(mysqli_error($connect));
                                $countv = mysqli_num_rows($countv);
                                    if(empty($countv) >= 0){  ?>
                                    <div class="stat-digit"><?php echo $countv;?></div>
                                    <?php }?>
            </div>
            </div>


             <div class="col-md-6">
            <div class="card text-center" style="height:100px;box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
                          <hr> <a href="./yourResponse.php"><i class="fa fa-list"></i> Your Answers/Responses</a>
                             <?php
                           $countv = mysqli_query($connect,"SELECT answers.answer_id,answers.created_at,answers.question_id,answers.courseCode , answers.user_id, answers.answer, user.user_id  FROM answers JOIN user ON answers.courseCode = user.courseCode  WHERE user.user_id = $_SESSION[user_id] order by answer_id  desc") or die(mysqli_error($connect));
                                $countv = mysqli_num_rows($countv);
                                    if(empty($countv) >= 0){  ?>
                                    <div class="stat-digit"><?php echo $countv;?></div>
                                    <?php }?>
            </div>
            </div>

            
          
 
            </div>
            <hr style="width:100%;height:8px;background-color: #2E4053">
            </div>
        </main>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const addQuestionButton = document.getElementById('addQuestionButton');
            const questionsTableBody = document.getElementById('questionsTableBody');
            const searchInput = document.getElementById('searchInput');

            addQuestionButton.addEventListener('click', () => {
                const newRow = document.createElement('tr');
                newRow.innerHTML = `
                    <td>New ID</td>
                    <td>New Question</td>
                    <td>New Description</td>
                    <td>
                        <button class="btn btn-primary btn-sm mr-2">Update</button>
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </td>
                `;
                questionsTableBody.appendChild(newRow);
            });

            searchInput.addEventListener('input', () => {
                const searchTerm = searchInput.value.toLowerCase();
                const rows = questionsTableBody.getElementsByTagName('tr');

                Array.from(rows).forEach(row => {
                    const cells = row.getElementsByTagName('td');
                    const id = cells[0].textContent.toLowerCase();
                    const question = cells[1].textContent.toLowerCase();
                    const description = cells[2].textContent.toLowerCase();

                    if (id.includes(searchTerm) || question.includes(searchTerm) || description.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });
    </script>
</body>
</html>
