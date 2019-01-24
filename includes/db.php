<?php
    $server = "demo_cms_db";
	$username = "demo_cms_user";
	$password = "W@f@@.65017";
	$database = "cms";
	
	$connection = mysqli_connect($server, $username, $password, $database);
	if (!$connection) {
		die("Couldn't connect to db". mysqli_error());
		
	} 

	



