<!DOCTYPE html>
<html>

<head>
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

<body>

	<?php
require_once('../db_setup.php');
$sql = "USE game_db;";
if ($conn->query($sql) === TRUE) {
   // echo "using Database tbiswas2_company";
} else {
   echo "Error using  database: " . $conn->error;
}
// Query:
$game_id = $_POST['game_id'];
$rating = $_POST['rating'];
$game_name = $_POST['game_name'];
$summary = $_POST['summary'];
$genre = $_POST['genre'];
$setting = $_POST['setting'];
$graphics = $_POST['graphics'];
$price = $_POST['price'];
$os= $_POST['OS'];
$release_date = $_POST['release_date'];
$singlemulti = $_POST['singlemulti'];


$sql = "INSERT INTO game values ('$game_id', $rating, '$game_name','$summary', $price);";
$sql .= "INSERT INTO game_info values ('$game_id', '$setting', '$graphics', '$os', $release_date);";
$sql .= "INSERT INTO spmp values ('$game_id', '$singlemulti');";
$sql .= "INSERT INTO game_genres values ('$game_id', '$genre')";


/* execute multi query */
if ($conn->multi_query($sql)) {
    do {
        /* store first result set */
        if ($result = $conn->store_result()) {
            while ($row = $result->fetch_row()) {
                printf("%s\n", $row[0]);
            }
            $result->free();
        }
	} while ($conn->next_result());
	echo "New record created successfully";
	header("location: ../welcome.php");
}

// finish insertion and create game page
if ($result === TRUE) {
	echo "New record created successfully";
	$myfile = fopen("../games_pages/$game_id.php", "w") or die("Unable to open file!");
	$txt = file_get_contents('create_game_page.php');
	fwrite($myfile, $txt);
	fclose($myfile);
	header("location: login.php");
}
?>
	
<div class="backbuttoncontainer">
	<button class="backbutton" onclick="location.href='add_gameform.php'" type="button">Click to Go Back!</button>
</div>

<?php
$conn->close();
?>

</body>

</html>