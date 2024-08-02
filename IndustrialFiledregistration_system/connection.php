<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "students_database";
    
      // Create connection
   $conn = mysqli_connect($servername, $username, $password, $database);
    
    // Check connectionif 
    if($conn != true){
      echo "Wrong connection";
     
   } 
    
    ?>
