<?php
session_start();
include("./connection/include.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="description"
        content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <!-- Twitter meta-->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:site" content="@pratikborsadiya">
    <meta property="twitter:creator" content="@pratikborsadiya">
    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Vali Admin">
    <meta property="og:title" content="Vali - Free Bootstrap 4 admin theme">
    <meta property="og:url" content="http://pratikborsadiya.in/blog/vali-admin">
    <meta property="og:image" content="http://pratikborsadiya.in/blog/vali-admin/hero-social.png">
    <meta property="og:description"
        content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <title>Data Table - Vali Admin</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css"
        href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body class="app sidebar-mini rtl">
    <!-- Navbar-->
    <header class="app-header" style="background-color: #094469;">
        <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
    </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar" style="background-color: #094469;">

        <ul class="app-menu">
            <li><a class="app-menu__item active" style="background-color: #094469;"
                    href="../system_portion/dashboard.php"><i class="app-menu__icon fa fa-dashboard"></i><span
                        class="app-menu__label">Dashboard</span></a>
            </li>
            <hr>


            <li class="treeview" style="background-color: #094469;"> <a class="app-menu__item" href="#"
                    data-toggle="treeview"><i class="app-menu__icon fa fa-th-list"></i><span
                        class="app-menu__label">Menu</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    <li><a class="treeview-item" href="../system_portion/passwordResert.php"><i
                                class="icon fa fa-circle-o"></i>Resert_password</a></li>
                    <li><a class="treeview-item" href="../system_portion/users.php"><i class="icon fa fa-circle-o"></i>
                            Users</a></li>
                    <li><a class="treeview-item" href="../system_portion/roles.php"><i class="icon fa fa-circle-o"></i>
                            Roles</a></li>
                    <li><a class="treeview-item" href="../system_portion/viewVideo.php"><i
                                class="icon fa fa-circle-o"></i> Videos</a>
                    </li>
                    <li><a class="treeview-item" href="../system_portion/allSymbols.php"><i
                                class="icon fa fa-circle-o"></i> Symbols</a>
                    </li>
                    <li><a class="treeview-item" href="../system_portion/all_alphabet.php"><i
                                class="icon fa fa-circle-o"></i>
                            Alphabets</a></li>

                    <li><a class="treeview-item" href="./viewmessage.php"><i class="icon fa fa-circle-o"></i>
                            Message</a></li>
                </ul>
            </li>

        </ul>
    </aside>

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1  style="color: #094469;"><i class="fa fa-th-list"></i> All Message</h1>

            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                                <tr>
                                    <th>No#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Message</th>
                                    <th>Creaed At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count = 1;
                                $select_message = "SELECT * FROM `contact` ORDER BY id DESC";
                                $result = mysqli_query($connect, $select_message);
                                $number = mysqli_num_rows($result);
                                if ($number > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td><?php echo $count ?></td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['message']; ?></td>
                                    <td><?php echo $row['created_at']; ?></td>
                                    <td>

                                        <form action="" method="POST">

                                            <button class="btn btn-danger" style="width: 50px;"
                                                onclick="confirmDelete(<?php echo $row['id'] ?>)">
                                                <i class="fa fa-trash"></i>
                                                <!-- Trash icon for delete -->
                                            </button>
                                        </form>
                                        <span>
                                          <a href="sendSms.php?id=<?php echo $row['id'] ?>">
                                          <button class="btn btn-warning btn-sm">
                                               SendSms
                                               </a>
                                        </span>
                                    </td>

                                    </span>
                                    </td>
                                </tr>
                                <?php $count++ ?>
                                <?php }
                                } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Essential javascripts for application to work-->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="js/plugins/pace.min.js"></script>
    <!-- Page specific javascripts-->
    <!-- Data table plugin-->
    <script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">
    $('#sampleTable').DataTable();
    </script>
    <!-- Google analytics script-->
    <script type="text/javascript">
    if (document.location.hostname == 'pratikborsadiya.in') {
        (function(i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function() {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
        ga('create', 'UA-72504830-1', 'auto');
        ga('send', 'pageview');
    }
    </script>

    <script>
    function confirmDelete(Id) {
        // Display confirmation dialog
        if (confirm("Are you sure you want to delete?")) {
            // If user confirms, redirect to delete script
            window.location.href = "./deletecontact.php?id=" + Id;
        }
    }
    </script>



</body>

</html>