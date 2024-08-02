<?php
session_start();
include("./connection/include.php");

// Check if user is not logged in or not an admin, then redirect to login page
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'staff') {
    header('location:Error404.php');
    exit; // Ensure script execution stops after redirection
}

//delete logic 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if user_id is set and not empty
    if (isset($_POST['question_id']) && !empty($_POST['question_id'])) {
        $question_id = $_POST['question_id'];
        
        // Delete the user from the database
        $deleteQuery = mysqli_query($connect, "DELETE FROM `questions` WHERE `question_id` = $question_id");
        
        if ($deleteQuery) {
            // User deleted successfully
            header('Location: allQuestions.php'); // Redirect to users page
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
                 
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="./yourResponse.php">
                        <i class="fa fa-comments"></i> Feedbacks
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Main Content -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 mt-5">
            <div class="container shadow-sm">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1>All Questins</h1>
                    <a href="./addQueston.php"><button type="button" class="btn btn-secondary" id="addQuestionButton" style="background-color:#2E4053;">Add question</button></a>
                </div>

                <input class="form-control mb-3" id="searchInput" type="text" placeholder="Search...">
                
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Questin</th>
                            <th>Description</th>
                            <th>created_at</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="questionsTableBody">
                            <?php 
                 $count=1;
                 $select = "SELECT questions.question_id, questions.user_id, questions.question, questions.description, questions.created_at, user.user_id  FROM questions JOIN user ON questions.user_id = user.user_id  WHERE questions.user_id = $_SESSION[user_id] order by question_id desc";
                 $result = mysqli_query($connect,$select);
                 $number = mysqli_num_rows($result);
                 if ($number > 0) {
                     while($row = mysqli_fetch_assoc($result)) { ?>
                                        <tr>
                                     <td><?php echo $count ?></td>
                                <td><?php echo $row['question']; ?></td>
                                <td><?php echo $row['description']; ?></td>
                                <td><?php echo $row['created_at']; ?></td>
                             
                                                <td>
                                    <a href="edit_question.php?question_id=<?php echo $row['question_id'] ?>">
                                    <button class="btn btn-warning btn-sm">
                                    <i class="fa fa-edit"></i></button> </a>
                                    <span>
                                    <td>
                                    <form action="" method="POST">
                                       <input type="hidden" name="question_id" value="<?php echo $row['question_id']; ?>">
                                                 <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this question?')">
                                  <i class="fa fa-trash"></i>
                              </button>
                            </form>
</td>
                                            
                                        </tr>
                                       <?php $count++?>
                        <?php }} ?>
                        
                    </tbody>
                </table>
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
