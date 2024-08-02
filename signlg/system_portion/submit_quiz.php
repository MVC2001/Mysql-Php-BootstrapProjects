<?php
session_start();
include("./connection/include.php");

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'normal_user') {
    header('location:index.php');
    exit; // Ensure script execution stops after redirection
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $answers = $_POST['answers'];

    // Fetch all s_ids from symbols_tbl
    $stmt_select = $connect->prepare("SELECT s_id FROM symbols_tbl");
    $stmt_select->execute();
    $result_select = $stmt_select->get_result();

    $s_ids = [];
    while ($row = $result_select->fetch_assoc()) {
        $s_ids[] = $row['s_id'];
    }

    // Assuming answers and s_ids are arrays of equal length
    foreach ($s_ids as $symbol_id) {
        // Check if the symbol_id exists in the answers array
        if (array_key_exists($symbol_id, $answers)) {
            $answer = $answers[$symbol_id];

            // Insert into quiz table
            $stmt_insert = $connect->prepare("INSERT INTO quiz (s_id, answer, user_id) VALUES (?, ?, ?)");
            $stmt_insert->bind_param("isi", $symbol_id, $answer, $user_id);
            $stmt_insert->execute();
            $stmt_insert->close();
        }
    }

    echo "Answers submitted successfully!";
}

$connect->close();
?>
