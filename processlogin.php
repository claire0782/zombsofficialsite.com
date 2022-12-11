<?php
	session_start();
	include('connection.php');

	$user = $_POST['username'];
	$pass = $_POST['password'];

	$sql = "Select * from users where UserName = '".$user."' and Password = '".$pass."'";
	$res = $conn->query($sql);
	$line = mysqli_fetch_assoc($res);
	if (!empty($line)){
		$_SESSION['hasLog'] = 1;
		echo "1";
	}else{
		echo "Invalid UserName or Password";
	}
?>