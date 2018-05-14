<?php
	include('../mysqli_connect.php');
	session_start();
	
	$username = $_SESSION['user-name'];
	
	$sql = "SELECT * FROM user WHERE user_name='$username'";
	$user_result = mysqli_query($dbc, $sql) or die(mysql_error());
	$user_row = mysqli_fetch_row($user_result);
	
	$firstname = $user_row[2];
	$lastname = $user_row[3];
?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>AleChemist App - Home Page</title>
	
	<link rel="stylesheet" href="../css/themes/2/brew.min.css"/>
	<link rel="stylesheet" href="../css/themes/2/jquery.mobile.icons.min.css"/>
	<link rel="stylesheet" href="../lib/jqm/jquery.mobile.structure-1.4.5.min.css" />
	
	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="../lib/jqm/jquery.mobile-1.4.5.min.js"></script>
</head>

<body>

	<!-- HOME PAGE-->
	<div data-role="page" data-theme="a">
		<div data-role="header" data-position="inline">
            <h1>Welcome Home <?php echo $firstname;?> <?php echo $lastname;?>!</h1>
			<div data-role="fieldcontain" style="position: absolute; top: 0; right: 0; margin: 0; padding: 0">
			<select>
				<option selected> <?php echo $username;?> </option>
				<option> Account </option>
				<option> Logout </option>
			</select>
			</div>
       </div>
	        <div role="main" class="ui-content">
            <a href="brew.php" id="Brew" class="ui-btn ui-btn-b ui-corner-all">Brew</a>
			<a href="mybrews.php" id="myBrews" class="ui-btn ui-btn-b ui-corner-all">My Brews</a>
			<a href="searchbrews.html" id="searchBrews" class="ui-btn ui-btn-b ui-corner-all">Search Brews</a>
            <a href="forum.html" id="Forum" class="ui-btn ui-btn-b ui-corner-all">Forum</a>
			<a href="map.html" id="Map" class="ui-btn ui-btn-b ui-corner-all">Map</a>
            <p></p>
        </div>
		<div data-role="footer" data-position="inline">
		 <h1></h1>
       </div>
	</div>
        
	</div>
	
	
</body>

</html>