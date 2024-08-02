<?php
session_start();
include("./connection/include.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $fullName = $_POST['fullName'];
    $trainer = $_POST['trainer'];
    $reportDate = $_POST['report_date'];
    $activities = $_POST['activity'];
    $comment = $_POST['comment'];

    // Insert data into the database
    $success = true;
    foreach ($activities as $activity) {
        $sql = "INSERT INTO fieldreport (fullName, trainer, report_date, activity, comment) VALUES ('$fullName', '$trainer', '$reportDate', '$activity', '$comment')";
        if (!mysqli_query($connect, $sql)) {
            $success = false;
            break;
        }
    }

    if ($success) {
        $_SESSION['success'] = "Data inserted successfully!";
    } else {
        $_SESSION['error'] = "Error inserting data into the database.";
    }

    // Redirect back to the form page
    header("Location: your_form_page.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags, CSS links, etc. -->
</head>
<body id="page-top">
    <!-- HTML content, including your form -->
    <form class="form-inline" action="" method="POST" id="reportForm">
        <!-- Your form fields -->
        <div class="card">
            <div class="card-body">
                <!-- Fields for full name, trainer, report date -->
                <div class="form-row">
                    <!-- Your input fields for full name, trainer, report date -->
                </div>
                <!-- Fields for activities -->
                <div id="activityContainer">
                    <div class="form-row">
                        <div class="col-sm-6 mt-2 mt-sm-0">
                            <input name="activity[]" type="text" class="form-control" placeholder="Enter activity">
                        </div>
                    </div>
                </div>
                <!-- Button to add more activity fields -->
                <button type="button" class="btn btn-success mb-2" id="addActivityBtn">Add More Activities</button>
                <!-- Submit button -->
                <button type="submit" name="add-function" class="btn btn-primary mb-2">Add</button>
            </div>
        </div>
    </form>

    <!-- JavaScript code to handle adding more activity fields -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("addActivityBtn").addEventListener("click", function() {
                // Create a new activity input field
                var activityField = document.createElement("div");
                activityField.classList.add("form-row");
                activityField.innerHTML = `
                    <div class="col-sm-6 mt-2 mt-sm-0">
                        <input name="activity[]" type="text" class="form-control" placeholder="Enter activity">
                    </div>
                `;
                // Append the new activity field to the container
                document.getElementById("activityContainer").appendChild(activityField);
            });
        });
    </script>
</body>
</html>
