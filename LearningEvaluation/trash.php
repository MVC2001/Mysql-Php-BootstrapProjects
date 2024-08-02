// Check if user is not logged in or not an admin, then redirect to login page
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'staff') {
    header('location:Error404.php');
    exit; // Ensure script execution stops after redirection
}
