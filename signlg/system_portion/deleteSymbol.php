<!-- delete.php -->

<?php
session_start();
include("./connection/include.php");

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "DELETE FROM symbols_tbl WHERE s_id = $id";

    if ($connect->query($sql) === TRUE) {
         header("location: allSymbols.php");
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>
