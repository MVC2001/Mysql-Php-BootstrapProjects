<?php
include './connection/include.php';

// Query to select all answers from the answers table
$sql = "SELECT answer FROM answers";

$result = $connect->query($sql);

if ($result->num_rows > 0) {
    // Initialize counter for matches
    $matchCount = 0;

    // Array to store fetched answers
    $answers = array();

    // Fetch all rows and store them in the $answers array
    while($row = $result->fetch_assoc()) {
        $answers[] = $row['answer'];
    }

    // Check for matching answers
    $matchCount = countMatches($answers);

    // Output results
    if ($matchCount > 0) {
        echo "Total matching answers found: $matchCount";
    } else {
        echo "No matching answers found.";
    }
    
    // Notify if matches found using JavaScript
    if ($matchCount > 0) {
        echo '<script>';
        echo 'setTimeout(function() {';
        echo '  $("#matchingAnswersModal").modal("show");'; // Show modal after a delay
        echo '}, 2000);'; // Delay in milliseconds (2000ms = 2 seconds)
        echo '</script>';
    }
} else {
    echo "No answers found in the database.";
}

$connect->close();

// Function to count matching answers
function countMatches($answers) {
    $matchCount = 0;
    // Example comparison logic (simple match check)
    for ($i = 0; $i < count($answers) - 1; $i++) {
        for ($j = $i + 1; $j < count($answers); $j++) {
            if ($answers[$i] === $answers[$j]) {
                $matchCount++;
                break; // Break inner loop if match found
            }
        }
    }
    return $matchCount;
}

?>


<!-- Modal -->
<div class="modal fade" id="matchingAnswersModal" tabindex="-1" role="dialog" aria-labelledby="matchingAnswersModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="matchingAnswersModalLabel">Matching Answers Found</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Some answers start with similar text. Click below to see details.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">View Answers</button>
            </div>
        </div>
    </div>
</div>

<!-- Toast Notification -->
<div aria-live="polite" aria-atomic="true" style="position: fixed; top: 20px; right: 20px; z-index: 1000;">
    <div class="toast" id="matchingAnswersToast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000">
        <div class="toast-header">
            <strong class="mr-auto">Matching Answers Found</strong>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            Some answers start with similar text. Click below to see details.
        </div>
    </div>
</div>

