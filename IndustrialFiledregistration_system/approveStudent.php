<?php
include "connection.php";
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}



$student_id = $_GET['student_id'];
$query = "SELECT * FROM students WHERE student_id=$student_id";
$result = mysqli_query($conn, $query);
$student = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1>Edit Student</h1>
        <form method="POST" action="editStudent.php">
            <input type="hidden" name="student_id" value="<?php echo $student['student_id']; ?>">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $student['name']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="phoneNumber" class="form-label">Phone Number</label>
                <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" value="<?php echo $student['phoneNumber']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="program" class="form-label">Program</label>
                <input type="text" class="form-control" id="program" name="program" value="<?php echo $student['program']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $student['email']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="course" class="form-label">Course</label>
                <input type="text" class="form-control" id="course" name="course" value="<?php echo $student['course']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                                          <select type="text" name="status" required class="form-control">
                                          <option value="">--Selct-----to approve--------</option>
                                           <option value="active">Active</option>
                                           <option value="not-active">Not-active</option>
                                           </select>
            </div>
            
            <button type="submit" class="btn btn-primary" name="update">Approve</button>
        </form>
    </div>
</body>
</html>



                                         