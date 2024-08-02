<?php
include "connection.php";
session_start();

if (!isset($_SESSION['student_id'])) {
    header("Location: index.php");
    exit();
}

$email = $_SESSION['email'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
   <div class="card">
   
    <h1>Welcome to the Dashboard</h1>
    <p>Your email: <?php echo $email; ?></p>
    <a href="logout.php">Logout</a>

    </div>
</body>
</html>