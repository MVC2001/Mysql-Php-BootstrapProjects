<?php
session_start();
include('includes/config.php');
$sql = "DELETE FROM tblwashingpoints WHERE id='$id'";
$stmt= $dbh->prepare($sql);
$stmt->execute([$id]);
?>