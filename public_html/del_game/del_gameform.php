<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/styles.css">
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

    <main>
        <div class="form-container">
        <ul class="nav-bar">
				<?php if(isset($_SESSION['username'])) { ?>
				<li>
					<a href="../add_game/add_gameform.php">Add Game</a>
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
            <h2> Delete Game </h2>
            <form action="del_game.php" method="post">
            <label for="game_id">Game ID:</label>
                <input id="game_id" type="text" name="game_id">
                <br>
                <input type="submit">
            </form>
        </div>
        <div class="backbuttoncontainer">
            <button class="backbutton" onclick="location.href='../welcome.php'" type="button">Back to Home
                Page!</button>
        </div>
    </main>
</body>

</html>