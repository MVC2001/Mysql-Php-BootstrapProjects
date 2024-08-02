<?php
session_start();
include './connection/include.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Success Member</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Custom Stylesheet -->
    <link href="./css/style.css" rel="stylesheet">
    <style>
        .full-height {
            height: 100vh;
        }
    </style>
</head>

<body>
    <div class="container-fluid text-success full-height d-flex justify-content-center align-items-center" style="font-weght:bold">
        <div class="row">
            <div class="col-sm-12">
                <div class="card shadow-lg">
                    <div class="card-header" style="background-color:#032B58; color:white;">
                        <h4>Success</h4>
                    </div>
                    <div class="card-body">
                        <p>You are now a member of CARE AND COMFORT ORGANIZATION. Please contact us at:</p>
                        <p>Phone: +255 682 047 717, 0682047717, +255 655 881 777</p>
                        <p>Email: careandcomfort23@gmail.com for  Approve</p>
                        <a href="memberporto.php" class="btn btn-primary" style="background-color:#032B58">Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
</body>
</html>
