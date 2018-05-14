<?php
	$db_host = 'localhost';
	$db_user = 'root';
	$db_pass = '';
	$db = 'brewapp';
	
	$dbc = mysqli_connect($db_host, $db_user, $db_pass, $db)
	OR die('Could not connect to MySQL'.mysqli_connect_error());
?>