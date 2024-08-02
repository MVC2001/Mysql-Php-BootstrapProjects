<?php
session_start();
include("./connection/include.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category = $_POST['category'];
    $target_dir = "books/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if file is a actual file or fake
    if (isset($_FILES["fileToUpload"])) {
        $check = filesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            echo "File is valid - " . $check . " bytes.";
            $uploadOk = 1;
        } else {
            echo "File is not valid.";
            $uploadOk = 0;
        }
    } else {
        echo "No file was uploaded.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 5000000) { // 5MB limit
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    $allowed_types = array("pdf", "doc", "docx");
    if (!in_array($fileType, $allowed_types)) {
        echo "Sorry, only PDF, DOC, and DOCX files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";

            // Prepare an insert statement
            $sql = "INSERT INTO books (category, up_file) VALUES (?, ?)";
            if ($stmt = $connect->prepare($sql)) {
                // Bind variables to the prepared statement as parameters
                $stmt->bind_param("ss", $category, basename($_FILES["fileToUpload"]["name"]));

                // Attempt to execute the prepared statement
                if ($stmt->execute()) {
                    echo "Records inserted successfully.";
                    header("Location: allBooks.php"); // Redirect to allBooks.php
                    exit(); // Ensure no further code is executed
                } else {
                    echo "Error: Could not execute the query: " . $connect->error;
                }
            } else {
                echo "Error: Could not prepare the query: " . $connect->error;
            }
            // Close statement
            $stmt->close();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
// Close connection
$connect->close();
?>
