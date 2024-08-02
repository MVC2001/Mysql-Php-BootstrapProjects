<!-- delete.php -->

<?php
include("./connection/include.php");
$id = $_REQUEST['id'];
$query = "DELETE FROM contact WHERE id=$id";
$result = mysqli_query($connect, $query) or die(mysqli_error($connect));

// Check if deletion was successful
if ($result) {
    // Redirect to view.php with success message
    header("Location: ./viewmessage.php?success=1");
} else {
    // Redirect to view.php with failure message
    header("Location: ./viewmessage.php?success=0");
}
exit();
