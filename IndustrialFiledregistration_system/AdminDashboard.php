<?php
include "connection.php";
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}

$email = $_SESSION['email'];

// Fetch students from the database
$query = "SELECT * FROM students";
$result = mysqli_query($conn, $query);

$cout_students= 1;
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
     
    <!------------lists of students-------->
    <div class="container text-center">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No#</th>
                            <th>Name</th>
                            <th>PhoneNumber</th>
                            <th>Program</th>
                            <th>Email</th>
                            <th>Course</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                              <td><?php echo $cout_students ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['phoneNumber']; ?></td>
                                <td><?php echo $row['program']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['course']; ?></td>
                                  <td><?php echo $row['status']; ?></td>
                                <td>
                                    <a href="approveStudent.php?student_id=<?php echo $row['student_id']; ?>" class="btn btn-primary">Approve</a>
                                </td>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               
                            </tr>

                            <?php $cout_students++ ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
          </div>
        </div>
    </div>
    <!--------------ends here-------------->
    </div>
</body>
</html>
