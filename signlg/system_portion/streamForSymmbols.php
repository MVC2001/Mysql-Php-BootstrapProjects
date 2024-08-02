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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet">



</head>

<body class="app sidebar-mini rtl">

    <div class="card-header"
        style="background-color:#FECC07;box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;height:80px">
        <nav class="navbar navbar-expand-lg navbar-light text-white fixed-top"
            style="background-color:#094469;height:80px">
            <a class="navbar-brand" href="./index.php" style="color:white">
                <img src="./assets/img/LOGO2.png" style="height: 200;width:200px; margin-left:300px"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup"
                style="margin-left:400px;background-color:#094469">
                <div class="navbar-nav">
                <a href="all-lists.php">Back home</a> 
                    <a class="nav-link" href="#" style="color:white">  ( <b> <?php $query = mysqli_query($connect, "SELECT * FROM `users` WHERE `user_id`='$_SESSION[user_id]'") or die(mysqli_connect_error());
                                                                          $fetch = mysqli_fetch_array($query);
                                                                          echo "" . $fetch['email'] . " "; ?></b>)</a>
                    
                    <a class="nav-link" href="./index.php" style="color:white"><i class="fa fa-sign-out"></i></a>
                
                    </div>
            <ul class="app-breadcrumb breadcrumb" style="margin-left:450px">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item" ><a href="../index.php" style="color:red" >Logout</a></li>
            </ul>
        </div>

                </div>
            </div>
        </nav>
    </div>

    <div class="container-fluid" style="background-color: #FECC07;height:20px">.</div>
    <div class="slide-show-div" style="box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px;height:130px;margin-top:8px">
        <div class="container">
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row">
                            <div class="col-md-6">
                                <br>
                                <br>
                            <img src="./myimgs/SIGN1.png" class="d-block " alt="Slide 1" style="height:100px;width:200px">
                            </div>
                            <div class="col-md-6">
                                <div class="carousel-caption">
                                    <h2 style="color:#094469">LESSON 01: ALPHABETH</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="carousel-item">
                        <div class="row" style="margin-top:50px">
                            <div class="col-md-6">
                                <img src="./myimgs/497-200.png" class="d-block " alt="Slide 1" style="height:100px;width:200px" >
                            </div>
                            <div class="col-md-6">
                                <div class="carousel-caption">
                                <h2 style="color:#094469">LESSON  01: ALPHABETH</h2>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <div class="row" style="margin-top:50px">
                            <div class="col-md-6">
                            <img src="./myimgs/SIGN1.png" class="d-block " alt="Slide 1" style="height:100px;width:200px">
                            </div>
                            <div class="col-md-6">
                                <div class="carousel-caption">
                                <h2 style="color:#094469">LESSON  01: ALPHABETH</h2>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Add more carousel items as needed -->
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
    </div>


    <div class="container" style="margin-top:90px">
        <div class="row">
            <?php
      $sql = "SELECT * FROM alphabet ORDER  BY id ASC";
      $result = $connect->query($sql);

      $alphaIndex = 'A'; // Initialize the alphabetical index

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo '<div class="col-md-4">';
          echo '<div class="card mb-3"  style="background-color:#094469">';
          echo '<div class="card-header" style="color:white">' . $alphaIndex . '</div>'; // Display the alphabetical index
          echo '<td><img src="uploads/' . $row["alphabet"] . '" alt="Symbol Image" style="max-width: 350px; height: 200px;"></td>';
          echo '<div class="card-body">';
          echo '<p class="card-text text-center" style="background-color:#FECC07;color:#094469">' . $row["description"] . '</p>';
          echo '</div>';
          echo '</div>';
          echo '</div>';

          // Increment the alphabetical index
          $alphaIndex++;
        }
      } else {
        echo "<div class='col'><p>No videos found</p></div>";
      }

      $connect->close();
      ?>
        </div>
    </div>

    <br>
    <center><b>MORE LESSONS...</b></center>
    <div class="container text-center text-white" style="height:60px;margin-top:10px">
        <div class="row">
            
            <div class="col-md-3">
                <div class="card" style="background-color:#094469"><a href="./streamForSymmbols.php" style="color:white">01</a></div>
            </div>

            <div class="col-md-3">
                <div class="card" style="background-color:#094469"><a href="./streamPanel.php" style="color:white">02</a></div>
            </div>

            <div class="col-md-3">
                <div class="card" style="background-color:#094469"><a href="./stream_greetings.php" style="color:white">03</a></div>
            </div>

            <div class="col-md-3">
            <div class="card" style="background-color:#094469"><a href="./donwloadBooks.php" style="color:white">download books here</a></div>
            </div>
        </div>
    </div>
    <hr>



    <!-- ======= Footer ======= -->
    <div class="container-fluid" style="background-color:#FECC07">.</div>
    <footer id="footer" class="footer" style="background-color: #094469">

        </div>
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-5 col-md-12 footer-info">
                    <a href="index.html" class="logo d-flex align-items-center">
                        <span>My Hands My language</span>

                    </a><br><br>
                    <h4>Follow us </h4>
                    <div class="social-links d-flex mt-4">
                        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                        <a href="https://www.facebook.com/profile.php?id=100082944469847" class="facebook"><i
                                class="bi bi-facebook"></i></a>
                        <a href="https://www.instagram.com/adventist_talents_tz?igsh=MW1uemZ3cGl6bXRxYQ=="
                            class="instagram"><i class="bi bi-instagram"></i></a>
                        <a href="https://www.youtube.com/@adventistcreativetz" class="linkedin"><i
                                class="bi bi-youtube"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-6 footer-links">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="#hero">Home</a></li>
                        <li><a href="#about">About us</a></li>
                        <li><a href="#services">Services</a></li>
                        <li><a href="#team">Team</a></li>
                        <li><a href="#contact">contact us</a></li>

                    </ul>
                </div>

                <div class="col-lg-2 col-6 footer-links">
                    <h4>Our Services</h4>
                    <ul>
                        <li><a>Providing counceling</a></li>
                        <li><a>Deef caring</a></li>
                        <li><a>Enterpreting signs</a></li>
                        <li><a>Teaching signs</a></li>

                    </ul>
                </div>

                <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
                    <h4>Contact Us</h4>
                    <p>
                        Dar es Salaam<br>
                        <strong>Phone:</strong>
                        <i class="bi bi-whatsapp d-flex align-items-center ms-4">
                            <span>+255 742 972 252</span></i> <br>
                        <strong>Email:</strong> adventistcreativetz@gmail.com<br>
                    </p>

                </div>

            </div>
        </div>
    </footer><!-- End Footer -->
    <!-- End Footer -->

    </div>
    </div>

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