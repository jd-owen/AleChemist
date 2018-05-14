<?php

	include('../mysqli_connect.php');
	
	session_start();
		
	$_SESSION['user-name'] = $_POST['user-name'];
	$_SESSION['first-name'] = $_POST['first-name'];
    $_SESSION['last-name'] = $_POST['last-name'];
	$_SESSION['mobile'] = $_POST['mobile'];
	$_SESSION['email'] = $_POST['email'];	
	
	if(isset($_POST['register'])){
		
		$user_name = mysqli_real_escape_string($dbc, $_POST['user-name']);
		$first_name = mysqli_real_escape_string($dbc, $_POST['first-name']);
		$last_name = mysqli_real_escape_string($dbc, $_POST['last-name']);
		$mobile = mysqli_real_escape_string($dbc, $_POST['mobile']);
		$email = mysqli_real_escape_string($dbc, $_POST['email']);
		$password = mysqli_real_escape_string($dbc, $_POST['password']);
		$password_confirm = mysqli_real_escape_string($dbc, $_POST['password-confirm']);
		
		if($password == $password_confirm){
			
			//create user
			//$password = md5($password); hash password security
			$sql = "INSERT INTO user(id, user_name, first_name, last_name, mobile, email, password)
			VALUES ('', '$user_name', '$first_name', '$last_name', '$mobile', '$email', '$password')";
			$result = mysqli_query($dbc, $sql);
			
		
			$_SESSION['message'] = "Registration successful!";
			header('Location: login.php');
			exit;
			
			//$_SESSION['message'] = "Registration successful!";
			//header("Location: http://localhost/ALECHEMIST/page/login.php");
			
			
			//if query successful redirect to login.php
			//if($mysqli_query($sql === true)){
				//$_SESSION['message'] = "Registration successful!";
			    //header("Location: login.php");
				//echo "<script type='text/javascript'> window.location='login.php'; </script>";
			//}	
			
		}else{
			$_SESSION['message'] = "The two passwords do not match";
		}
		
	}
	
?>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>User Registration</title>
	
	<link rel="stylesheet" href="../css/themes/2/brew.min.css"/>
	<link rel="stylesheet" href="../css/themes/2/jquery.mobile.icons.min.css"/>
	<link rel="stylesheet" href="../lib/jqm/jquery.mobile.structure-1.4.5.min.css" />
	
	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="../lib/jqm/jquery.mobile-1.4.5.min.js"></script>
	
</head>

<body>

	<!-- Sign-Up -->
<div data-role="page">
	<div data-role="header" data-theme="a">
			<h1>Sign Up!</h1>
    </div>
    <div role="main" class="ui-content">
		
		<form  method="post" action="register.php">
			<label for="user-name">Username</label>
			<input type="text" name="user-name" id="user-name" value ="">
			<label for="first-name">First Name</label>
			<input type="text" name="first-name" id="first-name" value="">
			<label for="last-name">Last Name</label>
			<input type="text" name="last-name" id="last-name" value="">
			<label for="mobile">Mobile Phone</label>
			<input type="text" name="mobile" id="mobile" value="">
			<label for="email">Email Address</label>
			<input type="text" name="email" id="email" value="">
			<label for="password">Password</label>
			<input type="password" name="password" id="password" value="">
			<label for="password-confirm">Confirm Password</label>
			<input type="password" name="password-confirm" id="password-confirm" value="">
			<button type ="submit" name="register" class="ui-btn ui-corner-all ui-shadow ui-btn-b mc-top-margin-1-5">Submit</a>
			<!--
			<button type ="submit" name="btn_submit" href="#dlg-sign-up-sent" data-rel="popup" data-transition="pop" data-position-to="window" class="ui-btn ui-btn-b ui-corner-all mc-top-margin-1-5">Submit</a>
			<div data-role="popup" id="dlg-sign-up-sent" data-dismissible="false" style="max-width:400px;">
				<div data-role="header">
					<h1>Almost done...</h1>
				</div>
				<div role="main" class="ui-content">
					<h3>Confirm Your Email Address</h3>
					<p>We sent you an email with instructions on how to confirm your email address. Please check your inbox and follow the instructions in the email.</p>
					<div class="mc-text-center"><a href="sign-in.html" class="ui-btn ui-corner-all ui-shadow ui-btn-b mc-top-margin-1-5">OK</a></div>
				</div>
			</div>
			-->
        </form>
		

			
    </div>
</div>
	
</body>

</html>
