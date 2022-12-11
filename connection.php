<?php
	$dbuser = "Claire";
	$dbpass = "Angub";
	$dbname = "act6to10";
	$dbhost = "localhost";

	$conn = new mysqli($dbhost,$dbuser,$dbpass,$dbname);
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}
?>