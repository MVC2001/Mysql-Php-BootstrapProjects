<?php
session_start();
include("./connection/include.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Weekly Report</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Weekly Report</h2>
        <form id="weeklyReportForm" method="post" action="submit_reports.php">
            <div id="reportEntries">
                <!-- Report Entry Template -->
                <div class="report-entry border p-3 mb-3">
                    <div class="form-group">
                        <label for="day">Day:</label>
                        <input type="text" class="form-control" name="day[]" required>
                    </div>
                    <div class="form-group">
                        <label for="fullName">Full Name:</label>
                        <input type="text" class="form-control" name="fullName[]" required>
                    </div>
                    <div class="form-group">
                        <label for="trainer">Trainer:</label>
                        <input type="text" class="form-control" name="trainer[]" required>
                    </div>
                    <div class="form-group">
                        <label for="activity">Activity:</label>
                        <input type="text" class="form-control" name="activity[]" required>
                    </div>
                    <div class="form-group">
                        <label for="comment">Comment:</label>
                        <textarea class="form-control" name="comment[]" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="report_date">Report Date:</label>
                        <input type="date" class="form-control" name="report_date[]" required>
                    </div>
                </div>
            </div>
            <button type="button" id="addMore" class="btn btn-primary mb-3">Add More</button>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>

    <!-- jQuery and Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            var maxEntries = 5;
            var entryCount = 1;

            $('#addMore').click(function() {
                if (entryCount < maxEntries) {
                    var newEntry = $('.report-entry').first().clone();
                    newEntry.find('input, textarea').val('');
                    $('#reportEntries').append(newEntry);
                    entryCount++;
                } else {
                    alert('You can only add up to ' + maxEntries + ' entries.');
                }
            });
        });
    </script>
</body>
</html>
