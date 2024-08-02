<!-- delete.php -->

<?php
session_start();
include("./connection/include.php");

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "DELETE FROM alphabet WHERE id = $id";

    if ($connect->query($sql) === TRUE) {
         header("location: all_alphabet.php");
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>
