<?php
include("../include/connection.php");
$text_id=$_REQUEST['text_id'];
$query = "DELETE FROM citizen_txts_tbl WHERE text_id=$text_id"; 
$result = mysqli_query($connect,$query) or die ( mysqli_error($connect));
echo"<div class='alert alert-danger'>Deletion Successfull</div>";
header("Location:CitizenChatPannel.php"); 
exit();

?>