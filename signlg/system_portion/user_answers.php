<?php
session_start();
include("./connection/include.php");

// Check if user is not logged in or not an admin, then redirect to login page
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'normal_user') {
    header('Location: index.php');
    exit; // Ensure script execution stops after redirection
}

// Fetch data from the database using prepared statement
$query = "SELECT quiz.*, users.user_id AS user_id 
          FROM quiz 
          JOIN users ON quiz.user_id = users.user_id 
          WHERE users.user_id = ? AND (is_correct = 'false' OR is_correct = 'true')
          ORDER BY quiz.id DESC";
$stmt = mysqli_prepare($connect, $query);
mysqli_stmt_bind_param($stmt, "i", $_SESSION['user_id']);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="description" content="Dashboard">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }
        .sidebar {
            background-color: #094469;
            width: 250px;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            padding: 20px;
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
            flex-grow: 1;
        }
        .card {
            margin: auto;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        .table-container {
            margin: auto;
            max-width: 1000px;
        }
        .icon {
            font-size: 1.2em;
            vertical-align: middle;
        }
        .tick {
            color: green;
        }
        .cross {
            color: red;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2 style="color:white">Dashboard</h2>
        <ul class="list-unstyled" style="font-size:20px;color:white;margin-top:30px">
            <li class="text-center"><a href="./quiz.php" style="color:white">BACK HOME</a></li>
        </ul>
    </div>
    <div class="main-content">
        <div class="table-container">
            <div class="card shadow-sm">
                <div class="card-header bg- text-white" style="background-color:#094469">User Answers</div>
                <div class="card-body">
                    <input class="form-control mb-3" id="searchInput" type="text" placeholder="Search...">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>NO#</th>
                                <th>Symbol ID</th>
                                <th>Submitted Answer</th>
                                <th>Correction</th>
                                <th>Correct Answer</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <?php
                            $count = 1;
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $submitted_answer = htmlspecialchars($row['answer']);
                                    $correct_answer = htmlspecialchars($row['your_answer']);
                                    $icon_class = ($submitted_answer === $correct_answer) ? 'tick' : 'cross';
                                    $icon_text = ($submitted_answer === $correct_answer) ? '✔' : '❌';
                                    ?>
                                    <tr>
                                        <td><?php echo $count; ?></td>
                                        <td><?php echo htmlspecialchars($row['s_id']); ?></td>
                                        <td><?php echo $submitted_answer; ?></td>
                                        <td><span class="icon <?php echo $icon_class; ?>"><?php echo $icon_text; ?></span></td>
                                        <td><?php echo $correct_answer; ?></td>
                                    </tr>
                                    <?php $count++;
                                }
                            } else {
                                echo '<tr><td colspan="5">No quizzes found.</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
