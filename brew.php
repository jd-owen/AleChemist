<?php
	include('../mysqli_connect.php');
	session_start();
		
	$fermentable_query = "SELECT * FROM fermentable";
	
	$fermentable = mysqli_query($dbc, $fermentable_query);
	$fermentable2 = mysqli_query($dbc, $fermentable_query);
	
	//$fermentable_options = "";
	
	//while($row = mysqli_fetch_array($fermentable)){
	//	$fermentable_options = $fermentable_options."<option>{$row['name']}</option>";
	//}
	
	$hop_query = "SELECT * FROM hop";
	
	$hop = mysqli_query($dbc, $hop_query);
	$hop2 = mysqli_query($dbc, $hop_query);
	
	//$hop_options = "";
	//while($hop_row = mysqli_fetch_array($hop)){
	//$hop_options = $hop_options."<option>{$hop_row['variety']}</option>";
	//}
	
	$yeast_query = "SELECT * FROM yeast";
	
	$yeast = mysqli_query($dbc, $yeast_query);
	
	//$yeast_options = "";
	//while($yeast_row = mysqli_fetch_array($yeast)){
	//$yeast_options = $yeast_options."<option>{$yeast_row['name']}</option>";
	//}
	
	//if(isset($_POST["query"]))
	//{	
	//	$fermentable1Output = '';
	//	$query = "SELECT * FROM fermentable WHERE name LIKE '%".$_POST["query"]."%'";
	//	$fermentable1Result = mysqli_query($dbc, $query);
	//	$fermentable1Output = '<ul class="list-unstyled">';
	//	if(mysqli_num_rows($fermentable1Result) > 0)
	//	{	
	//		while($fermentable1Row = mysqli_fetch_array($fermentable1Result))
	//		{
	//			$fermentable1Output .= '<li>'.$fermentable1Row["name"].'</li>';
	//		}
	//	}
	//	else
	//	{
	//		$fermentable1Output .= '<li>Fermentable Not Found</li>';
	//	}
	//	$fermentable1Output .= '</ul>';
	//	echo $fermentable1Output;
	//}
	
	if(isset($_POST['brew'])){
		}
	else{
		echo "Failed to brew.";
	}
?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>AleChemist App - Brew Page</title>
	
	<link rel="stylesheet" href="../css/themes/2/brew.min.css"/>
	<link rel="stylesheet" href="../css/themes/2/jquery.mobile.icons.min.css"/>
	<link rel="stylesheet" href="../lib/jqm/jquery.mobile.structure-1.4.5.min.css" />

	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="../lib/jqm/jquery.mobile-1.4.5.min.js"></script>
	<script src="../js/brew.js"></script>
</head>

<body>

	<!-- BREW PAGE-->
	<div data-role="page" data-theme="a">
		 <div data-role="header" data-position="inline">
			<a href="home.html" data-icon="back">Previous Page</a>
            <h1>Create Your Recipe!</h1>
			<a href="home.html" data-icon="gear">Settings</a>
        </div>
        <div role="main" class="ui-content">
			<form method="POST" action="my-recipe.php">
			<h1 align="center">Recipe Information</h1>
			<label for="recipe-name">Recipe Name:</label>
			<input type="text" id="recipe-name" name="recipe-name"
			value="<?php
				if(isset($_SESSION['recipe-name'])){
					echo $_SESSION['recipe-name'];
				}?>"></input>
			<label for="recipe-description">Recipe Description:</label>
			<input type="text" id="recipe-description" name="recipe-description"
			value="<?php
				if(isset($_SESSION['recipe-description'])){
					echo $_SESSION['recipe-description'];
				}?>"></input>
			<label for="batchsize">Enter Batchsize (in Gal.):</label>
			<div style = "width: 75px">
			<input type="number" id="batchsize" name="batchsize"
			value="<?php
				if(isset($_SESSION['batchsize'])){
					echo $_SESSION['batchsize'];
				}?>"></input>
			</div>
		
				<h2 align="center">Add Fermentables</h2>
					<div>
						<label for="select-fermentable">Fermentable Type:</label>
						<select id="select-fermentable" name="select-fermentable">
							<option value="">Select Fermentable</option>
							 <?php
								while($row=mysqli_fetch_array($fermentable))
								{
									$selected = (isset($_POST['select-fermentable']) && $_POST['select-fermentable'] == $row['name']) ? ' selected="selected"' : '';
							?>
							<option<?php echo $selected ?> value="<?php echo $row['name']; ?>"> <?php echo $row['name'];?></option>
							<?php
								}
							?>
						</select>
					</div>
					<div style = "width: 75px">	
						<label for="f1-weight">Weight (in Lbs.):</label>
						<input type="number" step="0.01" id="f1-weight" name="f1-weight"
						value="<?php
							if(isset($_SESSION['f1-weight'])){
							echo $_SESSION['f1-weight'];
						}?>"></input>
					</div>
					<div>
						<label for="select-fermentable2">Fermentable Type:</label>
						<select id="select-fermentable2" name="select-fermentable2">
							<option value="">Select Fermentable</option>
							 <?php
								while($row2=mysqli_fetch_array($fermentable2))
								{
									$selected = (isset($_POST['select-fermentable2']) && $_POST['select-fermentable2'] == $row2['name']) ? ' selected="selected"' : '';
							?>
							<option<?php echo $selected ?> value="<?php echo $row2['name']; ?>"> <?php echo $row2['name'];?></option>
							<?php
								}
							?>
						</select>
					</div>
					<div style = "width: 75px">	
						<label for="f2-weight">Weight (in Lbs.):</label>
						<input type="number" step="0.01" id="f2-weight" name="f2-weight"
						value="<?php
							if(isset($_SESSION['f2-weight'])){
							echo $_SESSION['f2-weight'];
						}?>"></input>
					</div>
					
				<h2 align="center">Add Hops</h2>
				<label for="select-hop">Hop Variety:</label>
				<select id="select-hop" name="select-hop">	
					<option selected>Select Hops</option>
					<?php
							while($hop_row=mysqli_fetch_array($hop))
							{
								$selected = (isset($_POST['select-hop']) && $_POST['select-hop'] == $hop_row['variety']) ? ' selected="selected"' : '';
							?>
							<option<?php echo $selected ?> value="<?php echo $hop_row['variety']; ?>"> <?php echo $hop_row['variety'];?></option>
							<?php
							}
					?>
				</select>
				<div style = "width: 75px">	
						<label for="h1-weight">Weight (in Oz.):</label>
						<input type="number" step="0.01" id="h1-weight" name="h1-weight"
						value="<?php
							if(isset($_SESSION['h1-weight'])){
							echo $_SESSION['h1-weight'];
						}?>"></input>
				</div>
				<div style = "width: 75px">	
						<label for="h1-boiltime">Boiltime (in minutes):</label>
						<input type="number" id="h1-boiltime" name="h1-boiltime"
						value="<?php
							if(isset($_SESSION['h1-boiltime'])){
							echo $_SESSION['h1-boiltime'];
						}?>"></input>
				</div>
				<label for="select-hop2">Hop Variety:</label>
				<select id="select-hop2" name="select-hop2">	
					<option selected>Select Hops</option>
					<?php
							while($hop_row2=mysqli_fetch_array($hop2))
							{
								$selected = (isset($_POST['select-hop2']) && $_POST['select-hop2'] == $hop_row2['variety']) ? ' selected="selected"' : '';
							?>
							<option<?php echo $selected ?> value="<?php echo $hop_row2['variety']; ?>"> <?php echo $hop_row2['variety'];?></option>
							<?php
							}
					?>
				</select>
				<div style = "width: 75px">	
						<label for="h2-weight">Weight (in Oz.):</label>
						<input type="number" step="0.01" id="h2-weight" name="h2-weight"
						value="<?php
							if(isset($_SESSION['h2-weight'])){
							echo $_SESSION['h2-weight'];
						}?>"></input>
				</div>
				<div style = "width: 75px">	
						<label for="h2-boiltime">Boiltime (in minutes):</label>
						<input type="number" id="h2-boiltime" name="h2-boiltime"
						value="<?php
							if(isset($_SESSION['h2-boiltime'])){
							echo $_SESSION['h2-boiltime'];
						}?>"></input>
				</div>
				
				<h2 align="center">Add Yeast</h2>
				<label for="select-yeast">Yeast Type:</label>
				<select id="select-yeast" name="select-yeast">
					<option selected>Select Yeast</option>
					<?php
							while($yeast_row=mysqli_fetch_array($yeast))
							{
								$selected = (isset($_POST['select-yeast']) && $_POST['select-yeast'] == $yeast_row['name']) ? ' selected="selected"' : '';
							?>
							<option<?php echo $selected ?> value="<?php echo $yeast_row['name']; ?>"> <?php echo $yeast_row['name'];?></option>
							<?php
							}
					?>
				</select>
				<br></br>
				<button type="submit" name="brew" id="brew" class="ui-btn ui-corner-all ui-shadow ui-btn-b mc-top-margin-1-5">Brew </button>

					<!--<a href="#brew_recipe" type="submit" data-role="button" name="brew" id="brew" data-rel="popup" data-transition="pop" data-position-to="window" data-inline="true" class="ui-btn ui-btn-b ui-corner-all mc-top-margin-1-5">Brew</a>
						<div data-role="popup" id="brew_recipe" data-dismissible="false" style="max-width:400px;" >
							<div data-role="header">
								<h1>Recipe</h1>
							</div>
						<div role="main" class="ui-content">
							<p>Your Recipe:</p>
							<div class="mc-text-center"><a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-b mc-top-margin-1-5">OK</a></div>
						</div>
					</div>-->
					
			</form>		
        </div>
	</div>
</body>
</html>