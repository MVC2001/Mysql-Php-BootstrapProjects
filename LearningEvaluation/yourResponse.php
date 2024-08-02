<?php
session_start();
include("./connection/include.php");

// Check if user is not logged in or not an admin, then redirect to login page
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'staff') {
    header('location: Error404.php');
    exit; // Ensure script execution stops after redirection
}

// Fetch answers for current user
$select = "SELECT answers.answer_id, answers.created_at, answers.question_id, answers.courseCode, answers.user_id, answers.answer, user.user_id 
           FROM answers 
           JOIN user ON answers.courseCode = user.courseCode  
           WHERE user.user_id = $_SESSION[user_id] 
           ORDER BY answer_id DESC";
$result = mysqli_query($connect, $select);

// Function to count matching answers
function countMatches($answers) {
    $matchCounts = array_count_values($answers);
    arsort($matchCounts);
    return $matchCounts;
}

// Fetch all answers and count matches
$answers = array();
while ($row = mysqli_fetch_assoc($result)) {
    $answers[] = $row['answer'];
}

// Count and sort answers by frequency
$matchCounts = countMatches($answers);

// Get the most matched answer (first element in sorted array)
$mostMatchedAnswer = key($matchCounts); // This gives the answer with the highest count

// Fetch at least matched answers (those with a count > 1)
$atLeastMatchedAnswers = array_filter($matchCounts, function($count) {
    return $count > 1;
});
$atLeastMatchedAnswers = array_keys($atLeastMatchedAnswers);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard</title>
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
        .card-shadow-large {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease-in-out;
        }
        .card-shadow-large:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
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
                        <?php
                        $query = mysqli_query($connect, "SELECT * FROM `user` WHERE `user_id`='$_SESSION[user_id]'") or die(mysqli_connect_error());
                        $fetch = mysqli_fetch_array($query);
                        echo "" . $fetch['email'] . " ";
                        ?>
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
                <!-- Add your sidebar items here -->
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
                <!-- Most Matched Answer Section -->
                <div class="alert alert-info mb-4">
                    <strong>Most Matched Answer: </strong><?php echo htmlspecialchars($mostMatchedAnswer); ?>
                </div>

                <!-- At Least Matched Answers Section -->
                <?php if (!empty($atLeastMatchedAnswers)) : ?>
                    <div class="alert alert-success mb-4">
                        <strong>At Least Matched Answers: </strong>
                        <?php echo implode(', ', array_map('htmlspecialchars', $atLeastMatchedAnswers)); ?>
                    </div>
                <?php endif; ?>

                <!-- Table for answers -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1>All Answers</h1>
                </div>

                <input class="form-control mb-3" id="searchInput" type="text" placeholder="Search...">

                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>No#</th>
                            <th>Question ID</th>
                            <th>Answer</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody id="questionsTableBody">
                        <?php
                        $count = 1;
                        mysqli_data_seek($result, 0); // Reset result pointer to fetch data again
                        while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td><?php echo $count ?></td>
                                <td><?php echo $row['question_id']; ?></td>
                                <td><?php echo $row['answer']; ?></td>
                                <td><?php echo $row['created_at']; ?></td>
                            </tr>
                            <?php $count++;
                        } ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Toast Notification -->
    <div aria-live="polite" aria-atomic="true" style="position: fixed; top: 20px; right: 20px; z-index: 1000;">
        <div class="toast" id="relatedToast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000">
            <div class="toast-header">
                <strong class="mr-auto">Related Answer Found</strong>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">
                An answer matches your search term.
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Answers Matching Search Term</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Placeholder for answers -->
                    <ul id="matchingAnswersList" class="list-group"></ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const searchInput = document.getElementById('searchInput');
            const questionsTableBody = document.getElementById('questionsTableBody');
            const notificationCard = document.getElementById('notificationCard');
            const matchingAnswersList = document.getElementById('matchingAnswersList');

            searchInput.addEventListener('input', () => {
                const searchTerm = searchInput.value.trim().toLowerCase();
                const rows = questionsTableBody.getElementsByTagName('tr');
                let relatedFound = false;
                let startWithTwoFound = false;

                Array.from(rows).forEach(row => {
                    const cells = row.getElementsByTagName('td');
                    const answer = cells[2].textContent.trim().toLowerCase();

                    if (answer.includes(searchTerm)) {
                        row.style.display = '';
                        relatedFound = true;

                        // Check if answer starts with two
                        if (answer.startsWith("two")) {
                            startWithTwoFound = true;
                        }
                    } else {
                        row.style.display = 'none';
                    }
                });

                if (relatedFound) {
                    $('#relatedToast').toast('show');
                }

                // Show notification card if start with two found
                if (startWithTwoFound) {
                    notificationCard.style.display = 'block';
                } else {
                    notificationCard.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>
