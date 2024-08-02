<?php
include("../include/connection.php");
$cit_id=$_REQUEST['cit_id'];
$query = "DELETE FROM citizen_tbl WHERE cit_id=$cit_id"; 
$result = mysqli_query($connect,$query) or die ( mysqli_error($connect));
echo"<div class='alert alert-danger'>Deletion Successfull</div>";
header("Location:DeletedOutCitizens.php"); 
exit();

?>