<?php

$servername ="localhost";
$username="root";
$password="";
$db_mame="odce_db";

$connect= mysqli_connect($servername,$username,$password,$db_mame);

if(!$connect){

    echo "Connect error please try again";
}

?>