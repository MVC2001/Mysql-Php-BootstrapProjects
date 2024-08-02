<?php
session_start();
include("./connection/include.php");

// Check if user is not logged in or not a student, then redirect to Error404 page
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header('location:Error404.php');
    exit; // Ensure script execution stops after redirection
}

// Initialize an array to store answered question IDs
$answeredQuestions = [];

// Handle the submission of multiple answers
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['answers'])) {
    $answers = $_POST['answers'];
    $user_id = $_SESSION['user_id'];

    foreach ($answers as $question_id => $answer) {
        // Handle answer submission
        $stmt = $connect->prepare("SELECT answer_count FROM answers WHERE question_id = ? AND user_id = ?");
        $stmt->bind_param("ii", $question_id, $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // User has already answered, check answer count
            $row = $result->fetch_assoc();
            $answer_count = $row['answer_count'];

            if ($answer_count >= 1) {
                // If answer count reaches 1, skip updating the answer
                continue;
            }

            // Update the existing answer and increment the answer count
            $answer_count++;
            $updateStmt = $connect->prepare("UPDATE answers SET answer = ?, answer_count = ? WHERE question_id = ? AND user_id = ?");
            $updateStmt->bind_param("siii", $answer, $answer_count, $question_id, $user_id);
            $updateStmt->execute();
        } else {
            // Insert a new answer with answer count = 1
            $insertStmt = $connect->prepare("INSERT INTO answers (question_id, user_id, answer, answer_count) VALUES (?, ?, ?, 1)");
            $insertStmt->bind_param("iis", $question_id, $user_id, $answer);
            $insertStmt->execute();
        }

        // Track answered questions
        $answeredQuestions[] = $question_id;
    }

    // Redirect after processing
    header('Location: student.php');
    exit();
}

// Fetch the list of courseCodes with questions for the sidebar
$courseCodes = [];
$user_id = $_SESSION['user_id'];

// Fetch user program
$stmt = $connect->prepare("SELECT program FROM user WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$userProgram = $result->fetch_assoc()['program'];

// Fetch courseCodes for the user's program
$stmt = $connect->prepare("SELECT DISTINCT courseCode FROM questions WHERE program = ?");
$stmt->bind_param("s", $userProgram);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    // Check if there are questions for the courseCode
    $stmt = $connect->prepare("SELECT COUNT(*) as question_count FROM questions WHERE courseCode = ?");
    $stmt->bind_param("s", $row['courseCode']);
    $stmt->execute();
    $questionCheckResult = $stmt->get_result()->fetch_assoc();
    if ($questionCheckResult['question_count'] > 0) {
        $courseCodes[] = $row['courseCode'];
    }
}

// Fetch questions if a courseCode is selected
$questions = [];
if (isset($_GET['courseCode'])) {
    $selectedCourseCode = $_GET['courseCode'];

    // Fetch questions matching the user's program and courseCode, excluding answered questions with answer_count >= 1
    $stmt = $connect->prepare("SELECT q.question_id, q.question, q.description, q.created_at 
                               FROM questions q 
                               LEFT JOIN answers a ON q.question_id = a.question_id AND a.user_id = ? 
                               WHERE q.courseCode = ? 
                               AND q.program = ?
                               AND (a.answer_count IS NULL OR a.answer_count < 1)
                               AND (SELECT COUNT(DISTINCT user_id) FROM answers WHERE question_id = q.question_id) < 5
                               ORDER BY q.question_id DESC");
    $stmt->bind_param("iss", $user_id, $selectedCourseCode, $userProgram);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $questions[] = $row;
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
            background-color: #2E4053;
            color: white;
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
            color: white;
        }
        .sidebar .nav-link.active {
            color: #F8C407;
        }
    </style>
</head>
<body>
    <!-- Top Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <a class="navbar-brand" href="./student.php">Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#topNavbar" aria-controls="topNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="topNavbar">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php
                        $stmt = $connect->prepare("SELECT * FROM user WHERE user_id = ?");
                        $stmt->bind_param("i", $_SESSION['user_id']);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $fetch = $result->fetch_assoc();
                        echo "" . htmlspecialchars($fetch['email']) . " ";
                        ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="./changePasswordV2.php">Change Password</a>
                        <a class="dropdown-item" href="./logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <div class="d-flex">
        <!-- Sidebar (only show if there are courseCodes) -->
        <?php if (count($courseCodes) > 0) { ?>
            <nav class="sidebar sidebar-sticky" style="width:300px">
                <ul class="nav flex-column" style="margin-top: 70px;">
                    <li class="nav-item">
                        <a class="nav-link active text-white" href="">
                            <i class="fa fa-list"></i> Questions Lists
                        </a>
                    </li>
                    <?php foreach ($courseCodes as $courseCode) { ?>
                        <li class="nav-item text-center">
                            <a class="nav-link <?php if (isset($_GET['courseCode']) && $_GET['courseCode'] == $courseCode) echo 'active'; ?>" href="?courseCode=<?php echo htmlspecialchars($courseCode); ?>">
                                <i class="fa fa-book"></i> <?php echo htmlspecialchars($courseCode); ?>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </nav>
        <?php } ?>
        
        <!-- Main Content -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 mt-5">
            <div class="container shadow-sm">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1>All Questions</h1>
                </div>

                <form method="POST" action="">
                    <div class="row" id="questionsContainer">
                        <?php if (count($questions) > 0) { ?>
                            <?php foreach ($questions as $question) { ?>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Question: <?php echo htmlspecialchars($question['question']); ?></h5>
                                            <p class="card-text"><?php echo htmlspecialchars($question['description']); ?></p>
                                            <div class="form-group">
                                                <label for="answer_<?php echo $question['question_id']; ?>">Your Answer</label>
                                                <textarea class="form-control" id="answer_<?php echo $question['question_id']; ?>" name="answers[<?php echo $question['question_id']; ?>]" rows="3" required><?php
                                                    // Check if the question ID is in answeredQuestions array
                                                    if (in_array($question['question_id'], $answeredQuestions)) {
                                                        // Fetch and display the user's answer
                                                        $stmt = $connect->prepare("SELECT answer FROM answers WHERE question_id = ? AND user_id = ?");
                                                        $stmt->bind_param("ii", $question['question_id'], $user_id);
                                                        $stmt->execute();
                                                        $result = $stmt->get_result();
                                                        $row = $result->fetch_assoc();
                                                        echo htmlspecialchars($row['answer']);
                                                    }
                                                ?></textarea>
                                                <?php
                                                // Display warning if user has answered this question 1 time
                                                if (in_array($question['question_id'], $answeredQuestions)) {
                                                    $stmt = $connect->prepare("SELECT answer_count FROM answers WHERE question_id = ? AND user_id = ?");
                                                    $stmt->bind_param("ii", $question['question_id'], $user_id);
                                                    $stmt->execute();
                                                    $result = $stmt->get_result();

                                                    if ($result->num_rows > 0) {
                                                        $row = $result->fetch_assoc();
                                                        $answer_count = $row['answer_count'];
                                                        if ($answer_count >= 1) {
                                                            echo '<div class="alert alert-warning mt-2" role="alert">You have reached the maximum limit of 1 answer for this question.</div>';
                                                        }
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } else { ?>
                            <div class="col-12">
                                <div class="alert alert-info" role="alert">
                                    No questions available for the selected course.
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <?php if (count($questions) > 0) { ?>
                        <div class="form-group text-center mt-4">
                            <button type="submit" class="btn btn-" style=" background-color: #2E4053;color:white">Submit Answers</button>
                        </div>
                    <?php } ?>
                </form>
            </div>
        </main>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
