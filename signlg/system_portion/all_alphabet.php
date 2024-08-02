<?php
session_start();
include("./connection/include.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
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
  <meta property="og:description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
  <title>Data Table - Vali Admin</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Main CSS-->
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <!-- Font-icon css-->
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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
      <li><a class="app-menu__item active" style="background-color: #094469;" href="./dashboard.php"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a>
      </li>
      <hr>


      <li class="treeview" style="background-color: #094469;"> <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label">Menu</span><i class="treeview-indicator fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
          <li><a class="treeview-item" href="passwordResert.php"><i class="icon fa fa-circle-o"></i>Resert_password</a></li>
          <li><a class="treeview-item" href="users.php"><i class="icon fa fa-circle-o"></i> Users</a></li>
          <li><a class="treeview-item" href="roles.php"><i class="icon fa fa-circle-o"></i> Roles</a></li>
          <li><a class="treeview-item" href="./viewVideo.php"><i class="icon fa fa-circle-o"></i> Videos</a>
          </li>
          <li><a class="treeview-item" href="./allSymbols.php"><i class="icon fa fa-circle-o"></i> Symbols</a>
          </li>
          <li><a class="treeview-item" href="./all_alphabet.php"><i class="icon fa fa-circle-o"></i>
              Alphabets</a></li>

          <li><a class="treeview-item" href="../fontpage/viewmessage.php"><i class="icon fa fa-circle-o"></i>
              Message</a></li>
        </ul>
      </li>

    </ul>
  </aside>

  <main class="app-content">
    <div class="app-title">
      <div>
        <h1 style="color: #094469;"><i class="fa fa-th-list"></i> All   Alphabets</h1>
        <a href="./addAlphabet.php"><button class="btn btn text-white" style="background-color: #094469;">Add
            new Alphabet</button></a>
      </div>

    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <div class="tile-body">
            <table class="table table-hover table-bordered" id="sampleTable">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Alphabet</th>
                  <th>Description</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $sql = "SELECT * FROM alphabet ORDER  BY id DESC";
                $result = $connect->query($sql);

                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["description"] . "</td>";
                    echo '<td><img src="uploads/' . $row["alphabet"] . '" alt="Symbol Image" style="max-width: 100px; max-height: 100px;"></td>';
                    echo '<td> <a href="upateAlphabet.php?id=' . $row["id"] . '"><button class="btn btn-success">View</button></a>|<a href="deleteAlphabet.php?id=' . $row["id"] . '"><button class="btn btn-danger">Delete</button></a></td>';
                    echo "</tr>";
                  }
                } else {
                  echo "0 results";
                }
                ?>
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
</body>

</html>