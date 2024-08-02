<?php
// Allow cross-origin requests from specific domains
header("Access-Control-Allow-Origin: http://localhost:58557");

// Specify allowed methods (e.g., GET, POST, etc.)
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");

// Set the Content-Type header to JSON
header('Content-Type: application/json');

include './connection.php'; // Include your database connection file

// SQL query
$sql = "SELECT fullName, regNo, yearOfStudy, Course, School, approveForDeanOfSchl,approved3_at FROM permission_tbl WHERE approveForDeanOfSchl='Permissioned_granted'";
$result = $connect->query($sql);

// Check if there are any results
if ($result->num_rows > 0) {
    // Create an array to store the results
    $data = array();

    // Loop through each row in the result set
    while ($row = $result->fetch_assoc()) {
        // Add the row to the data array
        $data[] = $row;
    }

    // Output the data as JSON
    echo json_encode($data);
} else {
    // If no results are found, return an empty JSON array
    echo json_encode(array());
}

// Close the connection
$connect->close();
?>
