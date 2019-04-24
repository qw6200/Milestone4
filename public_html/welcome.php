<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/styles.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
	 crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp"
	 crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
	 crossorigin="anonymous"></script>
</head>

<body>
	<main>
		<div class="home-container">
			<ul class="nav-bar">
				<?php if(isset($_SESSION['username'])) { ?>
				<li>
					<a href="./add_game/add_game.html">Add Game</a>
				</li>
				<li>
					<a href="./del_game/del_game.html">Delete Game</a>
				</li>
				<?php } else { ?>
				<?php } ?>
				<!-- <li>
					<a href="select_game.php">View Games</a>
				</li> -->
				<li>
					<a href="./select_game/select_game_info.php">View Game Info</a>
				</li>
				<li>
					<a href="./select_game/select_game_genres.php">View Game Genres</a>
				</li>
				<li>
					<a href="./select_game/select_spmp.php">View SP/MP</a>
				</li>
				<li>
					<a href="./find_game/find_game.html">Find Game</a>
				</li>
			</ul>

			<div class="logout">
				<?php if(isset($_SESSION['username'])) { ?>
				<a href="logout.php">Logout of your User Account</a>
				<?php } else { ?>
				<a href="login.php">Login to your User Account</a>
				<?php } ?>
			</div>
			<h1> Welcome to the Game Database </h1>
			<div>
				<?php
				require_once('db_setup.php');
				$sql = "USE jhur3_1;";
				if ($conn->query($sql) === TRUE) {
   				// echo "using Database tbiswas2_company";
				} else {
   				echo "Error using database: " . $conn->error;
				}
// Query:
				$sql = "SELECT * FROM game join game_info on game.game_id = game_info.gameinfo_id";
				$result = $conn->query($sql);
				if($result->num_rows > 0){

				?>
				<table class="table table-striped">
					<tr>
						<th>Game Name</th>
						<th>Rating</th>
						<th>Price</th>
						<th>Release Date</th>
					</tr>
					<?php
					while($row = $result->fetch_assoc()){
					?>
					<tr>
						<td>
							<?php
								$game_id = $row['game_id'];
								$game_name = $row['game_name'];
								$game_link = "./games_pages/$game_id.php";
								if (!file_exists($game_link)) {
									$myfile = fopen("./games_pages/$game_id.php", "w") or die("Unable to open file!");
									$txt = file_get_contents('./add_game/create_game_page.php');
									fwrite($myfile, $txt);
									fclose($myfile);	
								}
								echo "<a href='".$game_link."'>$game_name</a>";
							?>
						</td>
						<td>
							<?php echo $row['rating']?>
						</td>
						<td>
							<?php echo "$" . $row['price']?>
						</td>
						<td>
							<?php echo $row['release_date']?>
						</td>
					</tr>

					<?php
					}
					} else {
					echo "Nothing to display";}
					?>

				</table>
				<?php
				$conn->close();
				?>
			</div>
	</main>

</body>

</html>