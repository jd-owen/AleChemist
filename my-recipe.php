<?php
	include('../mysqli_connect.php');	
	session_start();
	
	// Declare SESSION variables for form variables
	$_SESSION['recipe-name'] = $_POST['recipe-name'];
	$_SESSION['recipe-description'] = $_POST['recipe-description'];
	$_SESSION['select-fermentable'] = $_POST['select-fermentable'];
	$_SESSION['select-fermentable2'] = $_POST['select-fermentable2'];
	$_SESSION['f1-weight'] = $_POST['f1-weight'];
	$_SESSION['f2-weight'] = $_POST['f2-weight'];
	$_SESSION['select-hop'] = $_POST['select-hop'];
	$_SESSION['select-hop2'] = $_POST['select-hop2'];
	$_SESSION['h1-weight'] = $_POST['h1-weight'];
	$_SESSION['h2-weight'] = $_POST['h2-weight'];
	$_SESSION['h1-boiltime']= $_POST['h1-boiltime'];
	$_SESSION['h2-boiltime']= $_POST['h2-boiltime'];
	$_SESSION['batchsize'] = $_POST['batchsize'];
	$_SESSION['select-yeast'] = $_POST['select-yeast'];
	
	//Initialize variables
	$recipe_name = $_SESSION['recipe-name'];
    $recipe_description = $_SESSION['recipe-description'];
	$batchsize = $_SESSION['batchsize'];
	$f1 = $_SESSION['select-fermentable'];
	$f2 = $_SESSION['select-fermentable2'];
	$f1_weight = $_SESSION['f1-weight'];
	$f2_weight = $_SESSION['f2-weight'];
	$h1 = $_SESSION['select-hop'];
	$h2 = $_SESSION['select-hop2'];
	$h1_weight = $_SESSION['h1-weight'];
	$h2_weight = $_SESSION['h2-weight'];
	$h1_boiltime = $_SESSION['h1-boiltime'];
	$h2_boiltime = $_SESSION['h2-boiltime'];
	$y = $_SESSION['select-yeast'];
	$t_gp = '';
	$t_pow1 = '';
	$t_pow2 = '';
	$u_pow = '';
	$u_og = '';
	$u_weight = '';
	$ut1 = '';
	$ut2 = '';
	$ug = '';
	$u1 = '';
	$u2 = '';
	$ibu = '';
	$ibu1 = '';
	$ibu2 = '';
	$aau1 = '';
	$aau2 = '';
	$aa1 = '';
	$aa2 = '';
	$attenuation = '';
	$f1_ppg = '';
	$f2_ppg = '';
	$ag = '';
	$og = '';
	$gp1 = '';
	$gp2 = '';
	$fg = '';
	$abv = '';
	$alc_calories = '';
	$carb_calories = '';
	$total_calories = '';
	
	//Create Queries
		//$f1 = $_POST['select-fermentable'];
		$f1_query = "SELECT * FROM fermentable WHERE name = '$f1'";
		$f1_result = mysqli_query($dbc, $f1_query) or die(mysql_error());
		$f2_query = "SELECT * FROM fermentable WHERE name = '$f2'";
		$f2_result = mysqli_query($dbc, $f2_query) or die(mysql_error());
		
		//$h1 = $_POST['select-hop'];
		$h1_query = "SELECT * FROM hop WHERE variety = '$h1'";
		$h1_result = mysqli_query($dbc, $h1_query) or die(mysql_error());
		$h2_query = "SELECT * FROM hop WHERE variety = '$h2'";
		$h2_result = mysqli_query($dbc, $h2_query) or die(mysql_error());
		
		//$y = $_POST['select-yeast'];
		$y_query = "SELECT * FROM yeast WHERE name = '$y'";
		$y_result = mysqli_query($dbc, $y_query) or die(mysql_error());
		
		//Fetch Data
		
		$f1_row = mysqli_fetch_row($f1_result);
		$f2_row = mysqli_fetch_row($f2_result);
		$h1_row = mysqli_fetch_row($h1_result);
		$h2_row = mysqli_fetch_row($h2_result);
		$y_row = mysqli_fetch_row($y_result);
		
		//***Calculations**
		//Gravity
		$attenuation = (100-($y_row[2]))/100;
		$f1_ppg = $f1_row[2];
		$f2_ppg = $f2_row[2];
		$gp1 = $f1_weight * $f1_ppg;
		$gp2 = $f2_weight * $f2_ppg;
		$t_gp = ($gp1 + $gp2)/$batchsize;	
		$og = ($t_gp/1000) + 1;
		$fg = (($t_gp/1000) * $attenuation)+1;
		$ag = $og - $fg;
		
		//IBUs
		$aa1 = $h1_row[2];	
		$aa2 = $h2_row[2];
		$aau1 = $h1_weight * $aa1;
		$aau2 = $h2_weight * $aa2;
		$u_og = $og - 1;
		$u_pow = pow(.000125, $u_og);
		$ug = 1.65 * $u_pow;
		$t_pow1 = pow(2.71828, (-.04 * $h1_boiltime));
		$t_pow2 = pow(2.71828, (-.04 * $h2_boiltime));
		$ut1 = (1 - $t_pow1)/4.15;
		$ut2 = (1 - $t_pow2)/4.15;
		$u1 = $ug * $ut1;
		$u2 = $ug * $ut2;
		$ibu1 = ($aau1 * $u1 * 74.89)/$batchsize;
		$ibu2 = ($aau2 * $u2 * 74.89)/$batchsize;
		$ibu = $ibu1 + $ibu2;
		
		//Calories
		$abv = $ag*131;
		$alc_calories = (1881.22 * $fg * ($og-$fg))/(1.775-$og);
		$carb_calories = (3550 * $fg * ((0.1808*$og) + (0.8192*$fg) - 1.0004));
		$total_calories = $alc_calories + $carb_calories;
?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>My Recipe</title>
	
	<link rel="stylesheet" href="../css/themes/2/brew.min.css"/>
	<link rel="stylesheet" href="../css/themes/2/jquery.mobile.icons.min.css"/>
	<link rel="stylesheet" href="../lib/jqm/jquery.mobile.structure-1.4.5.min.css" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
	<link rel="stylesheet" href="../css/my-recipe.css"/>
	
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="../lib/jqm/jquery.mobile-1.4.5.min.js"></script>
	</head>

<body>

	<!-- Recipe Page-->
	<div data-role="page" data-theme="a">
        <div data-role="header" data-position="inline">
			<a href="brew.php" data-icon="back">Edit Recipe</a>
            <h1>My Recipe</h1>
        </div>
		<div id="recipe-border">
        <div role="main" class="ui-content">
		<?php
			//echo "<pre>";
			//print_r($_SESSION);
			//echo "</pre>";
			echo '<div style="padding: 25px;">';
			echo "<h3>".$recipe_name."</h3>";
			echo "<h3>	Recipe Description: ".$recipe_description."</h3>";
			echo "<h3>	Batchsize: ".$batchsize." gal.</h3>";
			//	echo "<h3>	f2 weight: ".$f2_weight."</h3>";
			//echo "<h3>	ppg1: ".$f1_ppg."</h3>";
			//echo "<h3>	ppg2: ".$f2_ppg."</h3>";
			//echo "<h3>	gravity point 1: ".$gp1."</h3>";
			//echo "<h3>	gravity point 2: ".$gp2."</h3>";
			//echo "<h3>	total gravity points: ".$t_gp."</h3>";
			echo "<h3>	Original Gravity: ".round($og,2)."</h3>";
			echo "<h3>	Final Gravity: ".round($fg,2)."</h3>";
			echo "<h3>	IBUs: ".round($ibu)."</h3>";
			echo "<h3>	ABV: ".round($abv, 1)."%</h3>";
			echo "<h3>	Calories from alcohol: ".round($alc_calories)."</h3>";
			echo "<h3>	Calories from carbohydrates: ".round($carb_calories)."</h3>";
			echo "<h3>	Total calories: ".round($total_calories)." (per 12 oz. bottle)</h3>";
			//echo "<h3>	Alpha Acid Units: ".round($aau, 1)."</h3>";
			//echo "<h3>	U(g) ".$ug."</h3>";
			//echo "<h3>	U(t): ".$ut."</h3>";
			//echo "<h3>	Utilization: ".$u1."</h3>";
			echo '</div>'
		?> 
        </div>
		</div>
		<button type ="save" name="save" class="ui-btn ui-corner-all ui-shadow ui-btn-b mc-top-margin-1-5">Save</button>
	</div>
</body>
</html>