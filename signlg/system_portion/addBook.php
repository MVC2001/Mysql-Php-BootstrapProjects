<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Form Samples - Vali Admin</title>
</head>

<body class="app sidebar-mini rtl">
    <header class="app-header" style="background-color: #094469;">
        <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
    </header>
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar" style="background-color: #094469;">
        <ul class="app-menu">
            <li><a class="app-menu__item active" style="background-color: #094469;" href="./dashboard.php"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
            <hr>
            <li class="treeview" style="background-color: #094469;"> <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label">Menu</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    <li><a class="treeview-item" href="passwordResert.php"><i class="icon fa fa-circle-o"></i>Resert_password</a></li>
                    <li><a class="treeview-item" href="users.php"><i class="icon fa fa-circle-o"></i> Users</a></li>
                    <li><a class="treeview-item" href="roles.php"><i class="icon fa fa-circle-o"></i> Roles</a></li>
                    <li><a class="treeview-item" href="./viewVideo.php"><i class="icon fa fa-circle-o"></i> Videos</a></li>
                    <li><a class="treeview-item" href="./allSymbols.php"><i class="icon fa fa-circle-o"></i> Symbols</a></li>
                    <li><a class="treeview-item" href="./all_greetings.php"><i class="icon fa fa-circle-o"></i> Greeting</a></li>
                    <li><a class="treeview-item" href="../fontpage/viewmessage.php"><i class="icon fa fa-circle-o"></i> Message</a></li>
                    <li><a class="treeview-item" href="../fontpage/allBooks.php"><i class="icon fa fa-circle-o"></i> Books</a></li>
                </ul>
            </li>
        </ul>
    </aside>
    <main class="app-content">
        <div class="app-title">
            <div class="clearix"></div>
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">Add document here</h3>
                    <hr>
                    <div class="tile-body">
                        <form action="uploadBooks.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="fileToUpload">Select Document File:</label>
                                <input type="file" class="form-control-file" id="fileToUpload" name="fileToUpload" accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx" required>
                            </div>
                            <div class="form-group">
                                <label for="category">Category:</label>
                                <input class="form-control" id="category" name="category" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Upload</button>
                            <a href="./allBooks.php"><button type="button" class="btn btn-danger">Cancel</button></a>
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
