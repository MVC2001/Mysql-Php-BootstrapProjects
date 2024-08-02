
<?php

include './connection.php';


	    $name = mysqli_real_escape_string($connect, $_POST['name']);
          $position = mysqli_real_escape_string($connect, $_POST['position']);
	    $email = mysqli_real_escape_string($connect, $_POST['email']);
	    $password = mysqli_real_escape_string($connect, $_POST['password']);
	  
	 
	        $query = "INSERT INTO doctor (name,position,email,password)
	  			  VALUES('$name','$position','$email','$password')";
	    $results = mysqli_query($connect, $query);
	    if($results>0)
	    {
	        echo "user added successfully";
	    } 
    
?>