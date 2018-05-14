<?php
		include('../mysqli_connect.php');
		
		session_start();
				
		if(isset($_POST['login'])){	
			$username= $_POST['user-name'];
			$password = $_POST['password'];
			//$email = mysqli_real_escape_string($dbc, $_POST['email']);
			//$password = mysqli_real_escape_string($dbc, $_POST['password']);
			$sql = "SELECT * FROM user WHERE user_name='$username' AND password='$password'";
			$result = mysqli_query($dbc, $sql);	
			if(!$row = mysqli_fetch_assoc($result)){
				echo "Your username or password is incorrect!";
			}else{
				$_SESSION['user-name'] = $username;
				header('Location: home.php');
			}	
			//header('Location: home.php');
			//echo "<script type='text/javascript'> window.location.href = 'home.html'; </script>";
		}
?>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	
	<link rel="stylesheet" href="../css/themes/2/brew.min.css"/>
	<link rel="stylesheet" href="../css/themes/2/jquery.mobile.icons.min.css"/>
	<link rel="stylesheet" href="../lib/jqm/jquery.mobile.structure-1.4.5.min.css" />
	
	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="../lib/jqm/jquery.mobile-1.4.5.min.js"></script>
</head>

<body>

	<!-- Login -->
	<div data-role="page">
        <div data-role="header" data-theme="a">
            <h1>Login</h1>
        </div>
        <div role="main" class="ui-content">
			<form method="post" action="">
				<label for="user-name">Username:</label>
				<input type="text" name="user-name" id="user-name" value="">
				<label for="password">Password:</label>
				<input type="password" name="password" id="password" value="">
				<fieldset data-role="controlgroup">
					<input type="checkbox" name="chck-rememberme" id="chck-rememberme" checked="">
					<label for="chck-rememberme">Remember me</label>
				</fieldset>
				<button type="submit" name="login" id="login" class="ui-btn ui-btn-b ui-corner-all mc-top-margin-1-5">Done</button>
			<!--<a href="home.html" id="login" class="ui-btn ui-btn-b ui-corner-all mc-top-margin-1-5">Submit</a>-->
            <!-- <a href="#dlg-invalid-credentials" data-rel="popup" data-transition="pop" data-position-to="window" id="btn-submit" class="ui-btn ui-btn-b ui-corner-all mc-top-margin-1-5">Submit</a>
            <p class="mc-top-margin-1-5"><a href="password-reset.html">Can't access your account?</a></p>
            <div data-role="popup" id="dlg-invalid-credentials" data-dismissible="false" style="max-width:400px;">
                <div role="main" class="ui-content">
                    <h3 class="mc-text-danger">Login Failed</h3>
                    <p>Did you enter the right credentials?</p>
                    <div class="mc-text-center"><a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-b mc-top-margin-1-5">OK</a></div>
                </div>
            </div> -->	
			</form>
        </div>
    </div>

</body>

</html>