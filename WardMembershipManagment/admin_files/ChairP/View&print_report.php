<?php
session_start();
include('../include/connection.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Citien report</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
     <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="./AllStyles.css" rel="stylesheet">
     <!-- FONTAWESOME STYLES-->
    <link href="css/font-awesome.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <!---- Ends Here----->
</head>

<body>

<div class="container-fluid text-center" style="margin-top:40px">
<h4><b><center>VIEW AND PRINT REPORT PANNEL FOR CHAIR PERSON</center></b></h4>
<br>
<a href="/admin_files/Dashboard.php">BACK IN</a>
<div class="row">
<div class="col-md-1">
</div>
<div class="col-md-10">
<!----form modal and table modal for report-->
  <main class="col-md-12 col-lg-10 mt-4">
                        <div class="row pt-5 justify-content-center">

                            <form action="" method="POST" enctype="multipart/form-data" class="form-horizontal"
                                name="bwdatesreport">

                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label class="form-label">From Date</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="date" name="from_date" id="from_date" class="form-control"
                                            required="true"
                                            style="box-shadow: rgba(0, 0, 0, 0.15) 0px 15px 25px, rgba(0, 0, 0, 0.05) 0px 5px 10px;height:70px;border-radius:20px">
                                    </div>
                                </div>

                                <div class="row form-group" style="margin-top:50px">
                                    <div class="col col-md-3">
                                        <label for="from_date" class="form-label">To Date</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="date" name="to_date" class="form-control" required="true"
                                            style="box-shadow: rgba(0, 0, 0, 0.15) 0px 15px 25px, rgba(0, 0, 0, 0.05) 0px 5px 10px;height:70px;border-radius:20px">
                                        </div>
                                    </div>
                                    <br>
                                    <p style=" text-align: center;"> <button type="submit" class="btn btn-warning"
                                            name="submit" style="margin-left:200px;margin-top:50px;width:150px">Search now</button></p>
                            </form>
                        </div>
                    </main> <br>
 <!----------------view modal here---------------------->
    <div class="container-fluid" style="width:95%">
        <div class="row">
            <div class="col-md-12">
            <center><button type="submit" id="print" onclick="printPage()" class="btn btn-primary" style="width:200px;margin-left:20px;border-radius:20px">PrintReport now</center></button>
               <?php
                if (isset($_POST['submit'])) {
                     $from_date = $_POST['from_date'];
                    $to_date = $_POST['to_date'];
                    ?>
                    <center>
                        <h3 style="padding-left: 100px;color:#003e6a"> Citizen Report from
                            <?php echo $from_date ?> to
                            <?php echo $to_date ?>
                        </h3>
                    </center>
                    <hr>
                    <div class="modal-for-table" style="box-shadow: rgba(0, 0, 0, 0.25) 0px 25px 50px -12px;width:100%">
                        <div class="row">
                            <table class="table table-striped" width="100%" border="0" style="padding-left:40px;font-size:13px">
                                <thead>
                                    <tr>
                                        <th scope="col">S.No#</th>
                                         <th scope="col">Full name</th>
                                        <th scope="col">Gender</th>
                                        <th scope="col">Date ofBirth</th>
                                           <th scope="col">Education Level</th>
                                        <th scope="col">Health status</th>
                                        <th scope="col">Occupation</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Postal Codes</th>
                                        <th scope="col">House Ownership</th>
                                        <th scope="col">Created_At</th>
                                    </tr>
                                </thead>
                                <?php
                                $cnt = 1;
                                $selectreport = "select * from citizen_tbl where created_at between '$from_date' and '$to_date'" or die(mysqli_error($connect));
                                $result = mysqli_query($connect, $selectreport);
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_array($result)) {
                                        foreach ($result as $row) {
                                            ?>
                                            <tbody>
                                                <tr data-expanded="true">
                                                    <td class="text-center">
                                                        <?php echo $cnt; ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php echo $row['fullname']; ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php echo $row['gender']; ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php echo $row['date_OfBirth']; ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php echo $row['education_level']; ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php echo $row['health_status']; ?>
                                                    </td>
                                                    <td v>
                                                        <?php echo $row['occupation']; ?>
                                                    </td>
                                                    <td  class="text-center">
                                                        <?php echo $row['phone']; ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php echo $row['postal_codes']; ?>
                                                    </td>
                                                     <td class="text-center">
                                                        <?php echo $row['house_ownership']; ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php echo $row['created_at']; ?>
                                                    </td>
                                                </tr>
                                                <?php  $cnt++ ?>

                                                <?php
                                        }
                                       
                                    }
                                } else {
                                    echo "<div class='alert alert-warning' role='alert'>No Records found  Between such date</div>";
                                }
                }
                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-1">
</div>
</div>
</div>



    <!-----my script------------------------------------------------>
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
    <!------Script For----Pre Loader-------------------------------->
   <script>
function printPage() {
    window.print();
}
</script

</body>

</html>