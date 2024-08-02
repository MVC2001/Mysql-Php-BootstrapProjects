<?php
session_start();
include("./connection/include.php");

// Check if user is not logged in or not a normal user, then redirect to the login page
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'administrator') {
    header('Location: index.php');
    exit; // Ensure script execution stops after redirection
}

// Handle the answer submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['s_id'])) {
    $s_id = intval($_POST['s_id']);
    $your_answer = $connect->real_escape_string($_POST['your_answer']);
    $is_correct = $connect->real_escape_string($_POST['is_correct']);

    // Update the answer in the database
    $stmt = $connect->prepare("UPDATE quiz SET your_answer = ?, is_correct = ? WHERE s_id = ?");
    if ($stmt === false) {
        die("Error preparing statement: " . $connect->error);
    }
    $stmt->bind_param("ssi", $your_answer, $is_correct, $s_id);
    if (!$stmt->execute()) {
        die("Error executing statement: " . $stmt->error);
    }
    $stmt->close();

    echo "Answer submitted successfully!";
    exit;
}

// Fetch data from the database
$query = "SELECT * FROM quiz ORDER BY id DESC";
$result = mysqli_query($connect, $query);
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
    </style>
</head>
<body>
    <div class="sidebar" style="margin-top:10px">
        <h2 style="color:white">Dashboard</h2>
        <ul class="list-unstyled" style="font-size:20px;color:white;margin-top:30px">
            <li class="text-center"><a href="./dashboard.php" style="color:white">BACK HOME</a></li>
        </ul>
    </div>
    <div class="main-content">
        <div class="table-container">
            <div class="card shadow-sm">
                <div class="card-header bg- text-white" style="background-color:#094469">User Quizzes</div>
                <div class="card-body">
                    <input class="form-control mb-3" id="searchInput" type="text" placeholder="Search...">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>NO#</th>
                                <th>User ID</th>
                                <th>Symbol ID</th>
                                <th>User-Answer</th>
                                 <th>Correct-Answer</th>
                                  <th>Correction</th>
                                <th>Created At</th>
                                <th>Your Answer</th>
                                <th>Correct?</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <?php
                            $count = 1;
                            if ($result) {
                                while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <tr>
                                        <td><?php echo $count; ?></td>
                                        <td><?php echo htmlspecialchars($row['user_id']); ?></td>
                                        <td><?php echo htmlspecialchars($row['s_id']); ?></td>
                                        <td><?php echo htmlspecialchars($row['answer']); ?></td>
                                        <td><?php echo htmlspecialchars($row['your_answer']); ?></td>
                                        <td><?php echo htmlspecialchars($row['is_correct']); ?></td>
                                        <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                                        <td>
                                            <input type="text" class="form-control" required placeholder="Your Answer">
                                        </td>
                                        <td>
                                            <select class="form-control">
                                                <option value="true">True</option>
                                                <option value="false">False</option>
                                            </select>
                                        </td>
                                        <td>
                                            <button class="btn btn" onclick="submitAnswer(<?php echo $row['s_id']; ?>)" style="background-color:#094469;color:white">Submit</button>
                                        </td>
                                    </tr>
                                    <?php $count++; ?>
                                <?php }
                            } else {
                                echo '<tr><td colspan="8">No quizzes found.</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#searchInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#tableBody tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });

        function submitAnswer(sId) {
            console.log("Submit button clicked for s_id: " + sId); // Debugging log
            var row = $('button[onclick="submitAnswer(' + sId + ')"]').closest('tr');
            var yourAnswer = row.find('input[type="text"]').val();
            var isCorrect = row.find('select').val();
            console.log("Your Answer: " + yourAnswer); // Debugging log
            console.log("Is Correct: " + isCorrect); // Debugging log

            // Ajax call to submit the answer
            $.ajax({
                url: '',
                type: 'POST',
                data: {
                    s_id: sId,
                    your_answer: yourAnswer,
                    is_correct: isCorrect
                },
                success: function(response) {
                    console.log(response); // Debugging log
                    alert(response);
                },
                error: function() {
                    alert('Error submitting answer.');
                }
            });
        }
    </script>
</body>
</html>
