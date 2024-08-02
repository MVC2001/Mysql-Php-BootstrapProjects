<?php
session_start();
include("./connection/include.php");

// Check if id is set in URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch user details by id
    $query = "SELECT * FROM `contact` WHERE id = $id";
    $result = mysqli_query($connect, $query);
    if ($result) {
        $user = mysqli_fetch_assoc($result);

        if (!$user) {
            echo "User not found!";
            exit;
        }
    } else {
        echo "Error fetching user: " . mysqli_error($connect);
        exit;
    }
} else {
    echo "No ID provided!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="description" content="Send SMS to User">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Send SMS - Vali Admin</title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="app sidebar-mini rtl">
    <header class="app-header" style="background-color: #094469;">
        <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
    </header>
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar" style="background-color: #094469;">
        <ul class="app-menu">
            <li><a class="app-menu__item active" style="background-color: #094469;" href="../system_portion/dashboard.php"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
            <hr>
            <li class="treeview" style="background-color: #094469;">
                <a class="app-menu__item" href="#" data-toggle="treeview">
                    <i class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label">Menu</span>
                    <i class="treeview-indicator fa fa-angle-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a class="treeview-item" href="../system_portion/passwordResert.php"><i class="icon fa fa-circle-o"></i>Resert_password</a></li>
                    <li><a class="treeview-item" href="../system_portion/users.php"><i class="icon fa fa-circle-o"></i> Users</a></li>
                    <li><a class="treeview-item" href="../system_portion/roles.php"><i class="icon fa fa-circle-o"></i> Roles</a></li>
                    <li><a class="treeview-item" href="../system_portion/viewVideo.php"><i class="icon fa fa-circle-o"></i> Videos</a></li>
                    <li><a class="treeview-item" href="../system_portion/allSymbols.php"><i class="icon fa fa-circle-o"></i> Symbols</a></li>
                    <li><a class="treeview-item" href="../system_portion/all_greetings.php"><i class="icon fa fa-circle-o"></i> Greeting</a></li>
                    <li><a class="treeview-item" href="./viewmessage.php"><i class="icon fa fa-circle-o"></i> Message</a></li>
                </ul>
            </li>
        </ul>
    </aside>
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-th-list"></i> Send SMS to <?php echo htmlspecialchars($user['name']); ?></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <form action="sendSmsToUser.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                            <div class="form-group">
                                <label for="receiver_email">Receiver's Email</label>
                                <input type="text" class="form-control" id="receiver_email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required readonly>
                            </div>
                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Send SMS</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/plugins/pace.min.js"></script>
</body>
</html>
