<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../css/styles.css">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
	 crossorigin="anonymous">

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
	<ul class="nav-bar tablebar">
				<?php if(isset($_SESSION['username'])) { ?>
				<li>
					<a href="../add_game/add_gameform.php">Add Game</a>
				</li>
				<li>
					<a href="../del_game/del_gameform.php">Delete Game</a>
				</li>
				<?php } else { ?>
				<?php } ?>
				<!-- <li>
					<a href="select_game.php">View Games</a>
				</li> -->
				<li>
					<a href="../select_game/select_game_info.php">View Game Info</a>
				</li>
				<li>
					<a href="../select_game/select_game_genres.php">View Game Genres</a>
				</li>
				<li>
					<a href="../select_game/select_spmp.php">View SP/MP</a>
				</li>
				<li>
					<a href="../find_game/find_gameform.php">Find Game</a>
				</li>
			</ul>
		<?php
		require_once('../db_setup.php');
		$sql = "USE game_db;";
		if ($conn->query($sql) === TRUE) {
		// echo "using Database tbiswas2_company";
		} else {
		echo "Error using database: " . $conn->error;
		}
// Query:
$game_id = basename(__FILE__, '.php');
$sql = "SELECT * FROM game join game_info on game.game_id = game_info.gameinfo_id
		join game_genres on game.game_id = game_genres.gameinfo_id
		join spmp on game.game_id = spmp.gameinfo_id
		where game.game_id = '$game_id'";

$result = $conn->query($sql);
if($result->num_rows > 0){

?>
		<table class="table table-striped">
			<tr>
				<th>Game ID</th>
				<th>Game Name</th>
				<th>OS</th>
				<th>Setting</th>
				<th>Summary</th>
				<th>Graphics</th>
				<th>SP/MP</th>
				<th>Genres</th>
			</tr>
			<?php
while($row = $result->fetch_assoc()){
?>
			<tr>
				<td>
					<?php echo $row['game_id']?>
				</td>
				<td>
					<?php echo $row['game_name']?>
				</td>
				<td>
					<?php echo $row['OS']?>
				</td>
				<td>
					<?php echo $row['setting']?>
				</td>
				<td>
					<?php echo $row['summary']?>
				</td>
				<td>
					<?php echo $row['graphics']?>
				</td>
				<td>
					<?php echo $row['singlemulti']?>
				</td>
				<td>
					<?php echo $row['genre']?>
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
</body>
</div>

</html>