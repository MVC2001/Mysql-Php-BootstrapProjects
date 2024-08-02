<?php
session_start();
include("./connection/include.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Clearance Forms</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>View Clearance Forms</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Index No</th>
                    <th>Year of Study</th>
                    <th>ClearanceForm</th>
                    <th>PDF</th>
                </tr>
            </thead>
            <tbody>
                <?php
               
                $sql = "SELECT * FROM clearance_forms";
                $result = $connect->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>".$row["id"]."</td>
                                <td>".$row["fullName"]."</td>
                                <td>".$row["indexNo"]."</td>
                                <td>".$row["yearOfStudy"]."</td>
                                 <td>".$row["file_upload"]."</td>
                                <td><a href='uploads/".$row["file_upload"]."' target='_blank'>View PDF</a></td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No records found</td></tr>";
                }
                $connect->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
