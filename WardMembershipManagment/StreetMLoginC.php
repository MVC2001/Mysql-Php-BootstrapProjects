<?php
	require_once './include/connection.php';
	session_start();
	if(ISSET($_POST['post_citizen_user_and_pass'])){
		$email = $_POST['email'];
		$password = md5($_POST['password']);
	
		$query = mysqli_query($connect, "SELECT * FROM `citizen_tbl` WHERE `email` = '$email' AND `password` = '$password'") or die(mysqli_error());
		$fetch = mysqli_fetch_array($query);
		$row = mysqli_num_rows($query);
		
		if($row > 0){
			$_SESSION['cit_id']=$fetch['cit_id'];
			echo "<script>alert('Login Successfully!')</script>";
			echo "<script>window.location='./CitizenChats/ChatPanel.php'</script>";
		}else{
			echo "<div class='alert alert-danger' role='alert'>Invalid username or password</div> <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
			echo "<script>window.location='index.php'</script>";
		}
		
	}

?>