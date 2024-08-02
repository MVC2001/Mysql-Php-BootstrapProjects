<?php
session_start();
include("./connection/include.php");

// Check if user is not logged in or not an admin, then redirect to login page
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'normal_user') {
    header('Location: index.php');
    exit; // Ensure script execution stops after redirection
}

// Fetch data from the database
$query = "SELECT receiversms.contact_id, receiversms.email, receiversms.message, receiversms.created_at, users.email FROM receiversms JOIN users ON receiversms.email = users.email WHERE users.user_id = '{$_SESSION['user_id']}' ORDER BY receiversms.contact_id DESC";
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
            <li class="text-center"><a href="./all-lists.php" style="color:white">BACK HOME</a></li>
        </ul>
    </div>
    <div class="main-content">
        <div class="table-container">
            <div class="card shadow-sm">
                <div class="card-header bg- text-white" style="background-color:#094469">User Messages</div>
                <div class="card-body">
                    <input class="form-control mb-3" id="searchInput" type="text" placeholder="Search...">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>NO#</th>
                                <th>Receiver Email</th>
                                <th>Message</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <?php
                            $count = 1;
                            if ($result) {
                                while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <tr>
                                        <td><?php echo $count; ?></td>
                                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                                        <td><?php echo htmlspecialchars($row['message']); ?></td>
                                        <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                                    </tr>
                                    <?php $count++; ?>
                                <?php }
                            } else {
                                echo '<tr><td colspan="4">No messages found.</td></tr>';
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
    <script>
        $(document).ready(function() {
            $("#searchInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#tableBody tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
</body>
</html>
