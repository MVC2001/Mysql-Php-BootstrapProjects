<?php
session_start();
include("./connection/include.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $courseCode = $_POST['courseCode'];	
    $program = $_POST['program'];	
    $questions = $_POST['questions']; // This will be an array
    $description = $_POST['description'];

    $successCount = 0;
    $errorCount = 0;

    $sql = "INSERT INTO questions (user_id,courseCode,program, question, description) VALUES (?,?,?,?,?)";

    if ($stmt = $connect->prepare($sql)) {
        foreach ($questions as $question) {
            $stmt->bind_param("sssss", $user_id,$courseCode,$program, $question, $description);
            if ($stmt->execute()) {
                $successCount++;
            } else {
                $errorCount++;
            }
        }

        if ($errorCount == 0) {
            $_SESSION['success'] = "All questions added successfully!";
        } else {
            $_SESSION['error'] = "$errorCount questions failed to add.";
        }

        $stmt->close();
    } else {
        $_SESSION['error'] = "Error: " . $connect->error;
    }

    $connect->close();
    header("Location: allQuestions.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add question</title>
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
                        User
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
                    <a class="nav-link active text-white" href="./allQuestions.php">
                        <i class="fa fa-list"></i> List Questions
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="./yourResponse.php">
                        <i class="fa fa-comments"></i> Feedbacks/Responses
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Main Content -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 mt-5">
            <div class="container shadow-sm">
                <!-- Alert Message -->
                <?php
               
                if (isset($_SESSION['success'])) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">' .
                         $_SESSION['success'] .
                         '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' .
                         '<span aria-hidden="true">&times;</span></button></div>';
                    unset($_SESSION['success']);
                }
                if (isset($_SESSION['error'])) {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">' .
                         $_SESSION['error'] .
                         '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' .
                         '<span aria-hidden="true">&times;</span></button></div>';
                    unset($_SESSION['error']);
                }
                ?>

                <!-- Form for Adding Questions -->
                <form id="dynamicForm" action="" method="POST">
                    <div class="form-group">
                      
                        <input name="user_id" required type="hidden" <?php 
                                          $select_all = "select user_id from user  WHERE `user_id`='$_SESSION[user_id]'" or die(mysqli_error($connect));
                                          $result = mysqli_query($connect,$select_all);
                                          $number = mysqli_num_rows($result);
                                             if ($number > 0) {
                                           while($row = mysqli_fetch_assoc($result)) { ?>
                                             value=
                                                "<?php echo $row['user_id']; ?>"
                                           <?php } } ?>
                                                
                                                class="form-control">
                    </div>
                    <div class="form-group">
                      
                        <input name="courseCode" required type="hidden" <?php 
                                          $select_all = "select user_id,courseCode from user  WHERE `user_id`='$_SESSION[user_id]'" or die(mysqli_error($connect));
                                          $result = mysqli_query($connect,$select_all);
                                          $number = mysqli_num_rows($result);
                                             if ($number > 0) {
                                           while($row = mysqli_fetch_assoc($result)) { ?>
                                             value=
                                                "<?php echo $row['courseCode']; ?>"
                                           <?php } } ?>
                                                
                                                class="form-control">
                    </div>

                     <div class="form-group">
                      
                        <input name="program" required type="hidden" <?php 
                                          $select_all = "select user_id,program from user  WHERE `user_id`='$_SESSION[user_id]'" or die(mysqli_error($connect));
                                          $result = mysqli_query($connect,$select_all);
                                          $number = mysqli_num_rows($result);
                                             if ($number > 0) {
                                           while($row = mysqli_fetch_assoc($result)) { ?>
                                             value=
                                                "<?php echo $row['program']; ?>"
                                           <?php } } ?>
                                                
                                                class="form-control">
                    </div>
                    
                    <div id="questionsContainer">
                        <div class="form-group question">
                            <label for="question1">Question 1:</label>
                            <div class="d-flex">
                                <input type="text" class="form-control" id="question1" name="questions[]" required>
                                <button type="button" class="btn btn-danger ml-2 remove-question">Cancel</button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea class="form-control" id="description" name="description" required></textarea>
                    </div>
                    
                    <button type="button" class="btn btn-secondary" id="addQuestionButton" style="background-color:#2E4053;">Add Another Question</button>
                    <button type="submit" class="btn btn-primary" style="background-color:#2E4053;">Submit</button>
                </form>

              
            </div>
        </main>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            let questionCount = 1;

            document.getElementById('addQuestionButton').addEventListener('click', () => {
                questionCount++;
                const questionsContainer = document.getElementById('questionsContainer');
                
                const newQuestionDiv = document.createElement('div');
                newQuestionDiv.classList.add('form-group', 'question');
                
                const newQuestionLabel = document.createElement('label');
                newQuestionLabel.setAttribute('for', `question${questionCount}`);
                newQuestionLabel.textContent = `Question ${questionCount}:`;

                const questionInputDiv = document.createElement('div');
                questionInputDiv.classList.add('d-flex');

                const newQuestionInput = document.createElement('input');
                newQuestionInput.setAttribute('type', 'text');
                newQuestionInput.classList.add('form-control');
                newQuestionInput.setAttribute('id', `question${questionCount}`);
                newQuestionInput.setAttribute('name', 'questions[]');
                newQuestionInput.required = true;

                const cancelButton = document.createElement('button');
                cancelButton.setAttribute('type', 'button');
                cancelButton.classList.add('btn', 'btn-danger', 'ml-2', 'remove-question');
                cancelButton.textContent = 'Cancel';

                questionInputDiv.appendChild(newQuestionInput);
                questionInputDiv.appendChild(cancelButton);

                newQuestionDiv.appendChild(newQuestionLabel);
                newQuestionDiv.appendChild(questionInputDiv);
                questionsContainer.appendChild(newQuestionDiv);
            });

            document.getElementById('questionsContainer').addEventListener('click', (e) => {
                if (e.target && e.target.matches('.remove-question')) {
                    const questionDiv = e.target.closest('.question');
                    questionDiv.remove();
                    questionCount--;
                    updateQuestionLabels();
                }
            });

            function updateQuestionLabels() {
                const questionDivs = document.querySelectorAll('.question');
                questionDivs.forEach((div, index) => {
                    const label = div.querySelector('label');
                    const input = div.querySelector('input');
                    label.textContent = `Question ${index + 1}:`;
                    input.setAttribute('id', `question${index + 1}`);
                });
            }
        });
    </script>
</body>
</html>
