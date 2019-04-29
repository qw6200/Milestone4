<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../css/styles.css">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
	 crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp"
	 crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
	 crossorigin="anonymous"></script>
</head>

<body class="bodyclass">
<header class="banner">

<div class="bannerpart1">
	<h3>CSC261: Game Database</h3>
</div>

<div class="bannerpart2">
	<?php include '../inc/nav.inc';?>
</div>

</header>
<div class="home-container">
	<?php
require_once('../db_setup.php');
$sql = "USE game_db;";
if ($conn->query($sql) === TRUE) {
   // echo "using Database tbiswas2_company";
} else {
   echo "Error using  database: " . $conn->error;
}
// Query:
$sql = "SELECT * FROM game";
$result = $conn->query($sql);
if($result->num_rows > 0){

?>
<h2>Viewing Games</h2>
	<table class="table table-striped">
		<tr>
			<th>game_id</th>
			<th>rating</th>
			<th>game_name</th>
			<th>summary</th>
			<th>price</th>
		</tr>
		<?php
while($row = $result->fetch_assoc()){
?>
		<tr>
			<td>
				<?php echo $row['game_id']?>
			</td>
			<td>
				<?php echo $row['rating']?>
			</td>
			<td>
				<?php echo $row['game_name']?>
			</td>
			<td>
				<?php echo $row['summary']?>
			</td>
			<td>
				<?php echo $row['price']?>
			</td>
		</tr>

		<?php
}
}
else {
echo "Nothing to display";
}
?>

	</table>

	<div class="backbuttoncontainer">
		<button class="backbutton" onclick="location.href='../welcome.php'" type="button">Back to Home Page!
		</button>
	</div>
	<?php
$conn->close();
?>
</div>
</body>

</html>