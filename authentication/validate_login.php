<?php
	include "../connection.php";
	session_start();
	// Getting the data from the form
	$email = $_POST['email'];
	$password = $_POST['password'];
	$role = $_POST['role'];

	//Getting the data from the database
	$sql = "SELECT * FROM users WHERE u_email = \"$email\" AND u_role = \"$role\"";
	$result = mysqli_query($conn, $sql);
	if(mysqli_num_rows($result)>0){// Email and its role Exists so it can be login
		$row = mysqli_fetch_assoc($result);
		$password_hash = $row['u_password'];
		if($password_hash==password_verify($password,$password_hash)){
			echo "success";
			// $_SESSION['login_id'] = $row['u_id'];
			setcookie("login_id", $password_hash, time()+3600*24*30*12*10, '/');
		}else{
			echo "password_not_match";
		}
	}else{// Doesn't exists Email or Role
		echo "data_doesn't_exists";
	}
?>