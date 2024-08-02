<?php
session_start();
error_reporting(0);
include('includes/connection.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
if (isset($_POST["post_service"])) {
  $txnNumber = $_POST['txnNumber'];
 $packageType = $_POST['packageType'];
   $price  =$_POST['price'];
   $cleanerName = $_POST['cleanerName'];
 
  $insert_new_service = "INSERT INTO service_tbl (txnNumber,packageType,price,cleanerName)
      VALUES('$txnNumber','$packageType','$price','$cleanerName');";

  if (mysqli_query($connect, $insert_new_service)) {
    echo "<div class='alert alert-success'>New service  Added Successfull</div>";
    header("location:add_andManageCleaners.php");
    exit();
  } else{
  echo "<div class='alert alert-danger'>wrong unsuccessfull enrollment try again</div>";
  }
}


	?>
<!DOCTYPE HTML>
<html>
<head>
<title>CWMS | Add Car Washing Booking</title>

<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="css/morris.css" type="text/css"/>
<link href="css/font-awesome.css" rel="stylesheet"> 
<script src="js/jquery-2.1.4.min.js"></script>
<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'/>
<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
  <style>
		.errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
		</style>

</head> 
<body>
   <div class="page-container">
   <!--/content-inner-->
<div class="left-content">
	   <div class="mother-grid-inner">
              <!--header start here-->
<?php include('includes/header.php');?>
							
				     <div class="clearfix"> </div>	
				</div>
<!--heder end here-->
		<!--grid-->
 	<div class="grid-form">
 
<!---->
  <div class="grid-form1">
  	       <h3>Add Service</h3>

  	         <div class="tab-content">
						<div class="tab-pane active" id="horizontal-form">
							<form class="form-horizontal" name="washingpoint" method="post" enctype="multipart/form-data">
								    <div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">CarNumber</label>
									<div class="col-sm-8">
										<input type="text" name="txnNumber" class="form-control" required placeholder="eg TXE4EE">
									</div>
								</div>	
                <div class="form-group">
						<label for="focusedinput" class="col-sm-2 control-label">Package Type</label>
							<div class="col-sm-8">
								 <select type="text" name="packageType" required class="form-control">
                <option value="">Package Type</option>
                <option>BASIC CLEANING (Tshs 7000.)</option>
                 <option>PREMIUM CLEANING (Tshs 12000.)</option>
                  <option>COMPLEX CLEANING(Tshs 15000.)</option>
              </select>
					</div>
			</div>
 <div class="form-group">
						<label for="focusedinput" class="col-sm-2 control-label">Price</label>
							<div class="col-sm-8">
								 <select type="text" name="price" required class="form-control">
                <option value="">select price</option>
                <option>7000.Tshs </option>
                 <option>12000.Tshs </option>
                  <option>15000.Tshs </option>
              </select>
					</div>
			</div>


								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Service Provider</label>
									<div class="col-sm-8">
										<input type="text" name="cleanerName" class="form-control" required placeholder="">
									</div>
								</div>

        
					
								<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<button type="submit" name="post_service" class="btn-primary btn">Add</button>

				<button type="reset" class="btn-inverse btn">Reset</button>
			</div>
		</div>
						
						
						
					</div>
					
					</form>

     
      

      
      <div class="panel-footer">
		
	 </div>
    </form>
  </div>
 	</div>
 	<!--//grid-->

<!-- script-for sticky-nav -->
		<script>
		$(document).ready(function() {
			 var navoffeset=$(".header-main").offset().top;
			 $(window).scroll(function(){
				var scrollpos=$(window).scrollTop(); 
				if(scrollpos >=navoffeset){
					$(".header-main").addClass("fixed");
				}else{
					$(".header-main").removeClass("fixed");
				}
			 });
			 
		});
		</script>
		<!-- /script-for sticky-nav -->
<!--inner block start here-->
<div class="inner-block">
</div>
  <!--//content-inner-->
		<!--/sidebar-menu-->
					<?php include('includes/sidebarmenu.php');?>
							  <div class="clearfix"></div>		
							</div>
							<script>
							var toggle = true;
										
							$(".sidebar-icon").click(function() {                
							  if (toggle)
							  {
								$(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
								$("#menu span").css({"position":"absolute"});
							  }
							  else
							  {
								$(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
								setTimeout(function() {
								  $("#menu span").css({"position":"relative"});
								}, 400);
							  }
											
											toggle = !toggle;
										});
							</script>
<!--js -->
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<!-- Bootstrap Core JavaScript -->
   <script src="js/bootstrap.min.js"></script>
   <!-- /Bootstrap Core JavaScript -->	   

</body>
</html>
<?php } ?>